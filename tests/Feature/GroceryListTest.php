<?php

namespace Tests\Feature;

use App\Application\Commands\CreateGroceryListCommand;
use App\Application\Handlers\CreateGroceryListHandler;
use App\Application\Handlers\InfoGroceryListHandler;
use App\Application\Services\GroceryListApplicationService;
use App\Domain\GroceryList\Entities\GroceryList;
use App\Infrastructure\Persistence\EloquentGroceryListRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\GroceryList\ValueObjects\GroceryListType;
use InvalidArgumentException;

class GroceryListTest extends TestCase
{
    protected GroceryListApplicationService $groceryListApplicationService;
    //Test Documentatin: https://www.devmedia.com.br/teste-unitario-com-phpunit/41231#assertgreaterthan-
    protected function setUp(): void
    {
        parent::setUp();
        $this->testGroceryListApplicationServiceBootstrap();
    }

    public function testCreateGroceryListService()
    {
        $command = (new CreateGroceryListCommand())
            ->groceryListId(0)
            ->groceryListName('Test grocery list');
        $response = $this->groceryListApplicationService->createGroceryList($command);
        $idGroceryList = (string) $response->getId();
        $idGroceryList = (int) $idGroceryList;
        $this->assertGreaterThan(0, $idGroceryList, "It was no possible to create the product");
    }

    public function testCreateGroceryListWithInvalidNameService()
    {
        $command = (new CreateGroceryListCommand())
            ->groceryListId(0)
            ->groceryListName('');

        $this->expectException(\InvalidArgumentException::class);
        $response = $this->groceryListApplicationService->createGroceryList($command);
        $idGroceryList = (string) $response->getId();
        $idGroceryList = (int) $idGroceryList;
    }

    public function testCheckTheInstanceTypeReturnedByCreateGroceryListServiceMethod()
    {
        $command = (new CreateGroceryListCommand())
            ->groceryListId(0)
            ->groceryListName('Test grocery list');
        $response = $this->groceryListApplicationService->createGroceryList($command);
        $this->assertInstanceOf(GroceryList::class, $response, "The instance type returned by the Service's createGroceryList method is not an instance of 'App\Domain\GroceryList\Entities\GroceryList'");
    }

    public function testTryToCreateAndLoadASpecificGroceryList()
    {
        $command = (new CreateGroceryListCommand())
            ->groceryListId(0)
            ->groceryListName('Test grocery list');
        $response = $this->groceryListApplicationService->createGroceryList($command);
        $idGroceryList = (string) $response->getId();
        $idGroceryList = (int) $idGroceryList;
        echo '$idGroceryList: ' . $idGroceryList . '<br/>';
        $entityGroceryListObject = $this->groceryListApplicationService->findGroceryListById($idGroceryList);
        $idGroceryListEntityGroceryListObject = (string) $entityGroceryListObject->getId();
        $idGroceryListEntityGroceryListObject = (int) $idGroceryListEntityGroceryListObject;

        $this->assertGreaterThan(0, $idGroceryListEntityGroceryListObject, "It was no possible to load the product of code \"{$idGroceryListEntityGroceryListObject}\"");
    }


    private function testGroceryListApplicationServiceBootstrap()
    {
        $objRepo = new EloquentGroceryListRepository();
        $objHandler = new CreateGroceryListHandler($objRepo);
        $objInfoGroceryListHandler = new InfoGroceryListHandler($objRepo);
        $objService = new GroceryListApplicationService($objHandler);
        $objService->setInfoGroceryListHandler($objInfoGroceryListHandler);
        $this->groceryListApplicationService = $objService;
    }
}
