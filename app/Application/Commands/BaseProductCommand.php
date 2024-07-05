<?php

namespace App\Application\Commands;

abstract class BaseProductCommand
{
    protected string $productId;
    protected string $productName;

    public function productId(string $productId): BaseProductCommand
    {
        $this->productId = $productId;
        return $this;
    }
    public function productName(string $productName): BaseProductCommand
    {
        $this->productName = $productName;
        return $this;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }
}
