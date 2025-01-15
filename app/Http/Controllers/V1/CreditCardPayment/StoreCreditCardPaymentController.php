<?php

namespace App\Http\Controllers\V1\CreditCardPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreditCardPayment\StoreCreditCardPaymentRequest;
use App\Http\Resources\V1\CreditCardPayment\StoreCreditCardPaymentResource;
use App\Services\V1\Payments\PaymentService;
use Illuminate\Http\Request;

class StoreCreditCardPaymentController extends Controller
{
    public function __construct(protected PaymentService $service) {}

    public function __invoke(StoreCreditCardPaymentRequest $request)
    {
        $result = $this->service->create($request->validated());

        return response()->json(
            new StoreCreditCardPaymentResource(
                $result
            )
        )->setStatusCode(201);
    }
}
