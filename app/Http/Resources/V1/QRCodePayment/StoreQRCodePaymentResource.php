<?php

namespace App\Http\Resources\V1\QRCodePayment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreQRCodePaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => parent::toArray($request)
        ];
    }
}
