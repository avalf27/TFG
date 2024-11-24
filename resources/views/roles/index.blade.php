@extends('layouts.app') <!-- Extiende de un layout principal, si tienes uno -->

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Lista de Roles</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar la lista de roles -->
    <div class="row">
        <div class="col-md-12">
            @if($roles->isEmpty())
                <div class="alert alert-info">
                    No hay roles disponibles.
                </div>
            @else
            <!-- Botón para crear un nuevo rol -->
            <div class="mb-4 text-end">
                <a href="{{ route('roles.create') }}" class="btn btn-success">Crear Nuevo Rol</a>
            </div>
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre del Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $rol)
                            <tr>
                                <td>{{ $rol->id }}</td>
                                <td>{{ $rol->nombre }}</td>
                                <td>
                                    <!-- Enlace para editar el rol -->
                                    <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    
                                    <!-- Formulario para eliminar el rol -->
                                    <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este rol?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fas fa-home me-2"></i>Volver a la Página Principal</a>
    </div>
</div>
@endsection
