<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateTaskCommand;
use App\Domain\Task\Entities\Task;
use App\Domain\Task\Repositories\TaskRepository;
use App\Domain\Task\ValueObjects\TaskId;
use App\Domain\Task\ValueObjects\TaskName;

class CreateTaskHandler
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handler(CreateTaskCommand $command): ?Task
    {
        $task = new Task(
            new TaskId($command->getTaskId()),
            new TaskName($command->getTaskName())
        );

        return $this->repository->save($task);
    }
}
