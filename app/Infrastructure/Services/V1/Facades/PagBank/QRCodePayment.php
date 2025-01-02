<?php

namespace App\Infrastructure\Services\V1\Facades\PagBank;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Infrastructure\Services\V1\Interfaces\QRCodePayment\QRCodePayment as QRCodePaymentInterface;

class QRCodePayment implements QRCodePaymentInterface
{
    protected string|null $apiUrl = null;
    protected string|null $apiToken = null;
    protected string|null $typeOfBody = null;
    protected array $payLoad;

    public function __construct()
    {
        $this->apiUrl = config('services.pagbank.api_url');
        $this->apiToken = config('services.pagbank.api_token');
    }

    public function create(array $data = []): ?array
    {
        $this->builtDataToRequest($data);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => '*/*',
            'content-type' => 'application/json',
        ])->post($this->apiUrl . '/orders', $this->payLoad);

        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }

    public function get(array $data = []): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => '*/*',
        ])->get($this->apiUrl . '/orders/card');

        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }

    public function update(array $data): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => '*/*',
        ])->put($this->apiUrl . 'orders/card', [
            ...$data
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }

    protected function builtDataToRequest(array $data)
    {
        $this->builtDataReference($data);
        $this->builtDataCustomer($data['customer']);
        $this->builtPhoneData($data['customer']['phone'] ?? []);
        $this->builtQRCodeData($data['qr_codes'] ?? []);
        $this->builtAddress($data['address'] ?? []);
    }

    protected function builtDataReference(array $data): self
    {
        $this->payLoad['reference_id'] = $data['reference_id'] ?? Str::uuid();
        return $this;
    }

    protected function builtDataCustomer(array $data): self
    {
        $customer = [
            "name" => $data['name'] ?? null,
            "email" => $data['email'] ?? null,
            "tax_id" => $data['tax_id'],
        ];

        $this->payLoad['customer'] = array_filter($customer, function ($value, $key) {
            return !empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        return $this;
    }

    protected function builtPhoneData(array $data): self
    {
        $customer = [
            "country" => $data['country'] ?? "55",
            "area" => $data['area'] ?? "11",
            "number" => $data['number'] ?? "999999999",
            "type" => $data['type'] ?? "MOBILE"
        ];

        $customer = array_filter($customer, function ($value, $key) {
            return !empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        if (!empty($customer)) {
            $this->payLoad['customer']['phones'] = [$customer];
        }

        return $this;
    }

    protected function builtQRCodeData(array $data): self
    {
        $qrcodeList = [];

        foreach ($data as $item) {
            $qrcode = [
                "amount" => [
                    'value' => $data['amount']['value'] ?? 0
                ],
                'expiration_date' => Carbon::now('America/Sao_Paulo')->addMonth(2)->format('Y-m-d\TH:i:sP')
            ];

            $qrcode = array_filter($qrcode, function ($value, $key) {
                return !empty($value);
            }, ARRAY_FILTER_USE_BOTH);

            $qrcodeList[] = $qrcode;
        }

        $this->payLoad['qr_codes'] = $qrcodeList;

        return $this;
    }

    protected function builtAddress(array $data): self
    {
        $address = [
            "street" => $data['street'] ?? "Avenida Brigadeiro Faria Lima",
            "number" => $data['number'] ?? "1384",
            "complement" => $data['complement'] ?? "apto 12",
            "locality" => $data['locality'] ?? "Pinheiros",
            "city" => $data['city'] ?? "São Paulo",
            "region_code" => $data['region_code'] ?? "SP",
            "country" => $data['country'] ?? "BRA",
            "postal_code" => $data['postal_code'] ?? "01452002"
        ];

        $address = array_filter($address, function ($value, $key) {
            return !empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        $this->payLoad['shipping']['address'] = $address;
        return $this;
    }
}
