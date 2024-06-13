<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\ValueObjects\ProductId;

interface ProductRepositoryInterface
{
    public function save(Product $task): ?Product;
    public function findById(ProductId $id): ?Product;
}
