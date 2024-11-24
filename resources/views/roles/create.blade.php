<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Rol - Galería de Arte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Crear Nuevo Rol</h4>
                    </div>
                    <div class="card-body">
                        <!-- Mensaje de Éxito o Error -->
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

                        <!-- Formulario para Crear Rol -->
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf

                            <!-- Nombre del Rol -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Rol:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botón de Enviar -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Crear Rol</button>
                            </div>
                        </form>

                        <!-- Botón para Volver a la Lista de Roles -->
                        <div class="text-center mt-3">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver a la Lista de Roles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias opcionales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
