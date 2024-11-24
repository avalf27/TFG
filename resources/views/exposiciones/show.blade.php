@extends('layouts.app')

@section('title', 'Detalles de la Exposición - ' . $exposicion->titulo)

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detalles de la Exposición: {{ $exposicion->titulo }}</h1>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Información Principal de la Exposición -->
    <div class="card">
        <div class="card-header">
            <h2>{{ $exposicion->titulo }}</h2>
        </div>
        <div class="card-body">
            <!-- Imagen de la exposición -->
            @if($exposicion->imagen)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $exposicion->imagen) }}" alt="{{ $exposicion->titulo }}" class="img-fluid" style="max-height: 300px;">
                </div>
            @endif

            <!-- Descripción -->
            <p><strong>Descripción:</strong> {{ $exposicion->descripcion }}</p>

            <!-- Fechas -->
            <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($exposicion->fecha_inicio)->format('d/m/Y') }}</p>
            <p><strong>Fecha de Finalización:</strong> {{ \Carbon\Carbon::parse($exposicion->fecha_finalizacion)->format('d/m/Y') }}</p>

            <!-- Artistas Participantes -->
            <div class="mt-4">
                <h4>Artistas Participantes:</h4>
                <ul class="list-group">
                    @forelse($exposicion->artistas as $artista)
                        <li class="list-group-item">
                            {{ $artista->nombre }}
                        </li>
                    @empty
                        <li class="list-group-item">No hay artistas asociados a esta exposición.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Obras Asociadas -->
            <div class="mt-4">
                <h4>Obras de Arte en la Exposición:</h4>
                <ul class="list-group">
                    @forelse($exposicion->obras as $obra)
                        <li class="list-group-item">{{ $obra->titulo }}</li>
                    @empty
                        <li class="list-group-item">No hay obras de arte asociadas a esta exposición.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Opciones de Edición (Solo para Administradores) -->
            @auth('web')
                @if(auth()->guard('web')->user()->role->nombre === 'Administrador')
                    <div class="mt-4 text-center">
                        <a href="{{ route('exposiciones.edit', $exposicion->id) }}" class="btn btn-warning">Editar Exposición</a>
                        <form action="{{ route('exposiciones.destroy', $exposicion->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta exposición?');">Eliminar Exposición</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Sección de Favoritos -->
    <div class="mt-4 text-center">
        @auth('web')
            @php
                $user = auth()->guard('web')->user();
            @endphp
        @endauth

        @auth('artista')
            @php
                $user = auth()->guard('artista')->user();
            @endphp
        @endauth

        @if (isset($user))
            <button id="favoritoButton" class="btn btn-link p-0">
                <i class="bi {{ $user->exposicionesFavoritas->contains($exposicion->id) ? 'bi-star-fill' : 'bi-star' }} text-warning" style="font-size: 2rem;"></i>
            </button>
            <form id="favoritoForm" action="{{ $user->exposicionesFavoritas->contains($exposicion->id) ? route('favoritos.exposiciones.remove', $exposicion->id) : route('favoritos.exposiciones.add', $exposicion->id) }}" method="POST" style="display: none;">
                @csrf
                @if ($user->exposicionesFavoritas->contains($exposicion->id))
                    @method('DELETE')
                @endif
            </form>
        @else
            <p class="mt-4"><a href="{{ route('login') }}" class="text-primary">Inicia sesión</a> para añadir a favoritos.</p>
        @endif
    </div>


    <!-- Botón para Volver a la Lista de Exposiciones -->
    <div class="text-center mt-4">
        <a href="{{ route('exposiciones.index') }}" class="btn btn-secondary">Volver a la Lista de Exposiciones</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const favoritoButton = document.getElementById('favoritoButton');
        const favoritoForm = document.getElementById('favoritoForm');

        if (favoritoButton && favoritoForm) {
            favoritoButton.addEventListener('click', function (e) {
                e.preventDefault();
                favoritoForm.submit();
            });
        } else {
            console.error('No se encontraron el botón o el formulario de favoritos.');
        }
    });
</script>
@endsection


