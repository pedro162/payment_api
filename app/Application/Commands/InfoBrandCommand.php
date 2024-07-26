<?php

namespace App\Application\Commands;

class InfoBrandCommand
{
    protected string $brandId;
    protected string $brandName;

    public function brandId(string $brandId): InfoBrandCommand
    {
        $this->brandId = $brandId;
        return $this;
    }
    public function brandName(string $brandName): InfoBrandCommand
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
