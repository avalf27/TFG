@extends('layouts.app')

@section('title', 'Obras de Arte')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center mb-0">Obras de Arte</h1>
    </div>

    <!-- Botón para Crear Nueva Obra de Arte (solo para Administrador) -->
    @auth('web')
        @if(auth()->guard('web')->user()->role && auth()->guard('web')->user()->role->nombre === 'Administrador')
            <div class="mb-4 text-end">
                <a href="{{ route('obras.create') }}" class="btn btn-success">Añadir Nueva Obra de Arte</a>
            </div>
        @endif
    @endauth

    <!-- Formulario de Búsqueda -->
    <form action="{{ route('artistas.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar obras por nombre..." value="{{ request()->search }}">
        <button type="submit" class="btn btn-outline-primary me-2">
            <i class="bi bi-search"></i> Buscar
        </button>
        <a href="{{ route('artistas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Resetear Búsqueda
        </a>
    </form>

    <!-- Mensajes de Éxito o Error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Grid de Obras de Arte -->
    <div class="row">
        @forelse($obras as $obra)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!-- Imagen de la Obra de Arte -->
                    @if($obra->imagen)
                        <img src="{{ asset('storage/' . $obra->imagen) }}" class="card-img-top" alt="{{ $obra->titulo }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Imagen no disponible" style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $obra->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($obra->descripcion, 100) }}</p>
                        <p class="card-text"><strong>Precio: </strong>{{ $obra->precio ? '€' . number_format($obra->precio, 2) : 'No Disponible' }}</p>
                        <p class="card-text"><strong>Estado: </strong>{{ $obra->estado }}</p>

                        <!-- Botones de Ver, Editar y Eliminar -->
                        @auth
                            <!-- Botón de "Ver" accesible para todos los usuarios registrados (usuarios y artistas) -->
                            <a href="{{ route('obras.show', $obra->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            
                            <!-- Botones de "Editar" y "Eliminar" solo para el rol de Administrador -->
                            @if(auth()->user()->role && auth()->user()->role->nombre === 'Administrador')
                                <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta obra de arte?');">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No hay obras de arte disponibles.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex flex-column align-items-center mt-4">
        <!-- Números de página -->
        <nav>
            <ul class="pagination pagination-lg">
                {{ $obras->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </ul>
        </nav>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fas fa-home me-2"></i>Volver a la Página Principal</a>
    </div>
</div>
@endsection
