<?php

namespace App\Infrastructure\Services\V1\Interfaces\PagBank;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

interface PublicKey
{

    public function create(array $data = []): ?array;

    public function get(array $data = []): ?array;

    public function update(array $data): ?array;
}
