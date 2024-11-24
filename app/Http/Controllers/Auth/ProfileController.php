<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; 

class ProfileController extends Controller
{
    // Mostrar la vista del perfil
    public function show()
    {
        $user = auth()->user();
        $exposicionesFavoritas = $user->exposicionesFavoritas; // Relación de exposiciones favoritas en el modelo User
        $obrasFavoritas = $user->obrasFavoritas; // Relación de obras favoritas en el modelo User
        $artistasFavoritos = $user->artistasFavoritos; // Relación de artistas favoritos en el modelo User
    
        return view('auth.profile', compact('exposicionesFavoritas', 'obrasFavoritas', 'artistasFavoritos'));
    }
    

    // Actualizar el perfil del usuario
    public function update(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . auth()->id(), // Único, excepto para el usuario actual
            'fecha_nacimiento' => 'required|date',
            'nie' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed', // Puede ser nulo si no se quiere cambiar
        ]);

        // Encontrar al usuario autenticado
        $usuario = auth()->user();

        // Actualizar la información del usuario
        $usuario->nombre = $validatedData['nombre'];
        $usuario->apellidos = $validatedData['apellidos'];
        $usuario->email = $validatedData['email'];
        $usuario->fecha_nacimiento = $validatedData['fecha_nacimiento'];
        $usuario->nie = $validatedData['nie'];

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $usuario->password = Hash::make($validatedData['password']);
        }

        // Guardar los cambios en la base de datos
        $usuario->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('profile.show')->with('success', 'Perfil actualizado correctamente.');
    }


}
