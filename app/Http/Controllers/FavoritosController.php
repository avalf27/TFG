<?php

namespace App\Http\Controllers;

use App\Models\ObrasArte;
use App\Models\Exposicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    // Añadir una obra de arte a favoritos
    public function addObraFavorita($id)
    {
        $obra = ObrasArte::findOrFail($id);
        $user = Auth::user();

        if (!$user->obrasFavoritas->contains($obra)) {
            $user->obrasFavoritas()->attach($obra);
        }

        return redirect()->back()->with('success', 'Obra de arte añadida a tus favoritos.');
    }

    // Eliminar una obra de arte de favoritos
    public function removeObraFavorita($id)
    {
        $obra = ObrasArte::findOrFail($id);
        $user = Auth::user();

        if ($user->obrasFavoritas->contains($obra)) {
            $user->obrasFavoritas()->detach($obra);
        }

        return redirect()->back()->with('success', 'Obra de arte eliminada de tus favoritos.');
    }

    // Añadir una exposición a favoritos
    public function addExposicionFavorita($id)
    {
        $exposicion = Exposicion::findOrFail($id);
        $user = Auth::user();

        if (!$user->exposicionesFavoritas->contains($exposicion)) {
            $user->exposicionesFavoritas()->attach($exposicion);
        }

        return redirect()->back()->with('success', 'Exposición añadida a tus favoritos.');
    }

    // Eliminar una exposición de favoritos
    public function removeExposicionFavorita($id)
    {
        $exposicion = Exposicion::findOrFail($id);
        $user = Auth::user();

        if ($user->exposicionesFavoritas->contains($exposicion)) {
            $user->exposicionesFavoritas()->detach($exposicion);
        }

        return redirect()->back()->with('success', 'Exposición eliminada de tus favoritos.');
    }
}
