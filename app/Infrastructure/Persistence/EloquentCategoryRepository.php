<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepositoryInterface;
use App\Domain\Category\ValueObjects\CategoryId;
use App\Domain\Category\ValueObjects\CategoryName;
use Illuminate\Support\Facades\DB;
use App\Models\Category as ModelCategory;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function save(Category $product): ?Category
    {
        //Todo
        //Implement an object model instance and save or update within database, after that, return the object product implementation
        $productId = (string) $product->getId();
        $productId = (int) $productId;
        if ($productId > 0) {
            //update
            $product = ModelCategory::where('id', '=', $productId)->first();
            $product->updated([
                'name' => $product->getName(),
                //'users_create_id'
                //'users_update_id'   
            ]);

            $result = $product;
        } else {
            //create
            $result = ModelCategory::create([
                'name' => $product->getName(),
                //'users_create_id'
                //'users_update_id'   
            ]);
            $product->setId(new CategoryId($result->id));
        }

        return $this->findById($product->getId());
    }
    public function findById(CategoryId $id): ?Category
    {
        $product = DB::table('categories')->where('id', '=', (string)$id)->first();
        if ($product) {
            $objCategory = new Category();
            $objCategory->setId(new CategoryId($product->id));
            $objCategory->setName(new CategoryName($product->name));

            return $objCategory;
        }
        return null;
    }
}
