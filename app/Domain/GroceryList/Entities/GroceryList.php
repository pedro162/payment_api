<?php

namespace App\Domain\GroceryList\Entities;

use App\Domain\GroceryList\ValueObjects\GroceryListDocument;
use App\Domain\GroceryList\ValueObjects\GroceryListId;
use App\Domain\GroceryList\ValueObjects\GroceryListName;
use App\Domain\GroceryList\ValueObjects\GroceryListStatus;
use App\Domain\GroceryList\ValueObjects\GroceryListType;

class GroceryList
{
    protected GroceryListId $id;
    protected GroceryListName $name;

    public function setId(GroceryListId $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?GroceryListId
    {
        return $this->id;
    }

    public function setName(GroceryListName $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?GroceryListName
    {
        return $this->name;
    }
}
