<?php

namespace App\Domain\Brand\Repositories;

use App\Domain\Brand\Entities\Brand;
use App\Domain\Brand\ValueObjects\BrandId;

interface BrandRepositoryInterface
{
    public function save(Brand $task): ?Brand;
    public function findById(BrandId $id): ?Brand;
}
