<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Brand\Entities\Brand;
use App\Domain\Brand\Repositories\BrandRepositoryInterface;
use App\Domain\Brand\ValueObjects\BrandId;
use App\Domain\Brand\ValueObjects\BrandName;
use Illuminate\Support\Facades\DB;
use App\Models\Brand as ModelBrand;

class EloquentBrandRepository implements BrandRepositoryInterface
{
    public function save(Brand $product): ?Brand
    {
        //Todo
        //Implement an object model instance and save or update within database, after that, return the object product implementation
        $productId = (string) $product->getId();
        $productId = (int) $productId;
        if ($productId > 0) {
            //update
            $product = ModelBrand::where('id', '=', $productId)->first();
            $product->updated([
                'name' => $product->getName(),
                //'users_create_id'
                //'users_update_id'   
            ]);

            $result = $product;
        } else {
            //create
            $result = ModelBrand::create([
                'name' => $product->getName(),
                //'users_create_id'
                //'users_update_id'   
            ]);
            $product->setId(new BrandId($result->id));
        }

        return $this->findById($product->getId());
    }
    public function findById(BrandId $id): ?Brand
    {
        $product = DB::table('brands')->where('id', '=', (string)$id)->first();
        if ($product) {
            $objBrand = new Brand();
            $objBrand->setId(new BrandId($product->id));
            $objBrand->setName(new BrandName($product->name));

            return $objBrand;
        }
        return null;
    }
}
