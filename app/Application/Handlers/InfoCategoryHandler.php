<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateCategoryCommand;
use App\Application\Commands\InfoCategoryCommand;
use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepositoryInterface;
use App\Domain\Category\ValueObjects\CategoryDocument;
use App\Domain\Category\ValueObjects\CategoryId;
use App\Domain\Category\ValueObjects\CategoryName;
use App\Domain\Category\ValueObjects\CategoryType;

class InfoCategoryHandler
{
    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(InfoCategoryCommand $command): ?Category
    {
        $person = new Category();
        $person->setId(new CategoryId($command->getCategoryId()));

        return $this->repository->findById($person->getId());
    }
}
