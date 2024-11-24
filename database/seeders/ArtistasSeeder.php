<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artista; // Asegúrate de tener el modelo 'Artista' creado
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ArtistasSeeder extends Seeder
{
    public function run()
    {
        // Obtener el rol de Artista (asegúrate de tener el rol "Artista" creado previamente en la base de datos)
        $role = Role::where('nombre', 'Artista')->first();

        // Insertar varios artistas en la base de datos con los nuevos campos requeridos
        Artista::create([
            'nombre' => 'Vincent',
            'apellidos' => 'van Gogh',
            'fecha_nacimiento' => Carbon::parse('1853-03-30'),
            'nie' => 'NIE1234567VVG',
            'biografia' => 'Pintor neerlandés, uno de los más famosos de todos los tiempos y figura destacada del Postimpresionismo.',
            'nacionalidad' => 'Holandés',
            'experiencia' => 'Experto',
            'id_role' => $role->id, // Asegúrate de asignar un rol válido
            'email' => 'vangogh@example.com',
            'password' => Hash::make('password123'), // Contraseña encriptada
        ]);

        Artista::create([
            'nombre' => 'Edvard',
            'apellidos' => 'Munch',
            'fecha_nacimiento' => Carbon::parse('1863-12-12'),
            'nie' => 'NIE1234567EMC',
            'biografia' => 'Pintor noruego conocido por su obra expresionista "El Grito".',
            'nacionalidad' => 'Noruego',
            'experiencia' => 'Avanzado',
            'id_role' => $role->id,
            'email' => 'munch@example.com',
            'password' => Hash::make('password123'), // Contraseña encriptada
        ]);

        Artista::create([
            'nombre' => 'Pablo',
            'apellidos' => 'Picasso',
            'fecha_nacimiento' => Carbon::parse('1881-10-25'),
            'nie' => 'NIE1234567PPC',
            'biografia' => 'Pintor y escultor español, cofundador del movimiento cubista y autor de "Guernica".',
            'nacionalidad' => 'Español',
            'experiencia' => 'Experto',
            'id_role' => $role->id,
            'email' => 'picasso@example.com',
            'password' => Hash::make('password123'), // Contraseña encriptada
        ]);

        Artista::create([
            'nombre' => 'Salvador',
            'apellidos' => 'Dalí',
            'fecha_nacimiento' => Carbon::parse('1904-05-11'),
            'nie' => 'NIE1234567SDD',
            'biografia' => 'Pintor español conocido por sus obras surrealistas llenas de simbolismo.',
            'nacionalidad' => 'Español',
            'experiencia' => 'Avanzado',
            'id_role' => $role->id,
            'email' => 'dali@example.com',
            'password' => Hash::make('password123'), // Contraseña encriptada
        ]);

        Artista::create([
            'nombre' => 'Diego',
            'apellidos' => 'Velázquez',
            'fecha_nacimiento' => Carbon::parse('1599-06-06'),
            'nie' => 'NIE1234567DVZ',
            'biografia' => 'Uno de los pintores más importantes del Siglo de Oro español, conocido por su obra "Las Meninas".',
            'nacionalidad' => 'Español',
            'experiencia' => 'Experto',
            'id_role' => $role->id,
            'email' => 'velazquez@example.com',
            'password' => Hash::make('password123'), // Contraseña encriptada
        ]);
    }
}
