<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        dd(Auth::user()->role);
        // Verificar si el usuario está autenticado y si tiene el rol de Administrador
        if (Auth::check() && Auth::user()->role && Auth::user()->role->nombre === 'Administrador') {
            return $next($request);
        }
        
        // Si no es administrador, redirige al inicio con un mensaje de error
        return redirect('/')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}
