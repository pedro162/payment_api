<?php

namespace App\Application\Commands;

abstract class BaseProductCommand
{
    protected string $productId;
    protected string $productName;

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }
}
