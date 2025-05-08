<!-- resources/views/trabajadores/create.blade.php -->

@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('../css/trabajadores/create.css') }}">
    @endpush
    <h1>Agregar Trabajador</h1>

    <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" required>
        </div>

        <div>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" required>
        </div>

        <div>
            <label for="dpi">DPI</label>
            <input type="text" name="dpi" required>
        </div>

        <div>
            <label for="fecha_nacimiento">Fecha nacimiento</label>
            <input type="text" name="fecha_nacimiento" required>
        </div>

        <div>
            <label for="estado_civil">Estado civil</label>
            <input type="text" name="estado_civil" required>
        </div>

        <div>
            <label for="residencia">Residencia</label>
            <input type="text" name="residencia" required>
        </div>

        <div>
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" required>
        </div>

        <div>
            <label for="email">E-mail</label>
            <input type="text" name="email" required>
        </div>

        <div>
            <label for="cargo">Cargo/Puesto</label>
            <input type="text" name="cargo" required>
        </div>

        <div>
            <label for="inicio">Inicio</label>
            <input type="text" name="inicio" required>
        </div>

        <div>
            <label for="terminacion">Terminación</label>
            <input type="text" name="terminacion" required>
        </div>

        <div>
            <label for="salario">Salario</label>
            <input type="text" name="salario" required>
        </div>

        <div>
            <label for="contrato">Contrato</label>
            <input type="text" name="contrato" required>
        </div>

        <div>
            <label for="jefe">Jefe inmediato</label>
            <input type="text" name="jefe" required>
        </div>

        <div>
            <label for="cuenta_bancaria">No. Cuenta bancaria</label>
            <input type="text" name="cuenta_bancaria" required>
        </div>

        <div>
            <label for="No_IGSS">No. IGSS</label>
            <input type="text" name="No_IGSS" required>
        </div>

        <div>
            <label for="archivo">Archivo</label>
            <input type="file" name="archivo">
        </div>

        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
@endsection