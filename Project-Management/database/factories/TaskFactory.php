<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = \App\Models\Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'tasks', true),
            // user_id sera défini dans le seeder pour lier à un user existant
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
