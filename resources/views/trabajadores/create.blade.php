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
            <input type="text" name="nombres" required autofocus>
        </div>

        <div>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" required>
        </div>

        <div>
            <label for="dpi">DPI</label>
            <input type="text" name="dpi" required>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado_civil" class="form-label">Estado civil</label>
            <select name="estado_civil" id="estado_civil" class="form-select" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Casado">Casado/a</option>
                <option value="Soltero">Soltero/a</option>
                <option value="Divorciado">Divorciado/a</option>
                <option value="Unido">Unido/a</option>
            </select>
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

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo/Puesto</label>
            <select name="cargo" id="cargo" class="form-select" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Gerente">Gerente</option>
                <option value="Ingeniero/a">Ingeniero/a</option>
                <option value="Abogado/a">Abogado/a</option>
                <option value="Arquitecto/a">Arquitecto/a</option>
                <option value="Contador">Contador/a</option>
                <option value="Auditor">Auditor/a</option>
                <option value="Tecnico">Técnico/a</option>
                <option value="Recepcionista">Recepcionista</option>
                <option value="Practicante">Practicante</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="inicio" class="form-label">Inicio</label>
            <input type="date" name="inicio" id="inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="terminacion" class="form-label">Terminación</label>
            <input type="date" name="terminacion" id="terminacion" class="form-control" required>
        </div>

        <div>
            <label for="salario">Salario</label>
            <input type="text" name="salario" required>
        </div>


        <div class="mb-3">
            <label for="contrato" class="form-label">Contrato</label>
            <select name="contrato" id="contrato" class="form-select" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Permanente">Permanente</option>
                <option value="Temporal">Temporal</option>
                <option value="Practicante">Practicante</option>
            </select>
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
            <button type="submit">Guardar</button>
        </div>
    </form>
@endsection