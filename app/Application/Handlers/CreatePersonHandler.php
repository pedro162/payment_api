<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreatePersonCommand;
use App\Domain\Person\Entities\Person;
use App\Domain\Person\Repositories\PersonRepositoryInterface;
use App\Domain\Person\ValueObjects\PersonDocument;
use App\Domain\Person\ValueObjects\PersonId;
use App\Domain\Person\ValueObjects\PersonName;
use App\Domain\Person\ValueObjects\PersonType;

class CreatePersonHandler
{
    private PersonRepositoryInterface $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreatePersonCommand $command): ?Person
    {
        //echo 'Person id: ' . $command->getPersonId() . '<br/>';
        $person = new Person();
        $person->setId(new PersonId($command->getPersonId()));
        $person->setName(new PersonName($command->getPersonName()));
        $person->setDocument(new PersonDocument($command->getPersonDocument()));
        $person->setType(new PersonType($command->getPersonType()));

        return $this->repository->save($person);
    }
}
