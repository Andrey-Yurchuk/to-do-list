<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,
    ) {}

    public function all(): Collection
    {
        return $this->taskRepository->all();
    }

    public function findOrFail(int $id): Task
    {
        $task = $this->taskRepository->find($id);

        if ($task === null) {
            throw (new ModelNotFoundException)->setModel(Task::class, [$id]);
        }

        return $task;
    }

    public function create(array $attributes): Task
    {
        return $this->taskRepository->create($attributes);
    }

    public function update(Task $task, array $attributes): Task
    {
        return $this->taskRepository->update($task, $attributes);
    }

    public function delete(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
