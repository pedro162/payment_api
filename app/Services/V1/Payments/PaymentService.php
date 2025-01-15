<?php

namespace App\Services\V1\Payments;

use App\Infrastructure\Repository\Eloquent\Transaction\TransactionRepository;
use App\Models\Transaction;
use App\Infrastructure\Services\V1\Adapters\PaymentGatewayAdapter;
use Illuminate\Support\Str;

class PaymentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected TransactionRepository $respository)
    {
        //
    }

    public function create($paymentData)
    {
        $amount = $paymentData['charges'][0];
        $paymentData['reference_id'] = $paymentData['reference_id'] ?? Str::uuid();
        $paymentMethod = $amount['payment_method']['type'] ?? 'pix';

        $transaction = $this->respository->create([
            'user_id' => $paymentData['user_id'] ?? 2,
            'amount' => $amount['amount']['value'],
            'payment_method' => $paymentMethod,
            'status' => 'WAITING',
            'transaction_code' => $paymentData['reference_id']
        ]);

        $adapter = PaymentGatewayAdapter::resolve($paymentMethod);
        $response = $adapter->create($paymentData);

        $sempleData = $response['simplified_data'] ?? [];
        $charges = $sempleData['charges'][0] ?? [];

        $this->respository->update(
            $transaction['data']->id,
            [
                'status' => $charges['status'],
                'external_id' => $charges['id']
            ]
        );

        return [
            'transaction' => $transaction['data']->refresh(),
            'sempleData' => $sempleData
        ];
    }
}
