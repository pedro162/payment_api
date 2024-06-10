<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreatePersonCommand;
use App\Application\Commands\InfoPersonCommand;
use App\Domain\Person\Entities\Person;
use App\Domain\Person\Repositories\PersonRepositoryInterface;
use App\Domain\Person\ValueObjects\PersonDocument;
use App\Domain\Person\ValueObjects\PersonId;
use App\Domain\Person\ValueObjects\PersonName;
use App\Domain\Person\ValueObjects\PersonType;

class InfoPersonHandler
{
    private PersonRepositoryInterface $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(InfoPersonCommand $command): ?Person
    {
        $person = new Person();
        $person->setId(new PersonId($command->getPersonId()));

        return $this->repository->findById($person->getId());
    }
}
