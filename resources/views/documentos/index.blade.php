@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/documentos/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

<h1>Explorador de Documentos</h1>

<p>Ruta actual: 
    @if($parent_id)
        @php $ruta = []; $carpeta = \App\Models\Carpeta::find($parent_id); @endphp
        @while($carpeta)
            @php $ruta[] = $carpeta->nombre; @endphp
            @php $carpeta = $carpeta->parent; @endphp
        @endwhile
        {{ implode(' > ', array_reverse($ruta)) }}
    @else
        Raíz
    @endif
</p>

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