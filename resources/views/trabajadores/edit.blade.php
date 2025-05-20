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
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" value="{{ $trabajador->nombres }}" required>
        </div>

        <div>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="{{ $trabajador->apellidos }}" required>
        </div>

        <div>
            <label for="dpi">DPI</label>
            <input type="text" name="dpi" value="{{ $trabajador->dpi }}" required>
        </div>

        <div>
            <label for="fecha_nacimiento">Fecha nacimiento</label>
            <input type="text" name="fecha_nacimiento" value="{{ $trabajador->fecha_nacimiento }}" required>
        </div>

        <div>
            <label for="estado_civil">Estado civil</label>
            <input type="text" name="estado_civil" value="{{ $trabajador->estado_civil }}" required>
        </div>

        <div>
            <label for="residencia">Residencia</label>
            <input type="text" name="residencia" value="{{ $trabajador->residencia }}" required>
        </div>

        <div>
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" value="{{ $trabajador->telefono }}" required>
        </div>

        <div>
            <label for="email">E-mail</label>
            <input type="text" name="email" value="{{ $trabajador->email }}" required>
        </div>

        <div>
            <label for="cargo">Cargo/Puesto</label>
            <input type="text" name="cargo" value="{{ $trabajador->cargo }}" required>
        </div>

        <div>
            <label for="inicio">Inicio</label>
            <input type="text" name="inicio" value="{{ $trabajador->inicio }}" required>
        </div>

        <div>
            <label for="terminacion">Terminación</label>
            <input type="text" name="terminacion" value="{{ $trabajador->terminacion }}" required>
        </div>

        <div>
            <label for="salario">Salario</label>
            <input type="text" name="salario" value="{{ $trabajador->salario }}" required>
        </div>

        <div>
            <label for="contrato">Contrato</label>
            <input type="text" name="contrato" value="{{ $trabajador->contrato }}" required>
        </div>

        <div>
            <label for="jefe">Jefe inmediato</label>
            <input type="text" name="jefe" value="{{ $trabajador->jefe }}" required>
        </div>

        <div>
            <label for="cuenta_bancaria">No. Cuenta bancaria</label>
            <input type="text" name="cuenta_bancaria" value="{{ $trabajador->cuenta_bancaria }}" required>
        </div>

        <div>
            <label for="No_IGSS">No. IGSS</label>
            <input type="text" name="No_IGSS" value="{{ $trabajador->No_IGSS }}" required>
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
