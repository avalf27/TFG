<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Arte - Navbar</title>
    <!-- Enlace a Bootstrap CSS desde jsDelivr CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        /* Fondo degradado para el navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        /* Estilos del enlace de usuario */
        .navbar .nav-link {
            color: #ffffff;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s;
            spacing
        }

        .navbar .nav-link:hover {
            color: #d1c4e9;
        }

        /* Dropdown menu personalizado */
        .dropdown-menu {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Estilo de los elementos dentro del dropdown */
        .dropdown-item {
            color: #6c757d;
            padding: 10px 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-item:hover {
            background-color: #667eea;
            color: #ffffff;
        }

        /* Botón de cerrar sesión */
        .dropdown-item#logout-link {
            color: #e57373;
        }

        .dropdown-item#logout-artist-link {
            color: #e57373;
        }

        .dropdown-item#logout-artist-link:hover {
            background-color: #e57373;
            color: #ffffff;
        }

        .dropdown-item#logout-link:hover {
            background-color: #e57373;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegación con Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"> <img src="{{ asset('storage/imagenes/logo_tfg-removebg-preview (1).png') }}" alt="Logo" width="100" height="100" class="me-2"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Links para Administradores -->
                    @auth('web')
                        @if(auth()->guard('web')->user()->role->nombre === 'Administrador')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('roles.index') }}">Gestionar Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('exposiciones.index') }}">Gestionar Exposiciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">Gestionar Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('obras.index') }}">Gestionar Obras de Arte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('artistas.index') }}">Gestionar Artistas</a>
                            </li>
                        @endif
                    @endauth

                    <!-- Links para Usuarios Registrados -->
                    @auth('web')
                        @if(auth()->guard('web')->user()->role && auth()->guard('web')->user()->role->nombre === 'Usuario')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('obras.index') }}">Ver Obras de Arte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('artistas.index') }}">Ver Artistas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('exposiciones.index') }}">Ver Exposiciones</a>
                            </li>
                        @endif
                    @endauth

                    <!-- Links para Artistas -->
                    @auth('artista')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('artista.mis-obras') }}">Mis Obras de Arte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('artista.mis-exposiciones') }}">Mis Exposiciones</a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!-- Links visibles solo para invitados -->
                    @guest('web')
                        @guest('artista')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrarse como Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register.artista') }}">Registrarse como Artista</a>
                            </li>
                        @endguest
                    @endguest

                    <!-- Dropdown con el nombre del usuario o artista logueado y opciones adicionales -->
                    @auth('web')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->guard('web')->user()->nombre }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                                <li>
                                    <a href="#" class="dropdown-item" id="logout-link">Cerrar Sesión</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    @auth('artista')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="artistDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->guard('artista')->user()->nombre }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="artistDropdown">
                                <li><a class="dropdown-item" href="{{ route('artista.profile.show') }}">Perfil</a></li>
                                <li>
                                    <a href="#" class="dropdown-item" id="logout-artist-link">Cerrar Sesión</a>
                                    <form id="logout-artist-form" action="{{ route('artista.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const logoutLink = document.querySelector('#logout-link');
                                const logoutArtistLink = document.querySelector('#logout-artist-link');

                                if (logoutLink) {
                                    logoutLink.addEventListener('click', function (e) {
                                        e.preventDefault();
                                        document.querySelector('#logout-form').submit();
                                    });
                                }

                                if (logoutArtistLink) {
                                    logoutArtistLink.addEventListener('click', function (e) {
                                        e.preventDefault();
                                        document.querySelector('#logout-artist-form').submit();
                                    });
                                }
                            });
                    </script>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Script de Bootstrap y lógica para manejar el logout -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
