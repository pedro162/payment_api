<?php

namespace App\Infrastructure\Repository\Eloquent\PaymentMethod;

use App\Infrastructure\Repository\Interfaces\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function create(array $data = []): ?array
    {
        $result = PaymentMethod::create($data);
        return ['data' => $result];
    }

    public function getAll(array $data = []): ?array
    {
        $result = PaymentMethod::all();
        return ['data' => $result];
    }

    public function getById(int $id, array $data = []): ?array
    {
        $result = PaymentMethod::getById($id);
        return ['data' => $result];
    }

    public function update(int $id, array $data = []): ?array
    {
        $result = PaymentMethod::getById($id)->update($data);
        return ['data' => $result];
    }
}
