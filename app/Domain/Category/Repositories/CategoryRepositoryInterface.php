<?php

namespace App\Domain\Category\Repositories;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\ValueObjects\CategoryId;

interface CategoryRepositoryInterface
{
    public function save(Category $task): ?Category;
    public function findById(CategoryId $id): ?Category;
}
