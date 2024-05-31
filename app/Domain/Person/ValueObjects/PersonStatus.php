<?php

namespace App\Domain\Person\ValueObjects;

class PersonStatus
{
    private string $value;

    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

    private static array $validStatuses = [
        self::STATUS_TODO,
        self::STATUS_IN_PROGRESS,
        self::STATUS_DONE
    ];

    public function __construct(string $status)
    {
        if (!(isset($value) && in_array($status, self::$validStatuses, true))) {
            throw new \InvalidArgumentException("Invalid task status: {$status}");
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public static function pending()
    {
        return self::STATUS_TODO;
    }
}
