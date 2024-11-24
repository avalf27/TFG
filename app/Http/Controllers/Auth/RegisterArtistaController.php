<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Artista;
use App\Models\Role;

class RegisterArtistaController extends Controller
{
    // Mostrar el formulario de registro para los artistas
    public function showRegistrationForm()
    {
        return view('auth.register_artista');
    }

    // Registrar un nuevo artista
    public function register(Request $request)
    {
        // Validar los datos del formulario de registro
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'nie' => 'required|string|max:20|unique:artistas',
            'email' => 'required|string|email|max:255|unique:artistas',
            'biografia' => 'required|string|max:1000',
            'experiencia' => 'required|in:Principiante,Intermedio,Avanzado,Experto',
            'nacionalidad' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $rol = Role::where('nombre', 'Artista')->first();
        // Crear un nuevo artista
        $artista = Artista::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'nie' => $request->nie,
            'email' => $request->email,
            'biografia' => $request->biografia,
            'experiencia' => $request->experiencia,
            'nacionalidad' => $request->nacionalidad,
            'password' => Hash::make($request->password),
            'id_role' => $rol->id,
        ]);

        // Autenticar al nuevo artista automáticamente
        Auth::guard('artista')->login($artista);

        // Redirigir al artista a su página de inicio
        return redirect()->intended('/artista/login')->with('success', 'Registro exitoso. Bienvenido al sistema.');
    }

    // Login del artista
    public function login(Request $request)
    {
        // Validar los datos del formulario de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al artista usando la tabla de artistas
        $artista = Artista::where('email', $request->email)->first();

        if ($artista && Hash::check($request->password, $artista->password)) {
            Auth::guard('artista')->login($artista);
            return redirect()->intended('/artista/dashboard'); // Redirigir a una página específica para artistas
        }

        // Si falla la autenticación, redirigir de vuelta al formulario con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    // Logout del artista
    public function logout(Request $request)
    {
        Auth::guard('artista')->logout();
        return redirect('/login/artista')->with('success', 'Has cerrado sesión exitosamente.');
    }
}
