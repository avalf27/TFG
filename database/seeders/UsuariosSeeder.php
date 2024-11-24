<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        // Obtener el rol "Usuario Registrado" desde la tabla roles
        $role = Role::where('nombre', 'Usuario')->first();

        if ($role) {
            User::create([
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'fecha_nacimiento' => '1990-01-01',
                'nie' => 'X1234567A',
                'email' => 'juan.perez@example.com',
                'password' => Hash::make('password123'),
                'id_role' => $role->id,
            ]);

            User::create([
                'nombre' => 'Alberto',
                'apellidos' => 'Val Fernandez',
                'fecha_nacimiento' => '2004-08-27',
                'nie' => '21745923K',
                'email' => 'avalfernandez123@gmail.com',
                'password' => Hash::make('12345678'),
                'id_role' => $role->id,
            ]);
        } else {
            // Lanza una excepción si el rol no existe
            throw new \Exception('El rol "Usuario Registrado" no se encontró en la tabla roles.');
        }
    }
}
