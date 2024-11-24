<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Exposición</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Dragula CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css">
    <!-- jQuery y Dragula JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Crear Nueva Exposición</h2>

        <form action="{{ route('exposiciones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
            </div>

            <!-- Fechas -->
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
            </div>

            <div class="mb-3">
                <label for="fecha_finalizacion" class="form-label">Fecha de Finalización:</label>
                <input type="date" name="fecha_finalizacion" id="fecha_finalizacion" class="form-control" value="{{ old('fecha_finalizacion') }}" required>
            </div>

            <!-- Artistas Participantes - Drag & Drop -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <h4>Artistas Disponibles</h4>
                    <div id="artistasDisponibles" class="list-group border">
                        @foreach($artistas as $artista)
                            <div class="list-group-item" data-id="{{ $artista->id }}">{{ $artista->nombre }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Artistas Seleccionados</h4>
                    <div id="artistasSeleccionados" class="list-group border"></div>
                </div>
            </div>

            <!-- Campo oculto para almacenar los artistas seleccionados -->
            <input type="hidden" name="artistas" id="artistasInput">

            <!-- Botón para Guardar la Exposición -->
            <div class="d-grid mt-5">
                <button type="submit" class="btn morado">Crear Exposición</button>
            </div>
        </form>

        <!-- Botón para Volver -->
        <div class="text-center mt-3">
            <a href="{{ route('exposiciones.index') }}" class="btn morado">Volver a la Lista de Exposiciones</a>
        </div>
    </div>

    <!-- Script para activar Dragula -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar Dragula para arrastrar y soltar entre artistas disponibles y seleccionados
            var drake = dragula([document.getElementById('artistasDisponibles'), document.getElementById('artistasSeleccionados')], {
                moves: function (el, source, handle, sibling) {
                    return true; // Permitir siempre mover elementos
                }
            });

            // Actualizar el input oculto cuando un elemento se arrastra y se suelta
            drake.on('drop', function () {
                actualizarArtistasSeleccionados();
            });

            // Inicializar el valor en el campo oculto si hay artistas seleccionados por defecto
            actualizarArtistasSeleccionados();

            // Función para actualizar el campo oculto con los IDs de los artistas seleccionados
            function actualizarArtistasSeleccionados() {
                let artistasSeleccionados = [];
                document.querySelectorAll('#artistasSeleccionados .list-group-item').forEach(function(element) {
                    artistasSeleccionados.push(element.getAttribute('data-id'));
                });
                document.getElementById('artistasInput').value = artistasSeleccionados.join(',');
            }
        });
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
