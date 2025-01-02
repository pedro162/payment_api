<?php

namespace App\Http\Controllers\V1\QRCodePayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\QRCodePayment\GetAllQRCodePaymentRequest;
use App\Http\Resources\V1\QRCodePayment\GetAllQRCodePaymentResource;
use App\Infrastructure\Services\V1\Adapters\PagBank\QRCodePayment;
use App\Infrastructure\Services\V1\Interfaces\QRCodePayment\QRCodePaymentAdapter;
use Illuminate\Http\Request;

class GetAllQRCodePaymentController extends Controller
{
    public function __construct(protected QRCodePayment $adapter) {}

    public function __invoke(GetAllQRCodePaymentRequest $request)
    {
        $request->validated();

        return response()->json(
            new GetAllQRCodePaymentResource(
                [['id' => 1]]
            )
        )->setStatusCode(200);
    }
}
