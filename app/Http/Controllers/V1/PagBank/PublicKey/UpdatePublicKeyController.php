<?php

namespace App\Http\Controllers\V1\PagBank\PublicKey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\PagBank\PublicKey\UpdatePublicKeyRequest;
use App\Infrastructure\Services\V1\Adapters\PagBank\PublicKey;

class UpdatePublicKeyController extends Controller
{
    public function __construct(protected PublicKey $adapter) {}

    public function __invoke(UpdatePublicKeyRequest $request)
    {
        $this->adapter->update($request->validate());
    }
}
