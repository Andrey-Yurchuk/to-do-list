<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_tasks(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/tasks');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'description', 'status', 'created_at', 'updated_at'],
                ],
            ]);
    }

    public function test_can_show_task_by_id(): void
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/tasks/{$task->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $task->id);
    }

    public function test_returns_not_found_for_missing_task(): void
    {
        $this->getJson('/tasks/999999')->assertNotFound();
    }

    public function test_can_create_task(): void
    {
        $payload = [
            'title' => 'Prepare final interview',
            'description' => 'Solve API task',
            'status' => TaskStatus::InProgress->value,
        ];

        $response = $this->postJson('/tasks', $payload);

        $response
            ->assertCreated()
            ->assertJsonPath('data.title', $payload['title'])
            ->assertJsonPath('data.status', $payload['status']);

        $this->assertDatabaseHas('tasks', [
            'title' => $payload['title'],
            'status' => $payload['status'],
        ]);
    }

    public function test_create_task_validates_required_title(): void
    {
        $payload = [
            'description' => 'No title',
            'status' => TaskStatus::Pending->value,
        ];

        $this->postJson('/tasks', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_can_update_task(): void
    {
        $task = Task::factory()->create([
            'status' => TaskStatus::Pending->value,
        ]);

        $payload = [
            'title' => 'Updated title',
            'status' => TaskStatus::Completed->value,
        ];

        $response = $this->putJson("/tasks/{$task->id}", $payload);

        $response
            ->assertOk()
            ->assertJsonPath('data.title', $payload['title'])
            ->assertJsonPath('data.status', $payload['status']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $payload['title'],
            'status' => $payload['status'],
        ]);
    }

    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $this->deleteJson("/tasks/{$task->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
