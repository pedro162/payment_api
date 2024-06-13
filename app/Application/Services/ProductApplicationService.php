<?php

namespace App\Application\Services;

use App\Application\Commands\CreateProductCommand;
use App\Application\Commands\InfoProductCommand;
use App\Application\Handlers\CreateProductHandler;
use App\Application\Handlers\InfoProductHandler;
use App\Domain\Product\Entities\Product;

class ProductApplicationService
{
    private CreateProductHandler $createProductHandler;
    private InfoProductHandler $infoProductHandler;

    public function __construct(CreateProductHandler $createProductHandler, InfoProductHandler $infoProductHandler)
    {
        $this->createProductHandler = $createProductHandler;
        $this->infoProductHandler = $infoProductHandler;
    }

    public function setInfoProductHandler(InfoProductHandler $infoProductHandler): void
    {
        $this->infoProductHandler = $infoProductHandler;
    }

    public function createProduct(string $personId = '', string $personName = ''): ?Product
    {
        $command = new CreateProductCommand($personId, $personName);
        return $this->createProductHandler->handler($command);
    }

    public function findProductById(string $personId)
    {
        $command = new InfoProductCommand($personId);
        return $this->infoProductHandler->handler($command);
    }
}
