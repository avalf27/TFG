<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'nie' => 'required|string|max:20|unique:usuarios',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

         // Obtener el rol predeterminado (por ejemplo, "Usuario Registrado")
         $role = Role::where('nombre', 'Usuario')->first();
        // Crear el usuario en la base de datos
        User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'nie' => $request->nie,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => $role->id, // Asegúrate de pasar el role_id
        ]);

        // Redirigir al login después del registro exitoso
        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
