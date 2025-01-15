<?php

namespace App\Infrastructure\Services\V1\Adapters;

use App\Infrastructure\Services\V1\Adapters\PagBank\CreditCardPayment as CreditCardPaymentAdapter;
use App\Infrastructure\Services\V1\Adapters\PagBank\QRCodePayment as QRCodePaymentAdapter;
use App\Infrastructure\Services\V1\Interfaces\PaymentAdapter\PaymentAdapterInterface;

class PaymentGatewayAdapter
{
    public static function resolve($method): PaymentAdapterInterface
    {
        return match ($method) {
            'pix' => app(QRCodePaymentAdapter::class),
            'CREDIT_CARD' => app(CreditCardPaymentAdapter::class),
            default => throw new \InvalidArgumentException('Interface não suportada.'),
        };
    }
}
