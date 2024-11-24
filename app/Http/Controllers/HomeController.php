<?php

namespace App\Http\Controllers;

use App\Models\ObrasArte;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Método para mostrar las obras de arte en el home
    public function index(Request $request)
    {   
        if ($request->has('search') && !auth()->check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para buscar obras de arte.');
        }
        // Buscar si existe un término de búsqueda en el parámetro 'search'
        $search = $request->input('search');

        // Si hay un término de búsqueda, filtrar las obras de arte por el título
        $obras = ObrasArte::when($search, function($query, $search) {
            return $query->where('titulo', 'LIKE', "%{$search}%");
        })->paginate(10); // Paginación

        // Retornar la vista con las obras filtradas
        return view('home', compact('obras'));
    }
}
