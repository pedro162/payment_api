<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateBrandCommand;
use App\Domain\Brand\Entities\Brand;
use App\Domain\Brand\Repositories\BrandRepositoryInterface;
use App\Domain\Brand\ValueObjects\BrandId;
use App\Domain\Brand\ValueObjects\BrandName;

class CreateBrandHandler
{
    private BrandRepositoryInterface $repository;

    public function __construct(BrandRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreateBrandCommand $command): ?Brand
    {
        $person = new Brand();
        $person->setId(new BrandId($command->getBrandId()));
        $person->setName(new BrandName($command->getBrandName()));

        return $this->repository->save($person);
    }
}
