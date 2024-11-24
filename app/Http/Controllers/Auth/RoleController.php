<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Constructor para aplicar middleware
    public function __construct()
    {
        // Middleware para asegurar que sólo usuarios autenticados pueden acceder a estos métodos
        $this->middleware('auth');
    }

    // Mostrar todos los roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Mostrar formulario para crear un nuevo rol
    public function create()
    {
        return view('roles.create');
    }

    // Guardar un nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:roles',
        ]);

        // Crear un nuevo rol con los datos validados
        Role::create($validatedData);

        // Redirigir al listado de roles con un mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'El rol se ha creado exitosamente.');
    }

    // Mostrar un rol específico
    public function show($id)
    {
        $rol = Role::findOrFail($id);
        return view('roles.show', compact('rol'));
    }

    // Mostrar formulario para editar un rol
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        return view('roles.edit', compact('rol'));
    }

    // Actualizar un rol existente
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre,' . $id,
        ]);

        // Buscar el rol y actualizar sus datos
        $rol = Role::findOrFail($id);
        $rol->update($validatedData);

        // Redirigir al listado de roles con un mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'El rol se ha actualizado exitosamente.');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();

        // Redirigir al listado de roles con un mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'El rol se ha eliminado exitosamente.');
    }
}
