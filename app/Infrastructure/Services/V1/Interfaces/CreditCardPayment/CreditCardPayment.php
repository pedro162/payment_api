<?php

namespace App\Infrastructure\Services\V1\Interfaces\CreditCardPayment;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

interface CreditCardPayment
{

    public function create(array $data = []): ?array;

    public function get(array $data = []): ?array;

    public function update(array $data): ?array;
}
