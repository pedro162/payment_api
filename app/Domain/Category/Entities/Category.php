<?php

namespace App\Domain\Category\Entities;

use App\Domain\Category\ValueObjects\CategoryId;
use App\Domain\Category\ValueObjects\CategoryName;

class Category
{
    protected CategoryId $id;
    protected CategoryName $name;

    public function setId(CategoryId $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?CategoryId
    {
        return $this->id;
    }

    public function setName(CategoryName $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?CategoryName
    {
        return $this->name;
    }
}
