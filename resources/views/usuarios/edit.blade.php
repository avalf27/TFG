@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Usuario</h2>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}" required>
        </div>

        <!-- Apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos', $usuario->apellidos) }}" required>
        </div>

        <!-- Correo Electrónico -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}" required>
        </div>

        <!-- NIE -->
        <div class="mb-3">
            <label for="nie" class="form-label">NIE:</label>
            <input type="text" name="nie" id="nie" class="form-control" value="{{ old('nie', $usuario->nie) }}" required>
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña (déjalo en blanco si no quieres cambiarla):</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <!-- Rol -->
        <div class="mb-3">
            <label for="rol" class="form-label">Rol:</label>
            <select name="rol" id="rol" class="form-control">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $usuario->role && $usuario->role->id == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
