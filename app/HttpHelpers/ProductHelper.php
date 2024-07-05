<?php

namespace App\HttpHelpers;

use App\Application\Commands\CreateProductCommand;
use App\Application\Handlers\CreateProductHandler;
use App\Application\Handlers\InfoProductHandler;
use App\Application\Services\ProductApplicationService;
use App\Domain\Product\ValueObjects\ProductId;
use App\Infrastructure\Persistence\EloquentProductRepository;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\DB;


class ProductHelper extends BaseHelper
{

    public function store(array $data)
    {
        $stCod = 201;
        try {
            DB::beginTransaction();

            $objRepo = new EloquentProductRepository();
            $objHandler = new CreateProductHandler($objRepo);
            $objProductHandler = new InfoProductHandler($objRepo);
            $objService = new ProductApplicationService($objHandler, $objProductHandler);

            $command = (new CreateProductCommand())
                ->productId(0)
                ->productName($data['name']);
            $domainProductObject = $objService->createProduct($command);
            $response = ProductModel::where('id', '=', (string) $domainProductObject->getId());

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
            $response = ProductModel::all();
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

            $objRepo = new EloquentProductRepository();
            $domainProductObject = $objRepo->findById(new ProductId($id));
            $response = ProductModel::where('id', '=', (string) $domainProductObject->getId());

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

            $objRepo = new EloquentProductRepository();
            $objHandler = new CreateProductHandler($objRepo);
            $objProductHandler = new InfoProductHandler($objRepo);
            $objService = new ProductApplicationService($objHandler, $objProductHandler);

            $command = (new CreateProductCommand())
                ->productId(0)
                ->productName($data['name']);
            $domainProductObject = $objService->createProduct($command);
            $response = ProductModel::where('id', '=', (string) $domainProductObject->getId());

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

            $objRepo = new EloquentProductRepository();
            $domainProductObject = $objRepo->findById(new ProductId($id));
            //TODO
            //$response = ProductModel::where('id', '=', (string) $domainProductObject->getId());

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
