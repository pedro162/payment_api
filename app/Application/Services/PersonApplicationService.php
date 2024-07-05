<?php

namespace App\Application\Services;

use App\Application\Commands\CreatePersonCommand;
use App\Application\Commands\InfoPersonCommand;
use App\Application\Handlers\CreatePersonHandler;
use App\Application\Handlers\InfoPersonHandler;
use App\Domain\Person\Entities\Person;
use App\Domain\Person\ValueObjects\PersonDocument;

class PersonApplicationService
{
    private CreatePersonHandler $createPersonHandler;
    private InfoPersonHandler $infoPersonHandler;

    public function __construct(CreatePersonHandler $createPersonHandler)
    {
        $this->createPersonHandler = $createPersonHandler;
    }

    public function setInfoPersonHandler(InfoPersonHandler $infoPersonHandler): PersonApplicationService
    {
        $this->infoPersonHandler = $infoPersonHandler;
        return $this;
    }

    public function createPerson(CreatePersonCommand $command): ?Person
    {
        return $this->createPersonHandler->handler($command);
    }

    public function findPersonById(string $personId)
    {
        $command = new InfoPersonCommand();
        $command->personId($personId);
        return $this->infoPersonHandler->handler($command);
    }
}
