<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateCategoryCommand;
use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepositoryInterface;
use App\Domain\Category\ValueObjects\CategoryId;
use App\Domain\Category\ValueObjects\CategoryName;

class CreateCategoryHandler
{
    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreateCategoryCommand $command): ?Category
    {
        $person = new Category();
        $person->setId(new CategoryId($command->getCategoryId()));
        $person->setName(new CategoryName($command->getCategoryName()));

        return $this->repository->save($person);
    }
}
