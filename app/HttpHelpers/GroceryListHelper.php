<?php

namespace App\HttpHelpers;

use App\Application\Commands\CreateGroceryListCommand;
use App\Application\Handlers\CreateGroceryListHandler;
use App\Application\Handlers\InfoGroceryListHandler;
use App\Application\Services\GroceryListApplicationService;
use App\Domain\GroceryList\ValueObjects\GroceryListId;
use App\Infrastructure\Persistence\EloquentGroceryListRepository;
use App\Models\GroceryList as GroceryListModel;
use Exception;
use Illuminate\Support\Facades\DB;


class GroceryListHelper extends BaseHelper
{

    public function store(array $data)
    {
        $stCod = 201;
        try {
            DB::beginTransaction();

            $objRepo = new EloquentGroceryListRepository();
            $objHandler = new CreateGroceryListHandler($objRepo);
            $objGroceryListHandler = new InfoGroceryListHandler($objRepo);
            $objService = new GroceryListApplicationService($objHandler, $objGroceryListHandler);

            $command = (new CreateGroceryListCommand())
                ->groceryListId(0)
                ->groceryListName($data['name']);
            $domainGroceryListObject = $objService->createGroceryList($command);
            $response = GroceryListModel::where('id', '=', (string) $domainGroceryListObject->getId())->first();
            //throw new Exception('test:' . $response->id);
            DB::commit();
            $this->setHttpResponseData($response);
            $this->setHttpResponseState(true);
            $stCod = 201;
        } catch (\Exception $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 400;
        } catch (\Error $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 500;
        }
        $this->setHttpResponseCode($stCod);
        return $this->getHttpDataResponseRequest();
    }

    public function index(array $data = [])
    {
        try {
            DB::beginTransaction();
            $response = GroceryListModel::orderBy('id', 'DESC')->paginate(10);
            DB::commit();
            $this->setHttpResponseData($response);
            $this->setHttpResponseState(true);
            $stCod = 201;
        } catch (\Exception $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 400;
        } catch (\Error $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 500;
        }
        $this->setHttpResponseCode($stCod);
        return $this->getHttpDataResponseRequest();
    }

    public function show(string $id)
    {
        $response = null;
        $stCod = 200;

        try {
            DB::beginTransaction();

            $objRepo = new EloquentGroceryListRepository();
            $domainGroceryListObject = $objRepo->findById(new GroceryListId($id));
            $response = GroceryListModel::where('id', '=', (string) $domainGroceryListObject->getId());

            DB::commit();

            if (!$response) {
                $stCod = 404;
                $response = [];
            }

            $this->setHttpResponseData($response);
            $this->setHttpResponseState(true);
            $stCod = 201;
        } catch (\Exception $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 400;
        } catch (\Error $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 500;
        }

        $this->setHttpResponseCode($stCod);
        return $this->getHttpDataResponseRequest();
    }

    public function update(string $id, array $data)
    {
        $stCod = 201;
        try {
            DB::beginTransaction();

            $objRepo = new EloquentGroceryListRepository();
            $objHandler = new CreateGroceryListHandler($objRepo);
            $objGroceryListHandler = new InfoGroceryListHandler($objRepo);
            $objService = new GroceryListApplicationService($objHandler, $objGroceryListHandler);

            $command = (new CreateGroceryListCommand())
                ->groceryListId(0)
                ->groceryListName($data['name']);
            $domainGroceryListObject = $objService->createGroceryList($command);
            $response = GroceryListModel::where('id', '=', (string) $domainGroceryListObject->getId());

            DB::commit();
            $this->setHttpResponseData($response);
            $this->setHttpResponseState(true);
            $stCod = 201;
        } catch (\Exception $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 400;
        } catch (\Error $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 500;
        }
        $this->setHttpResponseCode($stCod);
        return $this->getHttpDataResponseRequest();
    }

    public function destroy(string $id)
    {
        $response = null;
        $stCod = 200;

        try {
            DB::beginTransaction();

            $objRepo = new EloquentGroceryListRepository();
            $domainGroceryListObject = $objRepo->findById(new GroceryListId($id));
            //TODO
            //$response = GroceryListModel::where('id', '=', (string) $domainGroceryListObject->getId());

            DB::commit();
            $msg   = 'Bank transaction removed successfully';
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(true);
        } catch (\Exception $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 400;
        } catch (\Error $th) {
            DB::rollback();

            $msg  = $th->getMessage();
            $this->setHttpResponseData($msg);
            $this->setHttpResponseState(false);
            $stCod = 500;
        }

        $this->setHttpResponseCode($stCod);
        return $this->getHttpDataResponseRequest();
    }
}
