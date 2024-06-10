<?php

namespace App\Domain\Person\ValueObjects;

use InvalidArgumentException;

class PersonDocument
{
    private string $value;

    public function __construct(string $value)
    {
        if (isset($value) && strlen(trim($value)) > 0) {
            $isNotonlyNumber = preg_match('/\D/', $value);
            if ($isNotonlyNumber) {
                throw new InvalidArgumentException("Person document \"{$value}\" is no valid. Only numbers are permitted");
            }
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
