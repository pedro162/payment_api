<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Task\Entities\Task;
use App\Domain\Task\Repositories\TaskRepository;
use App\Domain\Task\ValueObjects\TaskId;
use App\Domain\Task\ValueObjects\TaskName;
use App\Domain\Task\ValueObjects\TaskStatus;
use Illuminate\Support\Facades\DB;

class EloquentTaskRepository implements TaskRepository
{
    public function save(Task $task): ?Task
    {
        //Todo
        //Implement an object model instance and save or update within database, after that, return the object task implementation
        $taskId = (string) $task->getId();
        $taskId = (int) $taskId;
        if ($taskId > 0) {
            //update
        } else {
            //create
        }

        return null;
    }
    public function findById(TaskId $id): ?Task
    {
        $task = DB::table('task')->where('id', '=', (string)$id)->first();
        if ($task) {
            return new Task(
                new TaskId($task->id),
                new TaskName($task->name),
                new TaskStatus($task->status),
            );
        }
        return null;
    }
}
