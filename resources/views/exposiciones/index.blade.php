@extends('layouts.app')

@section('title', 'Listado de Exposiciones')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Listado de Exposiciones</h2>

    <!-- Mensajes de Éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Botón para Añadir Nueva Exposición (solo para Administrador) -->
    @auth('web')
        @if(auth()->guard('web')->user()->role && auth()->guard('web')->user()->role->nombre === 'Administrador')
            <div class="mb-4 text-end">
                <a href="{{ route('exposiciones.create') }}" class="btn btn-success">Añadir Nueva Exposición</a>
            </div>
        @endif
    @endauth

    <!-- Formulario de Búsqueda -->
    <form action="{{ route('artistas.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar exposiciones por nombre..." value="{{ request()->search }}">
        <button type="submit" class="btn btn-outline-primary me-2">
            <i class="bi bi-search"></i> Buscar
        </button>
        <a href="{{ route('artistas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Resetear Búsqueda
        </a>
    </form>

    @if($exposiciones->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            No hay exposiciones disponibles.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Finalización</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exposiciones as $exposicion)
                        <tr>
                            <td>{{ $exposicion->titulo }}</td>
                            <td>{{ Str::limit($exposicion->descripcion, 50) }}</td>
                            <td>{{ $exposicion->fecha_inicio }}</td>
                            <td>{{ $exposicion->fecha_finalizacion }}</td>
                            <td class="text-center">
                                <!-- Todos los usuarios pueden ver la exposición -->
                                <a href="{{ route('exposiciones.show', $exposicion->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Ver
                                </a>

                                <!-- Editar y Eliminar solo disponibles para Administrador -->
                                @auth('web')
                                    @if(auth()->guard('web')->user()->role && auth()->guard('web')->user()->role->nombre === 'Administrador')
                                        <a href="{{ route('exposiciones.edit', $exposicion->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <form action="{{ route('exposiciones.destroy', $exposicion->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta exposición?')">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $exposiciones->links('pagination::bootstrap-5') }}
        </div>
    @endif
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fas fa-home me-2"></i>Volver a la Página Principal</a>
    </div>
</div>
@endsection
