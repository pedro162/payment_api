<?php

namespace App\Application\Commands;

abstract class BasePersonCommand
{
    protected string $personId;
    protected string $personName;
    protected string $personDocument;
    protected string $personType;

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
