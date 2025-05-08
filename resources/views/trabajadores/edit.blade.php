@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('../css/trabajadores/edit.css') }}">
    @endpush
    <h1>Editar Trabajador</h1>

    <form action="{{ route('trabajadores.update', $trabajador->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="{{ $trabajador->nombre }}" required>
        </div>

        <div>
            <label for="cargo">Cargo</label>
            <input type="text" name="cargo" value="{{ $trabajador->cargo }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $trabajador->email }}" required>
        </div>

        <div>
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" value="{{ $trabajador->telefono }}" required>
        </div>

        <div>
            <label for="archivo">Archivo</label>
            @if ($trabajador->archivo)
                <p><a href="{{ asset('storage/' . $trabajador->archivo) }}" target="_blank">Ver archivo actual</a></p>
            @endif
            <input type="file" name="archivo">
        </div>

        <div>
            <button type="submit">Actualizar</button>
        </div>
    </form>
@endsection
