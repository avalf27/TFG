@extends('layouts.app')

@section('title', 'Perfil del Artista')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Perfil del Artista</h2>

    <!-- Mostrar información del artista -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $artista->nombre }} {{ $artista->apellidos }}</h3>
                    <p><strong>NIE:</strong> {{ $artista->nie }}</p>
                    <p><strong>Nacionalidad:</strong> {{ $artista->nacionalidad }}</p>
                    <p><strong>Experiencia:</strong> {{ $artista->experiencia }}</p>
                    <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
