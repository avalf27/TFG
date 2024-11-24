<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\ObrasArte;
use App\Models\Exposicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtistaController extends Controller
{
    public function index(Request $request)
    {
    
        if ($request->has('search') && !auth()->check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para buscar exposiciones.');
        }
    
        $query = Artista::query();
    
        // Si se proporciona un término de búsqueda, filtrar las exposiciones por título
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%')
                  ->orWhere('nie', 'like', '%' . $request->search . '%');
            });
        }
    
        $artistas = $query->paginate(5); // Paginar las exposiciones
    
        return view('artistas.index', compact('artistas'));
    }

    // Mostrar formulario para crear un nuevo artista
    public function create()
    {
        return view('artistas.create');
    }

    // Guardar un nuevo artista en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'nullable|string',
            'nacionalidad' => 'nullable|string',
        ]);

        Artista::create($validatedData);
        return redirect()->route('artistas.index')->with('success', 'Artista creado correctamente.');
    }

    // Mostrar detalles de un artista específico
    public function show($id)
    {
        $artista = Artista::with('obras')->findOrFail($id);
        return view('artistas.show', compact('artista'));
    }

    // Mostrar formulario para editar un artista
    public function edit($id)
    {
        $artista = Artista::findOrFail($id);
        return view('artistas.edit', compact('artista'));
    }

    // Actualizar un artista existente
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'nullable|string',
            'nacionalidad' => 'nullable|string',
        ]);

        $artista = Artista::findOrFail($id);
        $artista->update($validatedData);

        return redirect()->route('artistas.index')->with('success', 'Artista actualizado correctamente.');
    }

    // Eliminar un artista
    public function destroy($id)
    {
        $artista = Artista::findOrFail($id);
        $artista->delete();

        return redirect()->route('artistas.index')->with('success', 'Artista eliminado correctamente.');
    }

    // Añadir un artista a favoritos
    public function addFavorito($id)
    {
        $user = Auth::user();
        $artista = Artista::findOrFail($id);
        $user->artistasFavoritos()->attach($artista);

        return redirect()->back()->with('success', 'Artista añadido a tus favoritos.');
    }

    // Eliminar un artista de favoritos
    public function removeFavorito($id)
    {
        $user = Auth::user();
        $artista = Artista::findOrFail($id);
        $user->artistasFavoritos()->detach($artista);

        return redirect()->back()->with('success', 'Artista eliminado de tus favoritos.');
    }

    public function showProfile()
    {
        // Obtiene el artista autenticado
        $artista = Auth::guard('artista')->user();
        
        // Si tienes una vista específica para el perfil del artista, por ejemplo "artistas.perfil", ajusta la siguiente línea:
        return view('artistas.perfil', compact('artista'));
    }

    // Método para mostrar las obras del artista autenticado
    public function misObras()
    {
        $artista = Auth::guard('artista')->user();
        $obras = ObrasArte::where('id_artista', $artista->id)->get();

        return view('artistas.mis_obras', compact('obras'));
    }

    // Método para mostrar las exposiciones donde se encuentran sus obras
    public function misExposiciones()
    {
        $artista = Auth::guard('artista')->user();

        // Obtener las exposiciones en las que el artista tiene obras
        $exposiciones = Exposicion::whereHas('obras', function ($query) use ($artista) {
            $query->where('id_artista', $artista->id);
        })->get();

        return view('artistas.mis_exposiciones', compact('exposiciones'));
    }
}
