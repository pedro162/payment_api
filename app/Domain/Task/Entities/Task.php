<?php

namespace App\Domain\Task\Entities;

use App\Domain\Task\ValueObjects\TaskId;
use App\Domain\Task\ValueObjects\TaskName;
use App\Domain\Task\ValueObjects\TaskStatus;

class Task
{
    protected TaskId $id;
    protected TaskName $name;
    protected TaskStatus $status;

    public function __construct(TaskId $id, TaskName $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = TaskStatus::pending();
    }

    public function getId(): TaskId
    {
        return $this->id;
    }

    public function getName(): TaskName
    {
        return $this->name;
    }

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }
}
