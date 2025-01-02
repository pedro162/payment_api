<?php

namespace App\Http\Controllers\V1\QRCodePayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\QRCodePayment\UpdateQRCodePaymentRequest;
use App\Http\Resources\V1\QRCodePayment\UpdateQRCodePaymentResource;
use App\Infrastructure\Services\V1\Interfaces\QRCodePayment\QRCodePaymentAdapter;
use Illuminate\Http\Request;

class UpdateQRCodePaymentController extends Controller
{
    public function __construct(protected QRCodePaymentAdapter $adapter) {}

    public function __invoke(UpdateQRCodePaymentRequest $request)
    {
        $result = $this->adapter->create($request->validate());

        return response()->json(
            new UpdateQRCodePaymentResource(
                $result
            )
        )->setStatusCode(204);
    }
}
