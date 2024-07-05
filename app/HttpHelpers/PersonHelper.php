<?php

namespace App\HttpHelpers;

use App\Application\Commands\CreatePersonCommand;
use App\Application\Handlers\CreatePersonHandler;
use App\Application\Handlers\InfoPersonHandler;
use App\Application\Services\PersonApplicationService;
use App\Domain\Person\ValueObjects\PersonId;
use App\Infrastructure\Persistence\EloquentPersonRepository;
use App\Models\Person as PersonModel;
use Illuminate\Support\Facades\DB;


class PersonHelper extends BaseHelper
{

    public function store(array $data)
    {
        $stCod = 201;
        try {
            DB::beginTransaction();

            $objRepo = new EloquentPersonRepository();
            $objHandler = new CreatePersonHandler($objRepo);
            $objPersonHandler = new InfoPersonHandler($objRepo);
            $objService = new PersonApplicationService($objHandler, $objPersonHandler);

            $command = (new CreatePersonCommand())
                ->personId(0)
                ->personName($data['name']);
            $domainPersonObject = $objService->createPerson($command);
            $response = PersonModel::where('id', '=', (string) $domainPersonObject->getId());

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
            $response = PersonModel::all();
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

            $objRepo = new EloquentPersonRepository();
            $domainPersonObject = $objRepo->findById(new PersonId($id));
            $response = PersonModel::where('id', '=', (string) $domainPersonObject->getId());

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

            $objRepo = new EloquentPersonRepository();
            $objHandler = new CreatePersonHandler($objRepo);
            $objPersonHandler = new InfoPersonHandler($objRepo);
            $objService = new PersonApplicationService($objHandler, $objPersonHandler);

            $command = (new CreatePersonCommand())
                ->personId(0)
                ->personName($data['name']);
            $domainPersonObject = $objService->createPerson($command);
            $response = PersonModel::where('id', '=', (string) $domainPersonObject->getId());

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

            $objRepo = new EloquentPersonRepository();
            $domainPersonObject = $objRepo->findById(new PersonId($id));
            //TODO
            //$response = PersonModel::where('id', '=', (string) $domainPersonObject->getId());

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
