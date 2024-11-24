<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol - Galería de Arte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">Editar Rol</h4>
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

                        <!-- Formulario para Editar Rol -->
                        <form action="{{ route('roles.update', $rol->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nombre del Rol -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Rol:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $rol->nombre) }}" required>
                                @error('nombre')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botón para Guardar Cambios -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                            </div>
                        </form>

                        <!-- Botón para Volver a la Lista de Roles -->
                        <div class="text-center">
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
