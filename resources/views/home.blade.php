@extends('layouts.app')

@section('title', 'Estudio Prisma - Tienda')

@section('content')
    <!-- Título principal -->
    <div class="container-fluid bg-light text-center py-5">
        <h1 class="display-3 fw-bold">ESTUDIO PRISMA</h1>
    </div>
     <!-- Filtro de Búsqueda -->
     <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold">TIENDA</h2>
            </div>
            <div class="col-md-6 text-end">
                <h4>Filtrar por</h4>
                <!-- Formulario de Búsqueda -->
                <form action="{{ route('home') }}" method="GET" class="d-flex mb-3">
                    <input type="text" name="search" class="form-control me-2" placeholder="Buscar obras por nombre..." value="{{ request()->search }}">
                    <button type="submit" class="btn btn-outline-primary me-2">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Resetear Búsqueda
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!-- Carrusel de Obras de Arte -->
<!-- Carrusel de Obras de Arte -->
<div class="container mt-5">
    <div class="rounded-3 overflow-hidden" style="border-radius: 20px;">
        <div id="obrasCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($obras as $index => $obra)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $obra->imagen) }}" class="d-block w-100" alt="{{ $obra->titulo }}" style="height: 500px; object-fit: cover; border-radius: 20px;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0)); bottom: 0; left: 0; right: 0; padding: 20px;">
                            <h5 class="text-white text-shadow" style="font-size: 1.8em; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);">{{ $obra->titulo }}</h5>
                            <p>
                                <a href="{{ route('obras.show', $obra->id) }}" class="btn btn-light rounded-pill shadow-sm" style="padding: 10px 20px;">Ver más</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controles del Carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#obrasCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#obrasCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
