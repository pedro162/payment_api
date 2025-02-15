<?php

namespace App\Http\Controllers\V1\QRCodePayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\QRCodePayment\StoreQRCodePaymentRequest;
use App\Http\Resources\V1\QRCodePayment\StoreQRCodePaymentResource;
use App\Services\V1\Payments\PaymentService;
use Illuminate\Http\Request;

class StoreQRCodePaymentController extends Controller
{
    public function __construct(protected PaymentService $service) {}

    public function __invoke(StoreQRCodePaymentRequest $request)
    {
        $result = $this->service->create($request->validated());

        return response()->json(
            new StoreQRCodePaymentResource(
                $result
            )
        )->setStatusCode(201);
    }
}
