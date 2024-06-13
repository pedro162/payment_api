<?php

namespace App\Domain\Product\Entities;

use App\Domain\Product\ValueObjects\ProductDocument;
use App\Domain\Product\ValueObjects\ProductId;
use App\Domain\Product\ValueObjects\ProductName;
use App\Domain\Product\ValueObjects\ProductStatus;
use App\Domain\Product\ValueObjects\ProductType;

class Product
{
    protected ProductId $id;
    protected ProductName $name;

    public function setId(ProductId $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?ProductId
    {
        return $this->id;
    }

    public function setName(ProductName $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?ProductName
    {
        return $this->name;
    }
}
