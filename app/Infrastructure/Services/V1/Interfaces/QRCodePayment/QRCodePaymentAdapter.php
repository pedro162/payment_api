<?php

namespace App\Infrastructure\Services\V1\Interfaces\QRCodePayment;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

interface QRCodePaymentAdapter
{

    public function create(array $data = []): ?array;

    public function get(array $data = []): ?array;

    public function update(array $data): ?array;
}
