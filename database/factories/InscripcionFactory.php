<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscripcion>
 */
class InscripcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_alumno' => \App\Models\Alumno::factory(),
            'id_nivel' => \App\Models\Nivel::inRandomOrder()->first()?->id_nivel ?? 1,
            'id_curso' => \App\Models\Curso::factory(),
            'id_profesor' => \App\Models\Profesor::factory(),
            'id_sucursal' => \App\Models\Sucursal::inRandomOrder()->first()?->id_sucursal ?? 1,
            'fecha_inscripcion' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
