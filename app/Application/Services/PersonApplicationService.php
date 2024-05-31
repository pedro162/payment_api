<?php

namespace App\Application\Services;

use App\Application\Commands\CreatePersonCommand;
use App\Application\Handlers\CreatePersonHandler;
use App\Domain\Person\Entities\Person;

class PersonApplicationService
{
    private CreatePersonHandler $createPersonHandler;

    public function __construct(CreatePersonHandler $createPersonHandler)
    {
        $this->createPersonHandler = $createPersonHandler;
    }

    public function createPerson(string $taskId, string $taskName): ?Person
    {
        $command = new CreatePersonCommand($taskId, $taskName);
        return $this->createPersonHandler->handler($command);
    }
}
