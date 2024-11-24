<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Exposición</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Dragula CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css">
    <!-- Hoja de estilos personalizada -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
@extends('layouts.app')

@section('title', 'Editar Exposición - ' . $exposicion->titulo)

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Exposición: {{ $exposicion->titulo }}</h1>

    <form action="{{ route('exposiciones.update', $exposicion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Información General de la Exposición -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $exposicion->titulo) }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $exposicion->descripcion) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $exposicion->fecha_inicio) }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_finalizacion" class="form-label">Fecha de Finalización:</label>
            <input type="date" name="fecha_finalizacion" id="fecha_finalizacion" class="form-control" value="{{ old('fecha_finalizacion', $exposicion->fecha_finalizacion) }}" required>
        </div>

        <!-- Artistas Participantes - Drag & Drop -->
        <div class="row mt-5">
            <div class="col-md-6">
                <h4>Artistas Disponibles</h4>
                <div id="artistasDisponibles" class="list-group border">
                    @foreach($artistas as $artista)
                        @if(!$exposicion->artistas->contains($artista->id))
                            <div class="list-group-item" data-id="{{ $artista->id }}" data-tipo="artista">{{ $artista->nombre }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h4>Artistas Seleccionados</h4>
                <div id="artistasSeleccionados" class="list-group border">
                    @foreach($exposicion->artistas as $artista)
                        <div class="list-group-item" data-id="{{ $artista->id }}" data-tipo="artista">{{ $artista->nombre }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Campo oculto para almacenar los artistas seleccionados -->
        <input type="hidden" name="artistas" id="artistasInput" value="{{ old('artistas', $exposicion->artistas->pluck('id')->implode(',')) }}">

        <!-- Obras de Arte Participantes -->
        <div class="row mt-5">
            <div class="col-md-6">
                <h4>Obras Disponibles</h4>
                <div id="obrasDisponibles" class="list-group border">
                    @foreach($obras as $obra)
                        @if(!$exposicion->obras->contains($obra->id) && $exposicion->artistas->contains($obra->id_artista))
                            <div class="list-group-item" data-id="{{ $obra->id }}" data-artista-id="{{ $obra->id_artista }}" data-tipo="obra">{{ $obra->titulo }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h4>Obras Seleccionadas</h4>
                <div id="obrasSeleccionadas" class="list-group border">
                    @foreach($exposicion->obras as $obra)
                        <div class="list-group-item" data-id="{{ $obra->id }}" data-artista-id="{{ $obra->id_artista }}" data-tipo="obra">{{ $obra->titulo }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Campo oculto para almacenar las obras seleccionadas -->
        <input type="hidden" name="obras" id="obrasInput" value="{{ old('obras', $exposicion->obras->pluck('id')->implode(',')) }}">

        <!-- Botón para Guardar la Exposición -->
        <div class="d-grid mt-5">
            <button type="submit" class="btn btn-morado">Actualizar Exposición</button>
        </div>
    </form>

    <!-- Botón para Volver -->
    <div class="text-center mt-3">
        <a href="{{ route('exposiciones.index') }}" class="btn btn-morado">Volver a la Lista de Exposiciones</a>
    </div>
</div>
@endsection

<!-- Scripts de Bootstrap, jQuery y Dragula -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inicializar Dragula
    if (typeof dragula === 'undefined') {
        console.error("Dragula no se cargó correctamente");
        return;
    }

    // Inicializar dragula para las listas de artistas y obras
    var drake = dragula([
        document.getElementById('artistasDisponibles'), 
        document.getElementById('artistasSeleccionados'), 
        document.getElementById('obrasDisponibles'), 
        document.getElementById('obrasSeleccionadas')
    ]);

    // Evento que se ejecuta al soltar un elemento (artista u obra)
    drake.on('drop', function (el, target, source, sibling) {
        // Actualizar artistas seleccionados
        actualizarArtistasSeleccionados();

        // Actualizar las obras disponibles basadas en los artistas seleccionados
        actualizarObrasDisponibles();
    });

    function actualizarArtistasSeleccionados() {
        // Recolectar todos los IDs de artistas seleccionados
        let artistasSeleccionados = [];
        document.querySelectorAll('#artistasSeleccionados .list-group-item').forEach(function (element) {
            artistasSeleccionados.push(element.getAttribute('data-id'));
        });

        // Actualizar el valor del input oculto de artistas
        document.getElementById('artistasInput').value = artistasSeleccionados.join(',');

        // Llamar a la actualización de las obras disponibles
        actualizarObrasDisponibles();
    }

    function actualizarObrasDisponibles() {
        // Obtener los IDs de los artistas seleccionados
        let artistasSeleccionados = document.getElementById('artistasInput').value.split(',').map(Number);

        // Mostrar u ocultar las obras de acuerdo con los artistas seleccionados
        document.querySelectorAll('#obrasDisponibles .list-group-item').forEach(function (element) {
            let artistaIdObra = parseInt(element.getAttribute('data-artista-id'));

            // Mostrar solo las obras cuyo artista esté seleccionado
            if (artistasSeleccionados.includes(artistaIdObra)) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        });

        // Recolectar todas las obras que están seleccionadas y verificar si sus artistas aún están seleccionados
        let obrasSeleccionadas = [];
        document.querySelectorAll('#obrasSeleccionadas .list-group-item').forEach(function (element) {
            let artistaIdObra = parseInt(element.getAttribute('data-artista-id'));

            // Si el artista de la obra seleccionada ya no está seleccionado, mover la obra de vuelta a obras disponibles
            if (!artistasSeleccionados.includes(artistaIdObra)) {
                document.getElementById('obrasDisponibles').appendChild(element);
                element.style.display = 'block';
            } else {
                obrasSeleccionadas.push(element.getAttribute('data-id'));
            }
        });

        // Actualizar el valor del input oculto de obras seleccionadas
        document.getElementById('obrasInput').value = obrasSeleccionadas.join(',');
    }

    // Inicializar valores al cargar la página
    actualizarArtistasSeleccionados();
    actualizarObrasDisponibles();
});
</script>


</body>
</html>
