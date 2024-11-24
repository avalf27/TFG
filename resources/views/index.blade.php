<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

    @if($usuarios->isEmpty())
        <p>No hay usuarios registrados.</p>
    @else
        <ul>
            @foreach($usuarios as $usuario)
                <li>{{ $usuario->nombre }} {{ $usuario->apellidos }} - {{ $usuario->email }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
