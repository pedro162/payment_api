<?php

namespace App\Domain\Person\ValueObjects;

use InvalidArgumentException;

class PersonType
{
    private string $value;
    const PERSON_TYPE_NP = 'np';
    const PERSON_TYPE_LP = 'lp';

    protected array $availableTypes = [
        self::PERSON_TYPE_NP,
        self::PERSON_TYPE_LP,
    ];

    public function __construct(string $value)
    {
        if (!(isset($value) && strlen(trim($value)) > 0)) {
            throw new InvalidArgumentException("Person type can not be empty");
        }

        if (!in_array($value, $this->availableTypes)) {
            throw new InvalidArgumentException("The person type \"{$value}\" is not available");
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function typeNP(): string
    {
        return self::PERSON_TYPE_NP;
    }

    public function typeLP(): string
    {
        return self::PERSON_TYPE_LP;
    }
}
