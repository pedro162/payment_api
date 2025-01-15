<?php

namespace App\Http\Controllers\V1\CreditCardPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreditCardPayment\GetAllCreditCardPaymentRequest;
use App\Http\Resources\V1\CreditCardPayment\GetAllCreditCardPaymentResource;
use App\Infrastructure\Services\V1\Adapters\PagBank\CreditCardPayment;
use App\Infrastructure\Services\V1\Interfaces\CreditCardPayment\CreditCardPaymentAdapter;
use Illuminate\Http\Request;

class GetAllCreditCardPaymentController extends Controller
{
    public function __construct(protected CreditCardPayment $adapter) {}

    public function __invoke(GetAllCreditCardPaymentRequest $request)
    {
        $request->validated();

        return response()->json(
            new GetAllCreditCardPaymentResource(
                [['id' => 1]]
            )
        )->setStatusCode(200);
    }
}
