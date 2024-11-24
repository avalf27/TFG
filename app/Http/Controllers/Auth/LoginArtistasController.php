<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Artista;

class LoginArtistasController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al artista en la tabla "artistas"
        $artista = Artista::where('email', $request->email)->first();

        if ($artista && Hash::check($request->password, $artista->password)) {
            Auth::guard('artista')->login($artista);
            return redirect()->intended('/'); // Redirigir a la página de artista
        }

        // Si falla la autenticación, redirigir de vuelta al formulario con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('artista')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/artista/login')->with('success', 'Has cerrado sesión exitosamente.');
    }
}
