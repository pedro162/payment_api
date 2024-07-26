<?php

namespace App\Application\Services;

use App\Application\Commands\CreateBrandCommand;
use App\Application\Commands\InfoBrandCommand;
use App\Application\Handlers\CreateBrandHandler;
use App\Application\Handlers\InfoBrandHandler;
use App\Domain\Brand\Entities\Brand;

class BrandApplicationService
{
    private CreateBrandHandler $createBrandHandler;
    private InfoBrandHandler $infoBrandHandler;

    public function __construct(CreateBrandHandler $createBrandHandler, InfoBrandHandler $infoBrandHandler)
    {
        $this->createBrandHandler = $createBrandHandler;
        $this->infoBrandHandler = $infoBrandHandler;
    }

    public function setInfoBrandHandler(InfoBrandHandler $infoBrandHandler): void
    {
        $this->infoBrandHandler = $infoBrandHandler;
    }

    public function createBrand(CreateBrandCommand $command): ?Brand
    {
        return $this->createBrandHandler->handler($command);
    }

    public function findBrandById(string $personId)
    {
        $command = new InfoBrandCommand($personId);
        return $this->infoBrandHandler->handler($command);
    }
}
