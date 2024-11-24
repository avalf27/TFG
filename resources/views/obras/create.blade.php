<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Obra de Arte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Nueva Obra de Arte</h1>

        <!-- Mostrar errores de validación -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Mostrar mensajes de éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para Crear una Nueva Obra de Arte -->
        <form action="{{ route('obras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Título de la Obra -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" id="titulo" value="{{ old('titulo') }}" required>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" class="form-control" id="descripcion" required>{{ old('descripcion') }}</textarea>
            </div>

            <!-- Año de la Obra -->
            <div class="mb-3">
                <label for="año" class="form-label">Año:</label>
                <input type="date" name="año" class="form-control" id="año" value="{{ old('año') }}" required>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" name="precio" class="form-control" id="precio" value="{{ old('precio') }}">
            </div>

            <!-- Estado de la Obra -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="vendido" {{ old('estado') == 'vendido' ? 'selected' : '' }}>Vendido</option>
                    <option value="no se vende" {{ old('estado') == 'no se vende' ? 'selected' : '' }}>No se Vende</option>
                </select>
            </div>

            <!-- Artista de la Obra -->
            @auth('web')
                @if(auth()->user()->role && auth()->user()->role->nombre === 'Administrador')
                    <div class="mb-3">
                        <label for="id_artista" class="form-label">Artista:</label>
                        <select name="id_artista" id="id_artista" class="form-control" required>
                            <option value="">Selecciona un artista</option>
                            @foreach($artistas as $artista)
                                <option value="{{ $artista->id }}" {{ old('id_artista') == $artista->id ? 'selected' : '' }}>
                                    {{ $artista->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endauth

            @auth('artista')
                <input type="hidden" name="id_artista" value="{{ auth()->guard('artista')->user()->id }}">
            @endauth

            <!-- Imagen de la Obra -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" name="imagen" class="form-control" id="imagen">
            </div>

            <button type="submit" class="btn btn-primary">Crear Obra</button>
        </form>

        <div class="mt-4">
            @if(auth()->guard('web')->check() && auth()->user()->role->nombre === 'Administrador')
                <a href="{{ route('obras.index') }}" class="btn btn-secondary">Volver a la Lista de Obras</a>
            @elseif(auth()->guard('artista')->check())
                <a href="{{ route('artista.mis-obras') }}" class="btn btn-secondary">Volver a Mis Obras</a>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
