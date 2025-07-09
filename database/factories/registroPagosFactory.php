<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\registroPagos>
 */
class RegistroPagosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->sentence(),
            'total' => $this->faker->randomFloat(2, 51, 200),
            'fecha' => $this->faker->dateTime(),
            'lugar' => $this->faker->randomElement(['Banco', 'Colegio']),
            'id_alumno' => $this->faker->numberBetween(1, 20)
        ];
    }
}
