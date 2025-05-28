<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
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
            'numero' => $this->faker->numerify('5#######'),
            'direccion' => $this->faker->address,
            'id_sucursal' => \App\Models\Sucursal::inRandomOrder()->first()?->id_sucursal ?? 1,
            'id_nivel' => \App\Models\Nivel::whereIn('nombre', ['Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II'])->inRandomOrder()->first()?->id_nivel ?? 1,
            'id_curso' => \App\Models\Curso::inRandomOrder()->first()?->id_curso ?? 1,
        ];
    }
}
