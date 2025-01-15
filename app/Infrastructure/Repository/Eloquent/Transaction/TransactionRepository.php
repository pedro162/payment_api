<?php

namespace App\Infrastructure\Repository\Eloquent\Transaction;

use App\Infrastructure\Repository\Interfaces\Transaction\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(array $data = []): ?array
    {
        $result = Transaction::create($data);
        return ['data' => $result];
    }

    public function getAll(array $data = []): ?array
    {
        $result = Transaction::all();
        return ['data' => $result];
    }

    public function getById(int $id, array $data = []): ?array
    {
        $result = Transaction::find($id);
        return ['data' => $result];
    }

    public function update(int $id, array $data = []): ?array
    {
        $result = Transaction::find($id)->update($data);
        return ['data' => $result];
    }
}
