<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index(Request $request)
{

    if ($request->has('search') && !auth()->check()) {
        return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para buscar usuarios.');
    }

    $query = User::with('role'); // Asegúrate de obtener el rol asociado si es necesario

    // Si hay un término de búsqueda, filtrar los usuarios por nombre o nie
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('email', 'like', '%' . $request->search . '%')
              ->orWhere('nie', 'like', '%' . $request->search . '%');
        });
    }

    // Obtener los usuarios paginados (10 por página)
    $usuarios = $query->paginate(10);

    return view('usuarios.index', compact('usuarios'));
}

    // Mostrar formulario para crear un nuevo usuario
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    // Guardar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);

        return redirect()->route('usuarios.index');
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario para editar un usuario
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario','roles'));
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $id, // Único, excepto para el usuario actual
            'fecha_nacimiento' => 'required|date', // Validar que sea una fecha
            'nie' => 'required|string|max:20', // Validar que el NIE sea una cadena con un tamaño máximo
            'password' => 'nullable|string|min:8|confirmed', // Puede ser nulo si no se quiere cambiar
            'rol' => 'required|exists:roles,id' // Asegurarse de que el rol existe en la tabla de roles
        ]);

        // Encontrar al usuario a actualizar
        $usuario = User::findOrFail($id);

        // Actualizar la información del usuario
        $usuario->nombre = $validatedData['nombre'];
        $usuario->apellidos = $validatedData['apellidos'];
        $usuario->email = $validatedData['email'];
        $usuario->fecha_nacimiento = $validatedData['fecha_nacimiento'];
        $usuario->nie = $validatedData['nie'];

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $usuario->password = Hash::make($validatedData['password']);
        }

        // Actualizar el rol del usuario
        $usuario->id_role = $validatedData['rol'];

        // Guardar los cambios en la base de datos
        $usuario->save();

        // Redirigir a la página de usuarios con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }



    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
