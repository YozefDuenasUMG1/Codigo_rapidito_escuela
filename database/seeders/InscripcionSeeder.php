<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $alumnos = \App\Models\Alumno::all();
        $cursos = \App\Models\Curso::all();
        $niveles = \App\Models\Nivel::all();
        $profesores = \App\Models\Profesor::all();
        $sucursales = \App\Models\Sucursal::all();

        if ($alumnos->isEmpty() || $cursos->isEmpty() || $niveles->isEmpty() || $profesores->isEmpty() || $sucursales->isEmpty()) {
            $this->command->warn('No hay datos suficientes en alumnos, cursos, niveles, profesores o sucursales para crear inscripciones.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            $alumno = $alumnos->random();
            $curso = $cursos->random();
            $nivel = $niveles->random();
            $profesor = $profesores->random();
            $sucursal = $sucursales->random();
            \App\Models\Inscripcion::create([
                'id_alumno' => $alumno->id_alumno,
                'id_curso' => $curso->id_curso,
                'id_nivel' => $nivel->id_nivel,
                'id_profesor' => $profesor->id_profesor,
                'id_sucursal' => $sucursal->id_sucursal,
                'fecha_inscripcion' => now(),
            ]);
        }
    }
}
