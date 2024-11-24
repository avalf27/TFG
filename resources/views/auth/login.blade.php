@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<style>
    .login-form-wrapper {
        margin-top: 50px;
    }

    .login-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        padding: 20px;
        display:flex;
        justify-content:center;
    }

    .card-custom {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-buttons {
        padding: 10px;
    }


.tab-button {
    cursor: pointer;
    padding: 10px 20px;
    border: none;
    background: transparent; 
    color: rgba(255, 255, 255, 0.7); 
    transition: all 0.3s ease; 
    margin: 0 5px;
    box-shadow: none;
}


.tab-button.active {
    background: rgba(255, 255, 255, 0.2); 
    color: #ffffff; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
    border-radius: 8px; 
}


    .tab-button:hover {
        color: #ffffff;
    }

    .btn-inicio {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color:white;
    }
</style>

<div class="container login-form-wrapper">
    <div class="text-center mb-4">
        <h2>Iniciar Sesión</h2>
        <p>Elige si eres un Usuario o un Artista para iniciar sesión</p>
    </div>

    <div class="row justify-content-center">
        <!-- Contenedor de los dos formularios de login -->
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header login-header d-flex justify-content-center">
                    <!-- Botones para alternar entre el login de Usuario y Artista -->
                    <button class="tab-button active" id="user-login-tab">Usuario</button>
                    <button class="tab-button" id="artist-login-tab">Artista</button>
                </div>

                <div class="card-body">
                    <!-- Formulario de Usuario -->
                    <div id="user-login-form">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <!-- Botón para Iniciar Sesión -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-inicio">Iniciar Sesión como Usuario</button>
                            </div>
                        </form>
                    </div>

                    <!-- Formulario de Artista (oculto al inicio) -->
                    <div id="artist-login-form" style="display: none;">
                        <form action="{{ route('artista.login.post') }}" method="POST">
                            @csrf
                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="email_artista" class="form-label">Correo Electrónico:</label>
                                <input type="email" name="email" id="email_artista" class="form-control" required>
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password_artista" class="form-label">Contraseña:</label>
                                <input type="password" name="password" id="password_artista" class="form-control" required>
                            </div>

                            <!-- Botón para Iniciar Sesión -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-inicio">Iniciar Sesión como Artista</button>
                            </div>
                        </form>
                    </div>

                    <!-- Enlaces para Registrarse como Usuario o Artista -->
                    <div class="login-buttons mt-4 text-center">
                        <p>¿No tienes una cuenta?</p>
                        <a href="{{ route('register') }}" class="btn btn-link">Registrarse como Usuario</a>
                        <a href="{{ route('register.artista') }}" class="btn btn-link">Registrarse como Artista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para alternar los formularios de login -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Botones para alternar entre Usuario y Artista
        const userLoginTab = document.getElementById('user-login-tab');
        const artistLoginTab = document.getElementById('artist-login-tab');

        // Formularios de login
        const userLoginForm = document.getElementById('user-login-form');
        const artistLoginForm = document.getElementById('artist-login-form');

        // Evento al hacer click en el botón de Usuario
        userLoginTab.addEventListener('click', function () {
            userLoginTab.classList.add('active');
            artistLoginTab.classList.remove('active');
            userLoginForm.style.display = 'block';
            artistLoginForm.style.display = 'none';
        });

        // Evento al hacer click en el botón de Artista
        artistLoginTab.addEventListener('click', function () {
            artistLoginTab.classList.add('active');
            userLoginTab.classList.remove('active');
            artistLoginForm.style.display = 'block';
            userLoginForm.style.display = 'none';
        });
    });
</script>
@endsection
