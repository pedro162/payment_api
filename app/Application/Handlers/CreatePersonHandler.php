<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreatePersonCommand;
use App\Domain\Person\Entities\Person;
use App\Domain\Person\Repositories\PersonRepositoryInterface;
use App\Domain\Person\ValueObjects\PersonId;
use App\Domain\Person\ValueObjects\PersonName;

class CreatePersonHandler
{
    private PersonRepositoryInterface $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreatePersonCommand $command): ?Person
    {
        $person = new Person(
            new PersonId($command->getPersonId()),
            new PersonName($command->getPersonName())
        );

        return $this->repository->save($person);
    }
}
