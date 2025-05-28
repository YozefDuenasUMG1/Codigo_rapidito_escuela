<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar todos los cursos existentes
        Curso::query()->delete();

        // Lista de cursos a insertar
        $cursos = [
            'Python',
            'JavaScript',
            'Java',
            'C#',
            'C/C++',
            'TypeScript',
            'SQL',
            'Go (Golang)',
            'PHP',
            'Kotlin',
            'Swift',
            'Rust',
            'Ruby',
            'Shell (Bash)',
            'Dart',
            'R',
            'Scala',
            'Objective-C',
            'Perl',
            'MATLAB',
        ];

        foreach ($cursos as $nombre) {
            Curso::create([
                'nombre' => $nombre,
                'descripcion' => 'Curso de ' . $nombre,
            ]);
        }
    }
} 