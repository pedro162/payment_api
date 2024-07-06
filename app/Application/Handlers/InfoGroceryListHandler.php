<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateGroceryListCommand;
use App\Domain\GroceryList\Entities\GroceryList;
use App\Domain\GroceryList\Repositories\GroceryListRepositoryInterface;
use App\Domain\GroceryList\ValueObjects\GroceryListId;
use App\Domain\GroceryList\ValueObjects\GroceryLisName;
use App\Domain\GroceryList\ValueObjects\GroceryLisType;

class InfoGroceryListHandler
{
    private GroceryListRepositoryInterface $repository;

    public function __construct(GroceryListRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreateGroceryListCommand $command): ?GroceryList
    {
        $person = new GroceryList();
        $person->setId(new GroceryListId($command->getGroceryListId()));

        return $this->repository->findById($person->getId());
    }
}
