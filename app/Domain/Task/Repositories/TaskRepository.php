<?php

namespace App\Domain\Task\Repositories;

use App\Domain\Task\Entities\Task;
use App\Domain\Task\ValueObjects\TaskId;

interface TaskRepository
{
    public function save(Task $task): ?Task;
    public function findById(TaskId $id): ?Task;
}
