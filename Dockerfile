# Use a imagem oficial do PHP com Apache como base
FROM php:8.3.4-apache

# Habilitar os módulos do Apache necessários
RUN a2enmod rewrite

# Configure o documento raiz do Apache para apontar para o diretório public
RUN sed -i 's!/var/www/html!/var/www/html/app_messages/public!g' /etc/apache2/sites-available/000-default.conf

# Reinicie o Apache para aplicar as alterações
RUN service apache2 restart

# Instale as dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl

# Instale as extensões do PHP necessárias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Configure o local e o fuso horário
RUN echo "date.timezone = UTC" > /usr/local/etc/php/conf.d/timezone.ini

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho
WORKDIR /var/www/html/app_messages

# Verifica se o arquivo composer.json existe, se não, copia um arquivo de exemplo
COPY composer.json /var/www/html/app_messages/composer.json

# Instale as dependências do Composer
RUN composer install --no-interaction || true

# Definir permissões adequadas para o diretório
RUN chown -R www-data:www-data /var/www/html/app_messages
RUN chmod -R 755 /var/www/html/app_messages

# Expose port 80 para o servidor Apache
EXPOSE 80

# Comando para iniciar o Apache
CMD ["apache2-foreground"]

