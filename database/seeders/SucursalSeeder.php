<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar todas las sucursales existentes
        Sucursal::query()->delete();

        // Lista de sucursales a insertar
        $sucursales = [
            'Puerto Barrios',
            'Livingston',
            'El Estor',
            'Morales',
            'Los Amates',
        ];

        foreach ($sucursales as $nombre) {
            Sucursal::create([
                'nombre' => $nombre,
                'ubicacion' => $nombre,
            ]);
        }
    }
}
