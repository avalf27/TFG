<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Galería de Arte</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Enlace a tu CSS -->
</head>
<body>
    <header>
        <h1>Iniciar Sesión</h1>
    </header>

    <main>
        <section class="login-form">
            <h2>Por favor ingresa tus datos</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required>
                </div>
                <div>
                    <button type="submit">Iniciar Sesión</button>
                </div>
                <div>
                    <a href="{{ url('/register') }}">¿No tienes cuenta? Regístrate aquí</a>
                </div>
                <p class="mt-3">
                    ¿Quieres registrarte como artista? <a href="{{ route('artistas.register.form') }}">Haz clic aquí</a>.
                </p>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Galería de Arte. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
