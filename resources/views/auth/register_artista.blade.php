@extends('layouts.app')

@section('title', 'Registro de Artista')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Registro de Artista</h2>

    <!-- Mostrar mensaje de error de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.artista') }}" method="POST">
        @csrf

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <!-- Apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
        </div>

        <!-- NIE -->
        <div class="mb-3">
            <label for="nie" class="form-label">NIE:</label>
            <input type="text" name="nie" id="nie" class="form-control" value="{{ old('nie') }}" required>
        </div>

        <!-- Correo Electrónico -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <!-- Nacionalidad -->
        <div class="mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad:</label>
            <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{ old('nacionalidad') }}" required>
        </div>

        <!-- Biografía -->
        <div class="mb-3">
            <label for="biografia" class="form-label">Biografía:</label>
            <textarea name="biografia" id="biografia" class="form-control" rows="5" required>{{ old('biografia') }}</textarea>
        </div>

        <!-- Experiencia -->
        <div class="mb-3">
            <label for="experiencia" class="form-label">Nivel de Experiencia:</label>
            <select name="experiencia" id="experiencia" class="form-control" required>
                <option value="Principiante" {{ old('experiencia') == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                <option value="Intermedio" {{ old('experiencia') == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                <option value="Avanzado" {{ old('experiencia') == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                <option value="Experto" {{ old('experiencia') == 'Experto' ? 'selected' : '' }}>Experto</option>
            </select>
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- Botón para Registrarse -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Registrarse como Artista</button>
        </div>
    </form>
</div>
@endsection
