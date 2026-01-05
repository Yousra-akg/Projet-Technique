<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),

            'email_verified_at' => $this->faker->boolean(80) ? now() : null,

            'password' => Hash::make('password'),

            'remember_token' => Str::random(10),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
