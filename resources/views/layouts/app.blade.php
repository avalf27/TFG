<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Estudio Prisma - Galería de Arte')</title>
    <link rel="icon" href="{{ asset('storage/imagenes/logo_tfg-removebg-preview (1).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-bottom: 20px; /* Espacio para evitar que el contenido esté demasiado pegado al footer */
        }

        footer {
            background: #222;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Contenido Principal -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Pie de Página -->
    <footer class="container-fluid bg-dark text-white mt-5 py-4">
        <div class="row">
            <div class="col-md-4">
                <h5>Dirección:</h5>
                <p>Calle La Loma, 13</p>
                <h5>Email:</h5>
                <p>contacto@estudioprisma.com</p>
                <h5>Teléfono:</h5>
                <p>+34 123 456 789</p>
            </div>
            <div class="col-md-4 text-center">
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-linkedin fa-2x"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
