<?php

namespace App\Infrastructure\Services\V1\Facades\PagBank;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Infrastructure\Services\V1\Interfaces\PublicKey as PublicKeyInterface;

class PublicKey implements PublicKeyInterface
{
    protected string|null $apiUrl = null;
    protected string|null $apiToken = null;
    protected string|null $typeOfBody = null;

    public function __construct()
    {
        $this->apiUrl = config('services.pagbank.api_url');
        $this->apiToken = config('services.pagbank.api_token');
        $this->typeOfBody = 'card';
    }

    public function create(array $data = []): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => '*/*',
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl . '/public-keys', [
            'type' => $this->typeOfBody,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }

    public function get(array $data = []): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => '*/*',
        ])->get($this->apiUrl . '/public-keys/card');

        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }

    public function update(array $data): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => '*/*',
        ])->put($this->apiUrl . 'public-keys/card', [
            ...$data
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }
}
