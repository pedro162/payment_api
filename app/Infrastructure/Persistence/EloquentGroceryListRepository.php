<?php

namespace App\Infrastructure\Persistence;

use App\Domain\GroceryList\Entities\GroceryList;
use App\Domain\GroceryList\Repositories\GroceryListRepositoryInterface;
use App\Domain\GroceryList\ValueObjects\GroceryListId;
use App\Domain\GroceryList\ValueObjects\GroceryListName;
use Illuminate\Support\Facades\DB;
use App\Models\GroceryList as ModelGroceryList;

class EloquentGroceryListRepository implements GroceryListRepositoryInterface
{
    public function save(GroceryList $groceryList): ?GroceryList
    {
        //Todo
        //Implement an object model instance and save or update within database, after that, return the object groceryList implementation
        $groceryListId = (string) $groceryList->getId();
        $groceryListId = (int) $groceryListId;
        if ($groceryListId > 0) {
            //update
            $groceryList = ModelGroceryList::where('id', '=', $groceryListId)->first();
            $groceryList->updated([
                'name' => $groceryList->getName(),
                //'users_create_id'
                //'users_update_id'   
            ]);

            $result = $groceryList;
        } else {
            //create
            $result = ModelGroceryList::create([
                'name' => $groceryList->getName(),
                //'users_create_id'
                //'users_update_id'   
            ]);
            $groceryList->setId(new GroceryListId($result->id));
        }

        return $this->findById($groceryList->getId());
    }
    public function findById(GroceryListId $id): ?GroceryList
    {
        $groceryList = DB::table('groceryLists')->where('id', '=', (string)$id)->first();
        if ($groceryList) {
            $objGroceryList = new GroceryList();
            $objGroceryList->setId(new GroceryListId($groceryList->id));
            $objGroceryList->setName(new GroceryListName($groceryList->name));

            return $objGroceryList;
        }
        return null;
    }
}
