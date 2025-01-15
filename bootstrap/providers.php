<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Repository\PaymentMethod::class,
    App\Providers\Repository\Transaction::class,
    App\Providers\V1\CreditCardPayment\CreditCardPaymentProvider::class,
    App\Providers\V1\QRCodePayment\QRCodePaymentProvider::class,
];
