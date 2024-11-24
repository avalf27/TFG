@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Artistas</h1>

    <!-- Botón para Crear Nuevo Artista (solo visible para Administrador) -->
    @auth('web')
        @if(auth()->guard('web')->user()->role->nombre === 'Administrador')
            <div class="mb-4 text-end">
                <a href="{{ route('artistas.create') }}" class="btn btn-success mb-3">Añadir Artista</a>
            </div>
        @endif
    @endauth

    <!-- Formulario de Búsqueda -->
    <form action="{{ route('artistas.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar artistas por nombre o nie..." value="{{ request()->search }}">
        <button type="submit" class="btn btn-outline-primary me-2">
            <i class="bi bi-search"></i> Buscar
        </button>
        <a href="{{ route('artistas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Resetear Búsqueda
        </a>
    </form>

    <!-- Mensaje de Éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Listado de Artistas -->
    @if($artistas->isEmpty())
        <p class="text-center text-muted">No se encontraron artistas.</p>
    @else
        <div class="row">
            @foreach($artistas as $artista)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $artista->nombre }}</h5>
                            <p class="card-text">{{ Str::limit($artista->biografia, 100) }}</p>
                            <a href="{{ route('artistas.show', $artista->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>

                            <!-- Botones de Editar y Eliminar (solo visibles para Administrador) -->
                            @auth('web')
                                @if(auth()->guard('web')->user()->role->nombre === 'Administrador')
                                    <a href="{{ route('artistas.edit', $artista->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('artistas.destroy', $artista->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este artista?');"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="d-flex flex-column align-items-center mt-4">
            <!-- Números de página -->
            <nav>
                <ul class="pagination pagination-lg">
                    {{ $artistas->links('pagination::bootstrap-5') }}
                </ul>
            </nav>
        </div>
    @endif
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fas fa-home me-2"></i>Volver a la Página Principal</a>
    </div>
</div>
@endsection
