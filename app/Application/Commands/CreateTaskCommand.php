<?php

namespace App\Application\Commands;

class CreateTaskCommand
{
    private string $taskId;
    private string $taskName;

    public function __construct(string $taskId, string $taskName)
    {
        $this->taskId = $taskId;
        $this->taskName = $taskName;
    }

    public function getTaskId(): string
    {
        return $this->taskId;
    }

    public function getTaskName(): string
    {
        return $this->taskName;
    }
}
