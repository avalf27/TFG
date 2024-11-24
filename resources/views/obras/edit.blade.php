<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra de Arte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Obra de Arte</h1>

        <!-- Formulario para Editar Obra de Arte -->
        <form action="{{ route('obras.update', $obra->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" id="titulo" value="{{ old('titulo', $obra->titulo) }}" required>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" class="form-control" id="descripcion" required>{{ old('descripcion', $obra->descripcion) }}</textarea>
            </div>

            <!-- Año -->
            <div class="mb-3">
                <label for="año" class="form-label">Año:</label>
                <input type="date" name="año" class="form-control" id="año" value="{{ old('año', $obra->año) }}" required>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" name="precio" class="form-control" id="precio" value="{{ old('precio', $obra->precio) }}">
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="disponible" {{ old('estado', $obra->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="vendido" {{ old('estado', $obra->estado) == 'vendido' ? 'selected' : '' }}>Vendido</option>
                    <option value="no se vende" {{ old('estado', $obra->estado) == 'no se vende' ? 'selected' : '' }}>No se Vende</option>
                </select>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" name="imagen" class="form-control" id="imagen">
                @if($obra->imagen)
                    <img src="{{ asset('storage/' . $obra->imagen) }}" alt="{{ $obra->titulo }}" class="img-fluid mt-3" style="max-height: 200px;">
                @endif
            </div>

            <!-- Botón para Actualizar Obra -->
            <button type="submit" class="btn btn-primary">Actualizar Obra</button>
        </form>

        <!-- Botón para Volver al índice de Obras -->
        <div class="mt-4">
            <a href="{{ route('obras.index') }}" class="btn btn-secondary">Volver a la Lista de Obras</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
