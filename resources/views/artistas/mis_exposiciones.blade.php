@extends('layouts.app')

@section('title', 'Mis Exposiciones')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Exposiciones donde se encuentran mis Obras</h2>

    @if($exposiciones->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            No hay exposiciones disponibles con tus obras.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Finalización</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exposiciones as $exposicion)
                        <tr>
                            <td>{{ $exposicion->titulo }}</td>
                            <td>{{ Str::limit($exposicion->descripcion, 50) }}</td>
                            <td>{{ $exposicion->fecha_inicio }}</td>
                            <td>{{ $exposicion->fecha_finalizacion }}</td>
                            <td class="text-center">
                                <a href="{{ route('exposiciones.show', $exposicion->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
