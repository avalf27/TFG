@extends('layouts.app')

@section('title', 'Perfil del Usuario')

@section('content')
<style>
    /* Estilo general de la página */
    body {
        background-color: #f3f4f6; /* Color de fondo claro para mayor contraste */
    }

    /* Encabezado del Perfil */
    .profile-header {
        background-color: #6c63ff; /* Color morado llamativo */
        color: white;
        padding: 20px;
        border-radius: 10px;
    }

    /* Estilo para las pestañas de navegación */
    .nav-tabs .nav-link {
        color: #6c757d; /* Gris predeterminado */
        font-weight: bold;
    }
    .nav-tabs .nav-link.active {
        background-color: #6c63ff; /* Color morado llamativo */
        color: white;
    }

    /* Tarjetas para favoritos */
    .card {
        border: none;
        border-radius: 10px;
    }
    .card-title {
        color: #333; /* Título de las tarjetas en color más oscuro */
        font-weight: bold;
    }

    /* Botones */
    .btn-primary {
        background-color: #6c63ff; /* Color morado llamativo */
        border-color: #6c63ff;
    }
    .btn-primary:hover {
        background-color: #4c4bd9; /* Variación más oscura en hover */
        border-color: #4c4bd9;
    }

    .btn-secondary {
        background-color: #ff6f61; /* Color rojo anaranjado llamativo */
        border-color: #ff6f61;
        color: white;
    }
    .btn-secondary:hover {
        background-color: #e55b4d; /* Variación más oscura en hover */
        border-color: #e55b4d;
    }

    /* Alertas de éxito y error */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Listas de favoritos */
    .list-group-item {
        background-color: #ffffff;
        border: 1px solid #ddd;
    }
    .list-group-item a {
        color: #6c63ff; /* Color de enlace */
        font-weight: bold;
    }
    .list-group-item a:hover {
        text-decoration: underline;
    }

    /* Sombra en las tarjetas */
    .card.shadow-sm {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container mt-5">
    <!-- Encabezado del Perfil -->
    <div class="profile-header text-center mb-4">
        <h2>Perfil del Usuario</h2>
        <p>Administra tus datos y favoritos</p>
    </div>

    <!-- Pestañas de Navegación -->
    <ul class="nav nav-tabs justify-content-center mb-3" id="profileTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="update-profile-tab" data-bs-toggle="tab" data-bs-target="#update-profile" type="button" role="tab" aria-controls="update-profile" aria-selected="true">
                <i class="fas fa-user-edit me-2"></i>Actualizar Perfil
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="favorites-tab" data-bs-toggle="tab" data-bs-target="#favorites" type="button" role="tab" aria-controls="favorites" aria-selected="false">
                <i class="fas fa-heart me-2"></i>Favoritos
            </button>
        </li>
    </ul>

    <!-- Contenido de las Pestañas -->
    <div class="tab-content" id="profileTabContent">
        <!-- Actualizar Perfil -->
        <div class="tab-pane fade show active" id="update-profile" role="tabpanel" aria-labelledby="update-profile-tab">
            <!-- Mostrar mensaje de éxito o error -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', auth()->user()->nombre) }}" required>
                </div>

                <!-- Apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos', auth()->user()->apellidos) }}" required>
                </div>

                <!-- Correo Electrónico -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                 <!-- Fecha de Nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', auth()->user()->fecha_nacimiento) }}" required>
                </div>

                <!-- NIE -->
                <div class="mb-3">
                    <label for="nie" class="form-label">NIE:</label>
                    <input type="text" name="nie" id="nie" class="form-control" value="{{ old('nie', auth()->user()->nie) }}" required>
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña (déjalo en blanco si no quieres cambiarla):</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <!-- Botón para Actualizar Perfil -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                </div>
            </form>
        </div>

        <!-- Favoritos -->
        <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
            <div class="row">
                <!-- Exposiciones Favoritas -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-images me-2"></i>Exposiciones Favoritas</h4>
                            @if($exposicionesFavoritas->isEmpty())
                                <p class="text-muted">No tienes exposiciones favoritas.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($exposicionesFavoritas as $exposicion)
                                        <li class="list-group-item">
                                            <a href="{{ route('exposiciones.show', $exposicion->id) }}">{{ $exposicion->titulo }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Obras de Arte Favoritas -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-palette me-2"></i>Obras Favoritas</h4>
                            @if($obrasFavoritas->isEmpty())
                                <p class="text-muted">No tienes obras de arte favoritas.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($obrasFavoritas as $obra)
                                        <li class="list-group-item">
                                            <a href="{{ route('obras.show', $obra->id) }}">{{ $obra->titulo }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Artistas Favoritos -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-user-astronaut me-2"></i>Artistas Favoritos</h4>
                            @if($artistasFavoritos->isEmpty())
                                <p class="text-muted">No tienes artistas favoritos.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($artistasFavoritos as $artista)
                                        <li class="list-group-item">
                                            <a href="{{ route('artistas.show', $artista->id) }}">{{ $artista->nombre }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para Volver a la Página Principal -->
    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg"><i class="fas fa-home me-2"></i>Volver a la Página Principal</a>
    </div>
</div>
@endsection
