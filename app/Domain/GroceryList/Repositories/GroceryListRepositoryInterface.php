<?php

namespace App\Domain\GroceryList\Repositories;

use App\Domain\GroceryList\Entities\GroceryList;
use App\Domain\GroceryList\ValueObjects\GroceryListId;

interface GroceryListRepositoryInterface
{
    public function save(GroceryList $task): ?GroceryList;
    public function findById(GroceryListId $id): ?GroceryList;
}
