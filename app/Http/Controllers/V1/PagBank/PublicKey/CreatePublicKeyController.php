<?php

namespace App\Http\Controllers\V1\PagBank\PublicKey;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PagBank\PublicKey\CreatePublicKeyRequest;
use App\Infrastructure\Services\V1\Adapters\PagBank\PublicKey;
use Illuminate\Http\Request;

class CreatePublicKeyController extends Controller
{
    public function __construct(protected PublicKey $adapter) {}

    public function __invoke(CreatePublicKeyRequest $request)
    {
        $this->adapter->create($request->validate());
    }
}
