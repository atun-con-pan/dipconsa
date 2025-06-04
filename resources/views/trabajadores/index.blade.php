@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trabajadores/index.css') }}">
@endpush

<h1>Trabajadores</h1>

<div class="container">

    <!-- Barra de búsqueda y botón -->
    <div class="header-tools">
        <input type="text" id="search-input" placeholder="Buscar trabajador..." value="{{ request('search') }}">
        @if(Auth::user()->rol === 'admin')
        <a href="{{ route('trabajadores.create') }}" class="add-btn">Agregar Trabajador</a>
        @endif
    </div>

    <!-- Contenedor de tarjetas -->
    <div class="card-grid" id="card-grid">
        @forelse ($trabajadores as $trabajador)
            <div class="user-card" data-name="{{ strtolower($trabajador->nombres) }}">
                <div class="avatar">{{ strtoupper(substr($trabajador->nombres, 0, 1)) }}</div>
                <div class="user-info">
                    <strong>{{ $trabajador->nombres }}</strong><strong>,</strong>
                    <strong>{{ $trabajador->apellidos }}</strong><br>
                    <span>{{ $trabajador->telefono }}</span><br>
                    <span>{{ $trabajador->email }}</span>
                </div>
                <a href="{{ route('trabajadores.show', $trabajador->id) }}" class="view-btn">Ver Detalles</a>
            </div>
        @empty
            <p>No hay trabajadores registrados.</p>
        @endforelse
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("search-input");
        const cards = document.querySelectorAll(".user-card");

        input.addEventListener("input", function () {
            const value = input.value.toLowerCase();

            cards.forEach(function (card) {
                const fullText = card.innerText.toLowerCase();

                if (fullText.includes(value)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });
</script>

@endsection