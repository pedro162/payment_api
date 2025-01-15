<?php

namespace App\Infrastructure\Services\V1\Adapters\PagBank;

use App\Infrastructure\Services\V1\Interfaces\PaymentAdapter\PaymentAdapterInterface;
use App\Infrastructure\Services\V1\Interfaces\QRCodePayment\QRCodePayment as QRCodePaymentInterface;

class QRCodePayment implements PaymentAdapterInterface
{
    public function __construct(
        protected QRCodePaymentInterface $adapter
    ) {}

    public function create(array $data = []): ?array
    {
        $response = $this->adapter->create($data);
        return [
            'data' => $response,
            'simplified_data' => $this->decodeCriation($response),
        ];
    }

    public function get(array $data = []): ?array
    {
        return $this->adapter->get($data);
    }

    public function update(array $data = []): ?array
    {
        return $this->adapter->update($data);
    }

    protected function decodeCriation($data): array
    {
        $qrcodeParsed = array_map(function ($item) {
            $qrcodeImageData = [
                'rel' => $item['links'][0]['rel'],
                'href' => $item['links'][0]['href'],
                'media' => $item['links'][0]['media'],
                'type' => $item['links'][0]['type'],
            ];

            $png = [];
            $imageBase64 = [];
            $defaultImage = [];

            foreach ($item['links'] as $link) {
                $dataImage = [
                    'rel' => $link['rel'],
                    'href' => $link['href'],
                    'media' => $link['media'],
                    'type' => $link['type'],
                ];

                if ($link['rel'] == 'QRCODE.PNG') {
                    $png = $dataImage;
                } elseif ($link['rel'] == 'QRCODE.BASE64') {
                    $imageBase64 = $dataImage;
                } else {
                    $defaultImage = $dataImage;
                }
            }

            return [
                'id' => $item['id'],
                'status' => $item['status'] ?? 'WAITING',
                'expiration_date' => $item['expiration_date'],
                'amount' => [
                    'value' => $item['amount']['value'],
                ],
                'qrcode_image_data' => $png,
                'qrcode_image_base64_data' => $imageBase64,
                'qrcode_image_default_data' => $defaultImage,
            ];
        }, $data['qr_codes']);

        return [
            'id' => $data['id'],
            'created_at' => $data['created_at'],
            'reference_id' => $data['reference_id'],
            'charges' => $qrcodeParsed
        ];
    }
}
