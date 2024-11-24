<?php

namespace App\Http\Controllers;

use App\Models\Exposicion; // Asegúrate de importar el modelo Exposicion
use App\Models\Artista;    // Asegúrate de importar el modelo Artista si es necesario
use App\models\ObrasArte;
use Illuminate\Http\Request;

class ExposicionController extends Controller
{
    // Mostrar todas las exposiciones
    public function index(Request $request)
{

    if ($request->has('search') && !auth()->check()) {
        return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para buscar exposiciones.');
    }

    $query = Exposicion::query();

    // Si se proporciona un término de búsqueda, filtrar las exposiciones por título
    if ($request->has('search')) {
        $query->where('titulo', 'like', '%' . $request->search . '%');
    }

    $exposiciones = $query->paginate(10); // Paginar las exposiciones

    return view('exposiciones.index', compact('exposiciones'));
}


    // Mostrar formulario para crear una nueva exposición
    public function create()
    {
        $artistas = Artista::all(); // Si quieres que el administrador seleccione artistas al crear la exposición
        return view('exposiciones.create', compact('artistas'));
    }

    // Guardar una nueva exposición en la base de datos
    public function store(Request $request)
        {
            // Verificar qué datos están llegando

            // Validar los datos del formulario
            $validatedData = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha_inicio' => 'required|date',
                'fecha_finalizacion' => 'required|date|after_or_equal:fecha_inicio',
                'artistas' => 'nullable|string',
            ]);

            try {
                // Crear la exposición
                $exposicion = Exposicion::create($validatedData);

                // Sincronizar los artistas seleccionados
                if ($request->filled('artistas')) {
                    $artistas = explode(',', $request->input('artistas'));
                    $exposicion->artistas()->sync($artistas);
                }

                // Redirigir con mensaje de éxito
                return redirect()->route('exposiciones.index')->with('success', 'Exposición creada correctamente.');
            } catch (\Exception $e) {
                // Loggear el error y redirigir con un mensaje de error
                \Log::error('Error al crear la exposición: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Hubo un error al guardar la exposición. Intenta de nuevo.');
            }
        }


    // Mostrar una exposición específica
        public function show($id)
        {
            $exposicion = Exposicion::with('artistas')->findOrFail($id);

            return view('exposiciones.show', compact('exposicion'));
        }

        // Mostrar formulario para editar una exposición
        public function edit($id)
        {
            $exposicion = Exposicion::findOrFail($id);
            $artistas = Artista::all(); // Obtener todos los artistas para que el administrador pueda elegir
            $artistasIds = $exposicion->artistas->pluck('id')->toArray();
            $obras = ObrasArte::whereIn('id_artista', $artistasIds)->get();
            return view('exposiciones.edit', compact('exposicion', 'artistas','obras'));
        }


    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date|after_or_equal:fecha_inicio',
            'artistas' => 'nullable|string', // Artistas enviados como una cadena de IDs separados por comas
            'obras' => 'nullable|string',    // Obras enviadas como una cadena de IDs separados por comas
        ]);

        try {
            // Encontrar la exposición a actualizar
            $exposicion = Exposicion::findOrFail($id);

            // Actualizar los datos básicos de la exposición
            $exposicion->update([
                'titulo' => $validatedData['titulo'],
                'descripcion' => $validatedData['descripcion'],
                'fecha_inicio' => $validatedData['fecha_inicio'],
                'fecha_finalizacion' => $validatedData['fecha_finalizacion'],
            ]);

            // Sincronizar los artistas seleccionados en la tabla pivote
            if (!empty($validatedData['artistas'])) {
                $artistasIds = explode(',', $validatedData['artistas']); // Convertir la cadena a un array de IDs
                $exposicion->artistas()->sync($artistasIds);
            } else {
                // Si no se seleccionaron artistas, eliminar todos los relacionados
                $exposicion->artistas()->sync([]);
            }

            // Sincronizar las obras seleccionadas en la tabla pivote
            if (!empty($validatedData['obras'])) {
                $artistasIdsArray = explode(',', $validatedData['artistas']);
                $obrasValidas = ObrasArte::whereIn('id_artista', $artistasIdsArray)->pluck('id')->toArray(); // Obtener las obras válidas

                // Convertir las obras a array de IDs
                $obrasSeleccionadas = explode(',', $validatedData['obras']);
                // Filtrar solo las obras válidas que pertenezcan a los artistas seleccionados
                $obrasSincronizar = array_intersect($obrasSeleccionadas, $obrasValidas);

                $exposicion->obras()->sync($obrasSincronizar);
            } else {
                // Si no se seleccionaron obras, eliminar todas las relacionadas
                $exposicion->obras()->sync([]);
            }

            // Redirigir con mensaje de éxito
            return redirect()->route('exposiciones.index')->with('success', 'Exposición actualizada correctamente.');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar la exposición: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Hubo un error al actualizar la exposición. Intenta de nuevo.');
        }
    }


    // Eliminar una exposición
    public function destroy($id)
    {
        $exposicion = Exposicion::findOrFail($id);
        $exposicion->delete();

        return redirect()->route('exposiciones.index');
    }

    public function updateArtistas(Request $request, $id)
{
    $request->validate([
        'artistas' => 'array|nullable',
        'artistas.*' => 'exists:artistas,id', // Asegúrate de que los IDs de los artistas existen en la base de datos
    ]);

    $exposicion = Exposicion::findOrFail($id);
    
    // Sincronizar los artistas seleccionados con la exposición
    $exposicion->artistas()->sync($request->input('artistas', []));

    return redirect()->route('exposiciones.show', $id)->with('success', 'Artistas participantes actualizados correctamente.');
}

}
