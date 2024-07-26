<?php

namespace App\Application\Services;

use App\Application\Commands\CreateCategoryCommand;
use App\Application\Commands\InfoCategoryCommand;
use App\Application\Handlers\CreateCategoryHandler;
use App\Application\Handlers\InfoCategoryHandler;
use App\Domain\Category\Entities\Category;

class CategoryApplicationService
{
    private CreateCategoryHandler $createCategoryHandler;
    private InfoCategoryHandler $infoCategoryHandler;

    public function __construct(CreateCategoryHandler $createCategoryHandler, InfoCategoryHandler $infoCategoryHandler)
    {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->infoCategoryHandler = $infoCategoryHandler;
    }

    public function setInfoCategoryHandler(InfoCategoryHandler $infoCategoryHandler): void
    {
        $this->infoCategoryHandler = $infoCategoryHandler;
    }

    public function createCategory(CreateCategoryCommand $command): ?Category
    {
        return $this->createCategoryHandler->handler($command);
    }

    public function findCategoryById(string $personId)
    {
        $command = new InfoCategoryCommand($personId);
        return $this->infoCategoryHandler->handler($command);
    }
}
