<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesor>
 */
class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->numerify('5########'),
            'especialidad' => $this->faker->randomElement(['Matemáticas', 'Ciencias', 'Lenguaje', 'Historia']),
            'id_sucursal' => \App\Models\Sucursal::inRandomOrder()->first()?->id_sucursal ?? 1,
            'id_nivel' => \App\Models\Nivel::whereIn('nombre', ['Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II'])->inRandomOrder()->first()?->id_nivel ?? 1,
        ];
    }
}
