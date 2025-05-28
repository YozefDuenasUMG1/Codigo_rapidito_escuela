<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nivel;

class NivelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar todos los niveles existentes
        Nivel::query()->delete();

        // Obtener los id_grado correspondientes
        $gradoNovato = \App\Models\Grado::where('nombre', 'Novato')->first();
        $gradoExperto = \App\Models\Grado::where('nombre', 'Experto')->first();

        // Lista de niveles a insertar
        $niveles = [
            ['nombre' => 'Principiantes I', 'id_grado' => $gradoNovato ? $gradoNovato->id_grado : 1],
            ['nombre' => 'Principiantes II', 'id_grado' => $gradoNovato ? $gradoNovato->id_grado : 1],
            ['nombre' => 'Avanzados I', 'id_grado' => $gradoExperto ? $gradoExperto->id_grado : 2],
            ['nombre' => 'Avanzados II', 'id_grado' => $gradoExperto ? $gradoExperto->id_grado : 2],
        ];

        foreach ($niveles as $nivel) {
            Nivel::create($nivel);
        }
    }
} 