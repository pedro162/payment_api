<?php

namespace App\Infrastructure\Repository\Interfaces\PaymentMethod;

interface PaymentMethodRepositoryInterface
{
    public function create(array $data = []): ?array;

    public function getAll(array $data = []): ?array;

    public function getById(int $id, array $data = []): ?array;

    public function update(int $id, array $data = []): ?array;
}
