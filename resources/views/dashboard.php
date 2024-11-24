<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Galería de Arte</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Panel de Usuario Registrado</h1>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/logout">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Bienvenido, Usuario Registrado</h2>
        <p>Aquí puedes ver tus obras y compras.</p>
        <!-- Más contenido específico para usuarios registrados -->
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Galería de Arte. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
