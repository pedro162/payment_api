<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageHandler
{
    const BASE_PATH_TO_LOCAL_FILES = 'app/public';

    public static function saveBase64Image($base64Image, $storagePath = 'photos/')
    {
        $type = [];
        // Verificar se a imagem é válida
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            // Verificar se o tipo de arquivo é permitido
            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new \Exception('Tipo de imagem inválido');
            }

            $base64Image = str_replace(' ', '+', $base64Image);
            $imageData = base64_decode($base64Image);

            if ($imageData === false) {
                throw new \Exception('Decodificação de imagem base64 falhou');
            }

            // Criar um nome único para a imagem
            $fileName = uniqid() . date('ymdhis') . '.' . $type;

            $fullPath = storage_path(self::BASE_PATH_TO_LOCAL_FILES . "/{$storagePath}");
            if (!File::exists($fullPath)) {
                File::makeDirectory($fullPath, 0755, true);
            }

            $filePath = "{$fullPath}/{$fileName}";
            // Save the image in disk
            if (!(file_put_contents($filePath, $imageData) > 0)) {
                throw new \Exception('Decodificação de imagem base64 falhou');
            }

            return $filePath;
        } else {
            throw new \Exception('A string base64 não é válida');
        }
    }

    public static function deleteImage($imagePath)
    {
        // Verificar se a imagem é válida

        $imagePathArr = explode('.', $imagePath);
        if (!(is_array($imagePathArr) && count($imagePathArr) > 1)) {
            return false;
        }

        $type = $imagePathArr[count($imagePathArr) - 1];
        if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
            throw new \Exception('Invalid image type');
        }

        if (file_exists($imagePath) && is_readable($imagePath)) {
            return unlink($imagePath);
        }
        return false;
    }

    public static function loadImage($imagePath)
    {
        if (file_exists($imagePath) && is_readable($imagePath)) {
            return file_get_contents($imagePath);
        }
        return false;
    }

    public static function loadImageBase64Image($imagePath)
    {
        if (file_exists($imagePath) && is_readable($imagePath)) {
            return base64_encode(file_get_contents($imagePath));
        }
        return false;
    }
}
