@extends('layouts.app')

@section('title', 'Mis Obras de Arte')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Mis Obras de Arte</h2>

    <!-- Botón para Crear Nueva Obra -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('obras.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Añadir Nueva Obra
        </a>
    </div>

    @if($obras->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            No tienes obras de arte disponibles.
        </div>
    @else
        <div class="row">
            @foreach($obras as $obra)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($obra->imagen)
                            <img src="{{ asset('storage/' . $obra->imagen) }}" class="card-img-top" alt="{{ $obra->titulo }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Imagen no disponible" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $obra->titulo }}</h5>
                            <p class="card-text">{{ Str::limit($obra->descripcion, 100) }}</p>
                            <a href="{{ route('obras.show', $obra->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta obra de arte?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
