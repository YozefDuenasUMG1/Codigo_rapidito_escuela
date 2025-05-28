<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profesor;
use App\Models\User;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar todos los profesores existentes
        \App\Models\Profesor::query()->delete();
        \App\Models\User::where('role', 'profesor')->delete();

        // Lista de especialidades/lenguajes
        $lenguajes = [
            'Python', 'JavaScript', 'Java', 'C#', 'C/C++', 'TypeScript', 'SQL', 'Go (Golang)', 'PHP',
            'Kotlin', 'Swift', 'Rust', 'Ruby', 'Shell (Bash)', 'Dart', 'R', 'Scala', 'Objective-C', 'Perl', 'MATLAB'
        ];

        // Obtener los niveles disponibles
        $niveles = \App\Models\Nivel::whereIn('nombre', ['Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II'])->pluck('id_nivel')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => $nombre = fake()->name,
                'email' => $email = fake()->unique()->safeEmail,
                'password' => bcrypt('password'),
                'role' => 'profesor',
            ]);
            $profesor = \App\Models\Profesor::factory()->make([
                'nombre' => $nombre,
                'email' => $email,
                'id_user' => $user->id,
            ]);
            $profesor->id_nivel = $niveles[array_rand($niveles)];
            $profesor->save();
        }
    }
}
