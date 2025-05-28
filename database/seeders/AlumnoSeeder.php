<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Alumno::query()->delete();
        \App\Models\User::where('role', 'alumno')->delete();

        $niveles = \App\Models\Nivel::whereIn('nombre', [
            'Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II'
        ])->pluck('id_nivel')->toArray();

        foreach (range(1, 20) as $i) {
            $user = User::create([
                'name' => $nombre = fake()->name,
                'email' => $email = fake()->unique()->safeEmail,
                'password' => bcrypt('password'),
                'role' => 'alumno',
            ]);
            $alumno = \App\Models\Alumno::factory()->make([
                'nombre' => $nombre,
                'email' => $email,
                'id_user' => $user->id,
            ]);
            $alumno->id_nivel = $niveles[array_rand($niveles)];
            $alumno->save();
        }
    }
}
