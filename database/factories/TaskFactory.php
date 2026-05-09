<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->optional(0.8)->paragraph(),
            'status' => $this->faker->randomElement(array_map(
                static fn (TaskStatus $status): string => $status->value,
                TaskStatus::cases(),
            )),
        ];
    }
}
