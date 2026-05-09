<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection($this->taskService->all());
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create($request->validated());

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(201);
    }

    public function show(int $id): TaskResource
    {
        $task = $this->taskService->findOrFail($id);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, int $id): TaskResource
    {
        $task = $this->taskService->findOrFail($id);
        $task = $this->taskService->update($task, $request->validated());

        return new TaskResource($task);
    }

    public function destroy(int $id): Response
    {
        $task = $this->taskService->findOrFail($id);
        $this->taskService->delete($task);

        return response()->noContent();
    }
}
