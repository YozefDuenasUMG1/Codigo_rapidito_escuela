<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SucursalSeeder::class,
            GradoSeeder::class,
            NivelesSeeder::class,
            CursoSeeder::class,
            ProfesorSeeder::class,
            AlumnoSeeder::class,
            InscripcionSeeder::class,
            NotaSeeder::class,
        ]);
        $this->call(CursosSeeder::class);

        \App\Models\User::firstOrCreate([
            'email' => 'admin@demo.com',
        ], [
            'name' => 'Admin Demo',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        \App\Models\User::create([
            'name' => 'Profesor Demo',
            'email' => 'profesor@demo.com',
            'password' => bcrypt('profesor1234'),
            'role' => 'profesor',
        ]);
        \App\Models\User::create([
            'name' => 'Alumno Demo',
            'email' => 'alumno@demo.com',
            'password' => bcrypt('alumno1234'),
            'role' => 'alumno',
        ]);
    }
}
