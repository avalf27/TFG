<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exposicion;

class ExposicionesSeeder extends Seeder
{
    public function run()
    {
        // Crear algunas exposiciones de ejemplo
        Exposicion::create([
            'titulo' => 'Exposición de Arte Moderno',
            'descripcion' => 'Una exposición que muestra las obras más influyentes del arte moderno.',
            'fecha_inicio' => '2024-06-01',
            'fecha_finalizacion' => '2024-09-01',
        ]);

        Exposicion::create([
            'titulo' => 'Obras Maestras del Siglo XX',
            'descripcion' => 'Una colección de las obras maestras más destacadas del siglo XX.',
            'fecha_inicio' => '2024-10-15',
            'fecha_finalizacion' => '2025-01-15',
        ]);
    }
}
