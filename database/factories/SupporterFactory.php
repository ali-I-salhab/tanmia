<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupporterFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
