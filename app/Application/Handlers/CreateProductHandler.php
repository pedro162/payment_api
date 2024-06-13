<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateProductCommand;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Domain\Product\ValueObjects\ProductId;
use App\Domain\Product\ValueObjects\ProductName;

class CreateProductHandler
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreateProductCommand $command): ?Product
    {
        $person = new Product();
        $person->setId(new ProductId($command->getProductId()));
        $person->setName(new ProductName($command->getProductName()));

        return $this->repository->save($person);
    }
}
