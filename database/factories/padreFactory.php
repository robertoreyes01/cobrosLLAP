<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\padre>
 */
class PadreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_usuario' => $this->faker->unique()->numberBetween(1, 20),
            'id_alumno' => $this->faker->numberBetween(1, 20)
        ];
    }
}
