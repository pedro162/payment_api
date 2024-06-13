<?php

namespace App\Application\Commands;

use App\Application\Commands\BaseProductCommand;

class InfoProductCommand extends BaseProductCommand
{
    public function __construct(string $productId = '', string $productName = '')
    {
        $this->productId = $productId;
        $this->productName = $productName;
    }
}
