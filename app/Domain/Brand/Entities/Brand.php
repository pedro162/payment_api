<?php

namespace App\Domain\Brand\Entities;

use App\Domain\Brand\ValueObjects\BrandDocument;
use App\Domain\Brand\ValueObjects\BrandId;
use App\Domain\Brand\ValueObjects\BrandName;
use App\Domain\Brand\ValueObjects\BrandStatus;
use App\Domain\Brand\ValueObjects\BrandType;

class Brand
{
    protected BrandId $id;
    protected BrandName $name;

    public function setId(BrandId $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?BrandId
    {
        return $this->id;
    }

    public function setName(BrandName $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?BrandName
    {
        return $this->name;
    }
}
