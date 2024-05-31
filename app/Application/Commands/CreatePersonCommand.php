<?php

namespace App\Application\Commands;

class CreatePersonCommand
{
    private string $personId;
    private string $personName;

    public function __construct(string $personId, string $personName)
    {
        $this->personId = $personId;
        $this->personName = $personName;
    }

    public function getPersonId(): string
    {
        return $this->personId;
    }

    public function getPersonName(): string
    {
        return $this->personName;
    }
}
