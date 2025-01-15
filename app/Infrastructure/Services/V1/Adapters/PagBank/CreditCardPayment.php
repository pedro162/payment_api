<?php

namespace App\Infrastructure\Services\V1\Adapters\PagBank;

use App\Infrastructure\Services\V1\Interfaces\CreditCardPayment\CreditCardPayment as CreditCardPaymentInterface;
use App\Infrastructure\Services\V1\Interfaces\PaymentAdapter\PaymentAdapterInterface;

class CreditCardPayment implements PaymentAdapterInterface
{
    public function __construct(
        protected CreditCardPaymentInterface $adapter
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
        $creditCardParsed = array_map(function ($item) {

            $selfData = [];
            $payData = [];
            $cancelData = [];
            $defaultData = [];

            foreach ($item['links'] as $link) {
                $linkData = [
                    'rel' => $link['rel'],
                    'href' => $link['href'],
                    'media' => $link['media'],
                    'type' => $link['type'],
                ];

                if ($link['rel'] == 'SELF') {
                    $selfData = $linkData;
                } elseif ($link['rel'] == 'PAY') {
                    $payData = $linkData;
                } elseif ($link['rel'] == 'CHARGE.CANCEL') {
                    $cancelData = $linkData;
                } else {
                    $defaultData = $linkData;
                }
            }

            return [
                'id' => $item['id'],
                'status' => $item['status'],
                'created_at' => $item['created_at'],
                'paid_at' => $item['paid_at'],
                'description' => $item['description'],
                'amount' => [
                    'value' => $item['amount']['value'],
                    'currency' => $item['amount']['currency'],
                    'summary' => [
                        "total" => $item['amount']['summary']['total'] ?? 0,
                        "paid" => $item['amount']['summary']['paid'] ?? 0,
                        "refunded" => $item['amount']['summary']['refunded'] ?? 0
                    ]
                ],
                'credit_card_self_data' => $selfData,
                'credit_card_pay_data' => $payData,
                'credit_card_charge_cancel_data' => $cancelData,
                'credit_card_default_data' => $defaultData,
            ];
        }, $data['charges']);

        return [
            'id' => $data['id'],
            'created_at' => $data['created_at'],
            'reference_id' => $data['reference_id'],
            'charges' => $creditCardParsed
        ];
    }
}
