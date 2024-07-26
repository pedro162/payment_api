<?php

namespace App\Application\Commands;

class CreateCategoryCommand
{
    protected string $categoryId;
    protected string $categoryName;

    public function categoryId(string $categoryId): CreateCategoryCommand
    {
        $this->categoryId = $categoryId;
        return $this;
    }
    public function categoryName(string $categoryName): CreateCategoryCommand
    {
        $this->categoryName = $categoryName;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function getCategoryName()
    {
        return $this->categoryName;
    }
}
