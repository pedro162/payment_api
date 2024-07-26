<?php

namespace App\Application\Commands;

class CreateBrandCommand
{
    protected string $brandId;
    protected string $brandName;

    public function brandId(string $brandId): CreateBrandCommand
    {
        $this->brandId = $brandId;
        return $this;
    }
    public function brandName(string $brandName): CreateBrandCommand
    {
        $this->brandName = $brandName;
        return $this;
    }

    public function getBrandId()
    {
        return $this->brandId;
    }
    public function getBrandName()
    {
        return $this->brandName;
    }
}
