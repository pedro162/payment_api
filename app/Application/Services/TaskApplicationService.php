<?php

namespace App\Application\Services;

use App\Application\Commands\CreateTaskCommand;
use App\Application\Handlers\CreateTaskHandler;
use App\Domain\Task\Entities\Task;

class TaskApplicationService
{
    private CreateTaskHandler $createTaskHandler;

    public function __construct(CreateTaskHandler $createTaskHandler)
    {
        $this->createTaskHandler = $createTaskHandler;
    }

    public function createTask(string $taskId, string $taskName): ?Task
    {
        $command = new CreateTaskCommand($taskId, $taskName);
        return $this->createTaskHandler->handler($command);
    }
}
