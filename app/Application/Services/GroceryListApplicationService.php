<?php

namespace App\Application\Services;

use App\Application\Commands\CreateGroceryListCommand;
use App\Application\Commands\InfoGroceryListCommand;
use App\Application\Handlers\CreateGroceryListHandler;
use App\Application\Handlers\InfoGroceryListHandler;
use App\Domain\GroceryList\Entities\GroceryList;
use App\Domain\GroceryList\ValueObjects\GroceryListDocument;

class GroceryListApplicationService
{
    private CreateGroceryListHandler $createGroceryListHandler;
    private InfoGroceryListHandler $infoGroceryListHandler;

    public function __construct(CreateGroceryListHandler $createGroceryListHandler)
    {
        $this->createGroceryListHandler = $createGroceryListHandler;
    }

    public function setInfoGroceryListHandler(InfoGroceryListHandler $infoGroceryListHandler): GroceryListApplicationService
    {
        $this->infoGroceryListHandler = $infoGroceryListHandler;
        return $this;
    }

    public function createGroceryList(CreateGroceryListCommand $command): ?GroceryList
    {
        return $this->createGroceryListHandler->handler($command);
    }

    public function findGroceryListById(string $groceryListId)
    {
        $command = new CreateGroceryListCommand();
        $command->groceryListId($groceryListId);
        return $this->infoGroceryListHandler->handler($command);
    }
}
