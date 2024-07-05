<?php

namespace App\Application\Commands;

abstract class BasePersonCommand
{
    protected string $personId;
    protected string $personName;
    protected string $personDocument;
    protected string $personType;

    public function personId(string $personId): BasePersonCommand
    {
        $this->personId = $personId;
        return $this;
    }
    public function personName(string $personName): BasePersonCommand
    {
        $this->personName = $personName;
        return $this;
    }
    public function personDocument(string $personDocument): BasePersonCommand
    {
        $this->personDocument = $personDocument;
        return $this;
    }
    public function personType(string $personType): BasePersonCommand
    {
        $this->personType = $personType;
        return $this;
    }

    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    public function getPersonName(): ?string
    {
        return $this->personName;
    }

    public function getPersonDocument(): ?string
    {
        return $this->personDocument;
    }

    public function getPersonType(): ?string
    {
        return $this->personType;
    }
}
