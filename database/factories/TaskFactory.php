<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'project_id' => Project::factory(),
            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'deadline' => fake()->dateTimeBetween('now', '+1 year'),
            'status' => fake()->randomElement(TaskStatus::cases()),
        ];
    }
}
