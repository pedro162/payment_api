<?php

namespace App\Infrastructure\Services\V1\Adapters\PagBank;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Infrastructure\Services\V1\Interfaces\PublicKey as PublicKeyInterface;

class PublicKey
{
    public function __construct(
        protected PublicKeyInterface $adapter
    ) {}

    public function create(array $data = []): ?array
    {
        return $this->adapter->create($data);
    }

    public function get(array $data = []): ?array
    {
        return $this->adapter->get();
    }

    public function update(array $data = []): ?array
    {
        return $this->adapter->update($data);
    }
}
