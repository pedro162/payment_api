<?php

namespace App\Application\Commands;

class InfoCategoryCommand
{
    protected string $categoryId;
    protected string $categoryName;

    public function categoryId(string $categoryId): InfoCategoryCommand
    {
        $this->categoryId = $categoryId;
        return $this;
    }
    public function categoryName(string $categoryName): InfoCategoryCommand
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
