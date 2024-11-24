@extends('layouts.app')

@section('title', 'Detalles de la Obra - ' . $obra->titulo)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ asset('storage/' . $obra->imagen) }}" class="card-img-top img-fluid" alt="Imagen de {{ $obra->titulo }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $obra->titulo }}</h3>
                    <p class="card-text">{{ $obra->descripcion }}</p>
                    <p><strong>Año:</strong> {{ $obra->año }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($obra->estado) }}</p>
                    <p><strong>Precio:</strong> €{{ number_format($obra->precio, 2) }}</p>
                    <button class="btn btn-primary">Añadir al Carrito</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Más información del artista:</h4>
            <p><strong>Artista:</strong> {{ $obra->artista->nombre }}</p>
            <p><strong>Biografía:</strong> {{ $obra->artista->biografia }}</p>
            <p><strong>Nacionalidad:</strong> {{ $obra->artista->nacionalidad }}</p>

            <!-- Sección de favoritos -->
            <div class="mt-4">
                @auth
                    <button id="favoritoButton" class="btn btn-link p-0">
                        <i class="bi {{ auth()->user()->obrasFavoritas->contains($obra->id) ? 'bi-star-fill' : 'bi-star' }} text-warning" 
                           style="font-size: 2rem;"></i>
                    </button>
                    <form id="favoritoForm" action="{{ auth()->user()->obrasFavoritas->contains($obra->id) ? route('favoritos.obras.remove', $obra->id) : route('favoritos.obras.add', $obra->id) }}" method="POST" style="display: none;">
                        @csrf
                        @if (auth()->user()->obrasFavoritas->contains($obra->id))
                            @method('DELETE')
                        @endif
                    </form>
                @else
                    <p class="mt-4"><a href="{{ route('login') }}" class="text-primary">Inicia sesión</a> para añadir a favoritos.</p>
                @endauth
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">Volver a la Tienda</a>
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

