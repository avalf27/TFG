<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'No tienes permisopara acceder a esta pagina.');
        }

        return $next($request);
    }
}
