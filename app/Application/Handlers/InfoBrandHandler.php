<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateBrandCommand;
use App\Application\Commands\InfoBrandCommand;
use App\Domain\Brand\Entities\Brand;
use App\Domain\Brand\Repositories\BrandRepositoryInterface;
use App\Domain\Brand\ValueObjects\BrandDocument;
use App\Domain\Brand\ValueObjects\BrandId;
use App\Domain\Brand\ValueObjects\BrandName;
use App\Domain\Brand\ValueObjects\BrandType;

class InfoBrandHandler
{
    private BrandRepositoryInterface $repository;

    public function __construct(BrandRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(InfoBrandCommand $command): ?Brand
    {
        $person = new Brand();
        $person->setId(new BrandId($command->getBrandId()));

        return $this->repository->findById($person->getId());
    }
}
