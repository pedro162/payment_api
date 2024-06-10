<?php

namespace App\Application\Commands;

use App\Application\Commands\BasePersonCommand;

class InfoPersonCommand extends BasePersonCommand
{
    public function __construct(string $personId = '', string $personName = '', string $personDocument = '', string $personType = '')
    {
        $this->personId = $personId;
        $this->personName = $personName;
        $this->personDocument = $personDocument;
        $this->personType = $personType;
    }
}
