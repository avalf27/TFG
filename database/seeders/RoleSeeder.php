<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Asegúrate de que esta línea esté presente

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['nombre' => 'Administrador']);
        Role::create(['nombre' => 'Usuario']);
        Role::create(['nombre' => 'Artista']);
    }
}
