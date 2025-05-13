@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/documentos/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

<h1>Explorador de Documentos</h1>

<!-- Ruta actual -->
<p>Ruta actual: 
    @if($parent_id)
        @php 
            $ruta = []; 
            $carpeta = \App\Models\Carpetas::find($parent_id); 
        @endphp
        @while($carpeta)
            @php $ruta[] = $carpeta; @endphp
            @php $carpeta = $carpeta->padre; @endphp
        @endwhile

        <!-- Agregar la opción de 'Raíz' -->
        <a href="{{ route('documentos.index') }}">Raíz</a> >
        
        @foreach(array_reverse($ruta) as $item)
            @if($loop->last)
                {{ $item->nombre }} <!-- Última carpeta no es un enlace -->
            @else
                <a href="{{ route('documentos.index', ['parent_id' => $item->id]) }}">{{ $item->nombre }}</a> > 
            @endif
        @endforeach
    @else
        <!-- Aquí mostramos el enlace de la raíz -->
        <a href="{{ route('documentos.index') }}">Raíz</a>
    @endif
</p>

<!-- BOTÓN RETROCEDER -->
@if($parent_id)
    @php
        $carpetaActual = \App\Models\Documentos::find($parent_id);
    @endphp
    @if($carpetaActual && $carpetaActual->padre)
        <a href="{{ route('documentos.index', ['parent_id' => $carpetaActual->padre->id]) }}">
            <button>Retroceder</button>
        </a>
    @else
        {{-- Estamos en la primera carpeta después de la raíz --}}
        <a href="{{ route('documentos.index') }}">
            <button>Retroceder</button>
        </a>
    @endif
@endif

<!-- Formulario para crear nueva carpeta -->
<h3>Crear nueva carpeta</h3>
<form method="POST" action="{{ route('documentos.crear-carpeta') }}">
    @csrf
    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
    <input type="text" name="nombre" placeholder="Nombre de la nueva carpeta" required>
    <button type="submit">Crear</button>
</form>

<!-- Listar carpetas -->
<h2>Carpetas:</h2>
<ul>
    @foreach ($carpetas as $carpeta)
        <li>
            <a href="{{ route('documentos.index', ['parent_id' => $carpeta->id]) }}">{{ $carpeta->nombre }}</a>
        </li>
    @endforeach
</ul>
@endsection