<?php

namespace App\Application\Services;

use App\Application\Commands\CreatePersonCommand;
use App\Application\Commands\InfoPersonCommand;
use App\Application\Handlers\CreatePersonHandler;
use App\Application\Handlers\InfoPersonHandler;
use App\Domain\Person\Entities\Person;

class PersonApplicationService
{
    private CreatePersonHandler $createPersonHandler;
    private InfoPersonHandler $infoPersonHandler;

    public function __construct(CreatePersonHandler $createPersonHandler, InfoPersonHandler $infoPersonHandler)
    {
        $this->createPersonHandler = $createPersonHandler;
        $this->infoPersonHandler = $infoPersonHandler;
    }

    public function setInfoPersonHandler(InfoPersonHandler $infoPersonHandler): void
    {
        $this->infoPersonHandler = $infoPersonHandler;
    }

    public function createPerson(string $personId = '', string $personName = '', string $personDocument = '', string $personType = ''): ?Person
    {
        $command = new CreatePersonCommand($personId, $personName, $personDocument, $personType);
        return $this->createPersonHandler->handler($command);
    }

    public function findPersonById(string $personId)
    {
        $command = new InfoPersonCommand($personId);
        return $this->infoPersonHandler->handler($command);
    }
}
