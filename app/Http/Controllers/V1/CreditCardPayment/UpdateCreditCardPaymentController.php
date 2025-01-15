<?php

namespace App\Http\Controllers\V1\CreditCardPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreditCardPayment\UpdateCreditCardPaymentRequest;
use App\Http\Resources\V1\CreditCardPayment\UpdateCreditCardPaymentResource;
use App\Infrastructure\Services\V1\Interfaces\CreditCardPayment\CreditCardPaymentAdapter;
use Illuminate\Http\Request;

class UpdateCreditCardPaymentController extends Controller
{
    public function __construct(protected CreditCardPaymentAdapter $adapter) {}

    public function __invoke(UpdateCreditCardPaymentRequest $request)
    {
        $result = $this->adapter->create($request->validate());

        return response()->json(
            new UpdateCreditCardPaymentResource(
                $result
            )
        )->setStatusCode(204);
    }
}
