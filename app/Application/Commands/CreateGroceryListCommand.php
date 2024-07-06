<?php

namespace App\Application\Commands;

class CreateGroceryListCommand
{
    protected string $groceryListId;
    protected string $groceryListName;

    public function groceryListId(string $groceryListId): CreateGroceryListCommand
    {
        $this->groceryListId = $groceryListId;
        return $this;
    }
    public function groceryListName(string $groceryListName): CreateGroceryListCommand
    {
        $this->groceryListName = $groceryListName;
        return $this;
    }

    public function getGroceryListId(): ?string
    {
        return $this->groceryListId;
    }

    public function getGroceryListName(): ?string
    {
        return $this->groceryListName;
    }
}
