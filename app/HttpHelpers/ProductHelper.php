<?php

namespace App\HttpHelpers;

use App\Application\Commands\CreateProductCommand;
use App\Application\Handlers\CreateProductHandler;
use App\Application\Handlers\InfoProductHandler;
use App\Application\Services\ProductApplicationService;
use App\Domain\Product\ValueObjects\ProductId;
use App\Infrastructure\Persistence\EloquentProductRepository;
use App\Models\Product as ProductModel;
use App\Models\SystemFile as SystemFileModel;
use Illuminate\Support\Facades\DB;
use App\Utils\ImageHandler;


class ProductHelper extends BaseHelper
{

    public function store(array $data, array $files = [])
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
            $response = ProductModel::where('id', '=', (string) $domainProductObject->getId())->first();
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
            $response = ProductModel::orderBy('id', 'DESC')->paginate(10);
            if ($response) {
                foreach ($response as $item) {
                    $images = $item->images;
                    if ($images) {
                        foreach ($images as $image) {
                            $image->base64_content = ImageHandler::loadImageBase64Image($image->full_path);
                        }
                    }
                }
            }

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
            $response = ProductModel::where('id', '=', (string) $domainProductObject->getId())->first();

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

    public function update(string $id, array $data, array $files = [])
    {
        $stCod = 201;
        try {

            DB::beginTransaction();

            $objRepo = new EloquentProductRepository();
            $objHandler = new CreateProductHandler($objRepo);
            $objProductHandler = new InfoProductHandler($objRepo);
            $objService = new ProductApplicationService($objHandler, $objProductHandler);

            $command = (new CreateProductCommand())
                ->productId($id)
                ->productName($data['name']);
            $domainProductObject = $objService->createProduct($command);
            $response = ProductModel::where('id', '=', (string) $domainProductObject->getId())->first();
            $images = $response->images;
            if ($images) {
                foreach ($images as $image) {
                    ImageHandler::deleteImage($image->full_path);
                    $image->delete();
                }
            }
            if (isset($data['photos']) && count($data['photos']) > 0) {
                foreach ($data['photos'] as $photo) {
                    if ($pathImage = ImageHandler::saveBase64Image($photo['url'])) {
                        SystemFileModel::create([
                            'full_path' => $pathImage,
                            'reference_id' => (string) $domainProductObject->getId(),
                            'reference' => 'products',
                        ]);
                    }
                }
            }
            //deleteImage
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
