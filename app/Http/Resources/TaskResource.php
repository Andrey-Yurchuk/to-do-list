<?php

namespace App\Http\Resources;

use App\Models\Task;
use BackedEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Task $task */
        $task = $this->resource;
        $status = $task->status;

        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'status' => $status instanceof BackedEnum
                ? (string) $status->value
                : (string) $task->getRawOriginal('status'),
            'created_at' => $task->created_at?->toISOString(),
            'updated_at' => $task->updated_at?->toISOString(),
        ];
    }
}
