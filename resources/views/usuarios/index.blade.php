@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Usuarios</h1>

    <!-- Mensaje de Éxito o Error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

     <!-- Botón para Crear Nuevo Artista -->
     <div class="mb-4 text-end">
        <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">Añadir usuario</a>
    </div>
   <!-- Formulario de Búsqueda -->
   <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar artistas por nie o email..." value="{{ request()->search }}">
        <button type="submit" class="btn btn-outline-primary me-2">
            <i class="bi bi-search"></i> Buscar
        </button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Resetear Búsqueda
        </a>
    </form>
    <!-- Tabla de Usuarios -->
    <table class="table table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>NIE</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->nie }}</td>
                    <td>{{ $usuario->role ? $usuario->role->nombre : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron usuarios.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fas fa-home me-2"></i>Volver a la Página Principal</a>
    </div>
</div>
@endsection
