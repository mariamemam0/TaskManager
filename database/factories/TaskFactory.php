<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Task>
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
        $title = $this->faker->sentence();
        return [
            'project_id' => Project::factory(),
            'title' => $title,
            'slug'=> Str::slug($title),
            'description' => fake()->paragraph(),
            'status'=> fake()->randomElement(['pending','in_progress','completed']),
            'priority'=>fake()->randomElement(['low','medium','high']),
            'started_at'=> fake()->dateTime(),
            'ended_at'=> fake()->dateTime(),

        ];
    }
}
