<?php

namespace App\Infrastructure\Services\V1\Facades\PagBank;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Infrastructure\Services\V1\Interfaces\CreditCardPayment\CreditCardPayment as CreditCardPaymentInterface;

class CreditCardPayment implements CreditCardPaymentInterface
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
        $this->builtPurchaseItemData($data['items']);
        $this->builtPhoneData($data['customer']['phones'] ?? []);
        $this->builtChargesData($data['charges'] ?? []);
        $this->builtAddress($data['shipping']['address'] ?? []);
    }

    protected function builtDataReference(array $data): self
    {
        $this->payLoad['reference_id'] = $data['reference_id'];
        return $this;
    }

    protected function builtNotificationData(array $data): self
    {
        $url = "https://meusite.com/notificacoes";
        $this->payLoad['notification_urls'] = $data['notification_urls'] ?? $url;
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
        $phones = [];

        foreach ($data as $item) {
            $phone = [
                "country" => $item['country'] ?? "",
                "area" => $item['area'] ?? "",
                "number" => $item['number'] ?? "",
                "type" => $item['type'] ?? ""
            ];

            $phone = array_filter($phone, function ($value, $key) {
                return !empty($value);
            }, ARRAY_FILTER_USE_BOTH);

            if (!empty($phone)) {
                $phones[] = $phone;
            }
        }

        if (!empty($phones)) {
            $this->payLoad['customer']['phones'] = $phones;
        }

        return $this;
    }

    protected function builtPurchaseItemData(array $data): self
    {
        $itens = [];

        foreach ($data as $item) {
            $itemData = [
                "reference_id" => $item['reference_id'] ?? "",
                "name" => $item['name'] ?? "",
                "quantity" => $item['quantity'] ?? "",
                "unit_amount" => ($item['unit_amount'] ?? 0)
            ];

            $itemData = array_filter($itemData, function ($value, $key) {
                return !empty($value);
            }, ARRAY_FILTER_USE_BOTH);

            if (!empty($itemData)) {
                $itens[] = $itemData;
            }
        }

        $this->payLoad['items'] = $itens;

        return $this;
    }

    protected function builtChargesData(array $data): self
    {
        $creditCardList = [];

        foreach ($data as $item) {
            $instalments = $item['payment_method']['installments'] ?? 0;

            $instalments = $instalments < 10 ? '0' . $instalments : $instalments;

            $creditCard = [
                "reference_id" => $item['reference_id'] ?? Str::uuid(),
                "description" => $item['description'] ?? "Motivo de pagamento",
                "amount" => [
                    'value' => ($item['amount']['value'] ?? 0),
                    "currency" => $item['amount']['currency'] ?? "BRL"
                ],
                "payment_method" => [
                    "type" => "CREDIT_CARD",
                    "installments" => $instalments,
                    "capture" => $item['payment_method']['capture'] ?? true,
                    "soft_descriptor" => $item['payment_method']['soft_descriptor'] ?? "",
                    "card" => [
                        "number" => $item['payment_method']['card']['number'] ?? "",
                        "exp_month" => $item['payment_method']['card']['exp_month'] ?? "",
                        "exp_year" => $item['payment_method']['card']['exp_year'] ?? "",
                        "security_code" => $item['payment_method']['card']['security_code'] ?? "",
                        "holder" => [
                            "name" => $item['payment_method']['card']['holder']['name'] ?? "",
                            "tax_id" => $item['payment_method']['card']['holder']['tax_id'] ?? ""
                        ]
                    ]
                ]
            ];

            $creditCard = array_filter($creditCard, function ($value, $key) {
                return !empty($value);
            }, ARRAY_FILTER_USE_BOTH);

            $creditCardList[] = $creditCard;
        }

        $this->payLoad['charges'] = $creditCardList;

        return $this;
    }

    protected function builtAddress(array $data): self
    {
        $address = [
            "street" => $data['street'] ?? "",
            "number" => $data['number'] ?? "",
            "complement" => $data['complement'] ?? "",
            "locality" => $data['locality'] ?? "",
            "city" => $data['city'] ?? "",
            "region_code" => $data['region_code'] ?? "",
            "country" => $data['country'] ?? "",
            "postal_code" => $data['postal_code'] ?? ""
        ];

        $address = array_filter($address, function ($value, $key) {
            return !empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        $this->payLoad['shipping']['address'] = $address;
        return $this;
    }
}
