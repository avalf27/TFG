@extends('layouts.app')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detalles del Usuario: {{ $usuario->nombre }}</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->fecha_nacimiento }}</p>
            <p><strong>Rol:</strong> {{ $usuario->role ? $usuario->role->nombre : 'N/A' }}</p>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la Lista de Usuarios</a>
    </div>
</div>
@endsection
