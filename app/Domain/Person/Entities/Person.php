<?php

namespace App\Domain\Person\Entities;

use App\Domain\Person\ValueObjects\PersonDocument;
use App\Domain\Person\ValueObjects\PersonId;
use App\Domain\Person\ValueObjects\PersonName;
use App\Domain\Person\ValueObjects\PersonStatus;
use App\Domain\Person\ValueObjects\PersonType;

class Person
{
    protected PersonId $id;
    protected PersonName $name;
    protected PersonStatus $status;
    protected PersonDocument $document;
    protected PersonType $personType;

    public function setId(PersonId $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?PersonId
    {
        return $this->id;
    }

    public function setName(PersonName $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?PersonName
    {
        return $this->name;
    }


    public function setDocument(PersonDocument $document): void
    {
        $this->document = $document;
    }

    public function getDocumen(): ?PersonDocument
    {
        return $this->document;
    }

    public function setType(PersonType $personType): void
    {
        $this->personType = $personType;
    }

    public function getType(): ?PersonType
    {
        return $this->personType;
    }
}
