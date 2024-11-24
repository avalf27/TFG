@extends('layouts.app')

@section('title', 'Crear Nuevo Usuario')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Crear Nuevo Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}">
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
        </div>

        <!-- Rol -->
        <div class="mb-3">
            <label for="rol" class="form-label">Rol:</label>
            <select name="rol" id="rol" class="form-control">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para Crear Usuario -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-success">Crear Usuario</button>
        </div>
    </form>

    <!-- Botón para Volver -->
    <div class="text-center mt-4">
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la Lista de Usuarios</a>
    </div>
</div>
@endsection
