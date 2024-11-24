<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Artista</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Crear Nuevo Artista')

    @section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Nuevo Artista</h1>

        <form action="{{ route('artistas.store') }}" method="POST">
            @csrf

            <!-- Nombre del Artista -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <!-- Nacionalidad del Artista -->
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{ old('nacionalidad') }}" required>
            </div>

            <!-- Biografía del Artista -->
            <div class="mb-3">
                <label for="biografia" class="form-label">Biografía:</label>
                <textarea name="biografia" id="biografia" class="form-control" rows="5" required>{{ old('biografia') }}</textarea>
            </div>

            <!-- Botón para Guardar -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Guardar Artista</button>
            </div>
        </form>

        <!-- Botón para Volver a la Lista de Artistas -->
        <div class="text-center mt-3">
            <a href="{{ route('artistas.index') }}" class="btn btn-secondary">Volver a la Lista de Artistas</a>
        </div>
    </div>
    @endsection

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
