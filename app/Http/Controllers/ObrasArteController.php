<?php

namespace App\Http\Controllers;

use App\Models\ObrasArte;
use App\Models\Artista;
use Illuminate\Http\Request;

class ObrasArteController extends Controller
{
    // Mostrar todas las obras de arte
    public function index(Request $request)
    {

        if ($request->has('search') && !auth()->check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para buscar obras de arte.');
        }
    
        $query = ObrasArte::query();

        // Si hay un término de búsqueda, filtrar las obras por título
        if ($request->has('search') && $request->search != '') {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        // Obtener las obras paginadas
        $obras = $query->paginate(3); // Puedes ajustar el número de elementos por página según desees

        return view('obras.index', compact('obras'));
    }

    // Mostrar formulario para crear una nueva obra de arte
    public function create()
    {
        $artistas = Artista::all();
        return view('obras.create', compact('artistas'));
    }

    public function store(Request $request)
    {
        // Validar los datos ingresados por el usuario
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'año' => 'required|date',
            'precio' => 'nullable|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado' => 'required|string',
            'id_artista' => 'required|exists:artistas,id', // Validar que el artista exista en la base de datos
        ]);
    
        // Guardar la imagen si fue cargada
        if ($request->hasFile('imagen')) {
            $validatedData['imagen'] = $request->file('imagen')->store('obras_arte', 'public');
        }

        // Crear la nueva obra de arte y asignar el id del artista
        ObrasArte::create([
            'titulo' => $validatedData['titulo'],
            'descripcion' => $validatedData['descripcion'],
            'año' => $validatedData['año'],
            'precio' => $validatedData['precio'],
            'estado' => $validatedData['estado'],
            'imagen' => $validatedData['imagen'] ?? null,
            'id_artista' => $validatedData['id_artista'], // Asignar el ID del artista a la obra
        ]);
    
       // Redirigir según el tipo de usuario autenticado
        if (auth()->guard('web')->check() && auth()->user()->role->nombre === 'Administrador') {
            // Redirigir al índice de obras para los administradores
            return redirect()->route('obras.index')->with('success', 'Obra creada exitosamente.');
        } elseif (auth()->guard('artista')->check()) {
            // Redirigir a las obras del artista autenticado
            return redirect()->route('artista.mis-obras')->with('success', 'Obra creada exitosamente.');
        } else {
            // Redirigir a la página principal si no es administrador ni artista
            return redirect()->route('home')->with('error', 'No tienes permiso para crear una obra.');
        }
    }
    

    // Mostrar una obra de arte específica
    public function show($id)
    {
        $obra = ObrasArte::findOrFail($id);
        return view('obras.show', compact('obra'));
    }

    // Mostrar formulario para editar una obra de arte
    public function edit($id)
    {
        $obra = ObrasArte::findOrFail($id);
        return view('obras.edit', compact('obra'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'año' => 'required|date',
            'precio' => 'nullable|numeric',
            'estado' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Buscar la obra por ID
        $obra = ObrasArte::findOrFail($id);

       
    
        // Actualizar los campos validados
        $obra->titulo = $validatedData['titulo'];
        $obra->descripcion = $validatedData['descripcion'];
        $obra->año = $validatedData['año'];
        $obra->precio = $validatedData['precio'];
        $obra->estado = $validatedData['estado'];
    
        // Si hay una nueva imagen, manejar la actualización de la imagen
        if ($request->hasFile('imagen')) {
            $obra->imagen = $request->file('imagen')->store('obras_arte', 'public');
        }
         
        // Guardar los cambios en la base de datos
        $obra->save();
    
        // Redirigir al índice de obras con un mensaje de éxito
        return redirect()->route('obras.index')->with('success', 'Obra de arte actualizada exitosamente.');
    }
    

    // Eliminar una obra de arte
    public function destroy($id)
    {
        $obra = ObrasArte::findOrFail($id);
        $obra->delete();

        return redirect()->route('obras.index');
    }
}
