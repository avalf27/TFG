<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObrasArte; // Modelo para la tabla obras_arte

class ObrasArteSeeder extends Seeder
{
    public function run()
    {
        // Insertar varias obras de arte asociadas a artistas existentes
        ObrasArte::create([
            'titulo' => 'La Noche Estrellada',
            'descripcion' => 'Una de las obras más famosas de Van Gogh.',
            'año' => '1889-06-01',
            'precio' => 1000000.00,
            'imagen' => 'obras_arte/luces_estrelladas.jpeg',
            'estado' => 'disponible',
            'id_artista' => 1 // Debe ser un ID de un artista que ya exista
        ]);

        ObrasArte::create([
            'titulo' => 'El Grito',
            'descripcion' => 'Una pintura expresionista famosa realizada por Edvard Munch.',
            'año' => '1893-01-01',
            'precio' => 1200000.00,
            'imagen' => 'obras_arte/el_grito.jpeg',
            'estado' => 'disponible',
            'id_artista' => 2 // Debe ser un ID de un artista que ya exista
        ]);

        ObrasArte::create([
            'titulo' => 'Guernica',
            'descripcion' => 'Una representación del bombardeo de Guernica durante la guerra civil española, por Pablo Picasso.',
            'año' => '1937-04-26',
            'precio' => 2000000.00,
            'imagen' => 'obras_arte/guernica.jpeg',
            'estado' => 'vendido',
            'id_artista' => 3 // Debe ser un ID de un artista que ya exista
        ]);

        ObrasArte::create([
            'titulo' => 'La Persistencia de la Memoria',
            'descripcion' => 'Una pintura surrealista de Salvador Dalí, conocida por sus relojes derretidos.',
            'año' => '1931-07-01',
            'precio' => 1500000.00,
            'imagen' => 'obras_arte/persistencia_memoria.jpeg',
            'estado' => 'disponible',
            'id_artista' => 1 // Asociado al artista con id 1
        ]);

        ObrasArte::create([
            'titulo' => 'Las Meninas',
            'descripcion' => 'Una obra maestra del pintor español Diego Velázquez.',
            'año' => '1656-01-01',
            'precio' => 1800000.00,
            'imagen' => 'obras_arte/las_meninas.jpeg',
            'estado' => 'no se vende',
            'id_artista' => 2 // Asociado al artista con id 2
        ]);
    }
}
