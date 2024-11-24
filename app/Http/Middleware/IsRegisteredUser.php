<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRegisteredUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'Usuario' || Auth::user()->role === 'Administrador')) {
            return $next($request);
        }
        return redirect('/'); // Redirige al inicio si no está registrado
    }
}
