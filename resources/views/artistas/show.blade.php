@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $artista->nombre }} {{ $artista->apellidos }}</h1>
    <div class="mb-4">
        <p><strong>Nacionalidad:</strong> {{ $artista->nacionalidad }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($artista->fecha_nacimiento)->format('d/m/Y') }}</p>
        <p><strong>Experiencia:</strong> {{ $artista->experiencia }}</p>
    </div>
    
    <h3>Biografía</h3>
    <p>{{ $artista->biografia }}</p>

    <h3 class="mt-5">Obras de Arte del Artista</h3>
    @if($artista->obras->isEmpty())
        <p>No hay obras de este artista.</p>
    @else
        <ul class="list-group mb-4">
            @foreach($artista->obras as $obra)
                <li class="list-group-item">
                    <a href="{{ route('obras.show', $obra->id) }}">{{ $obra->titulo }}</a>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Añadir/Eliminar de Favoritos -->
    <div class="mt-4">
        @auth
            <button id="favoritoButton" class="btn btn-link p-0">
                <i class="bi {{ auth()->user()->artistasFavoritos->contains($artista->id) ? 'bi-star-fill' : 'bi-star' }} text-warning" 
                   style="font-size: 2rem;"></i>
            </button>
            <form id="favoritoForm" action="{{ auth()->user()->artistasFavoritos->contains($artista->id) ? route('artistas.removeFavorito', $artista->id) : route('artistas.favorito', $artista->id) }}" method="POST" style="display: none;">
                @csrf
                @if (auth()->user()->artistasFavoritos->contains($artista->id))
                    @method('DELETE')
                @endif
            </form>
        @else
            <p class="mt-4"><a href="{{ route('login') }}" class="text-primary">Inicia sesión</a> para añadir a favoritos.</p>
        @endauth
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
        }
    });
</script>

@endsection
