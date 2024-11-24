<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UsuariosSeeder::class,
            ArtistasSeeder::class,
            ObrasArteSeeder::class,
            ExposicionesSeeder::class,
        ]);
    }
}
