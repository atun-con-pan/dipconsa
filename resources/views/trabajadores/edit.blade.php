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

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" 
                value="{{ \Carbon\Carbon::parse($trabajador->fecha_nacimiento)->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="estado_civil" class="form-label">Estado civil</label>
            <select name="estado_civil" id="estado_civil" class="form-select" required>
                <option value="" disabled {{ $trabajador->estado_civil == null ? 'selected' : '' }}>Seleccione una opción</option>
                <option value="Casado" {{ $trabajador->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                <option value="Soltero" {{ $trabajador->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                <option value="Divorciado" {{ $trabajador->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                <option value="Unido" {{ $trabajador->estado_civil == 'Unido' ? 'selected' : '' }}>Unido</option>
            </select>
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

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo/Puesto</label>
            <select name="cargo" id="cargo" class="form-select" required>
                <option value="" disabled {{ $trabajador->cargo == null ? 'selected' : '' }}>Seleccione una opción</option>
                <option value="Gerente" {{ $trabajador->cargo == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                <option value="Ingeniero/a" {{ $trabajador->cargo == 'Ingeniero/a' ? 'selected' : '' }}>Ingeniero/a</option>
                <option value="Abogado/a" {{ $trabajador->cargo == 'Abogado/a' ? 'selected' : '' }}>Abogado/a</option>
                <option value="Arquitecto/a" {{ $trabajador->cargo == 'Arquitecto/a' ? 'selected' : '' }}>Arquitecto/a</option>
                <option value="Contador" {{ $trabajador->cargo == 'Contador' ? 'selected' : '' }}>Contador</option>
                <option value="Auditor" {{ $trabajador->cargo == 'Auditor' ? 'selected' : '' }}>Auditor</option>
                <option value="Tecnico" {{ $trabajador->cargo == 'Tecnico' ? 'selected' : '' }}>Técnico</option>
                <option value="Recepcionista" {{ $trabajador->cargo == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                <option value="Practicante" {{ $trabajador->cargo == 'Practicante' ? 'selected' : '' }}>Practicante</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="inicio" class="form-label">Inicio</label>
            <input type="date" name="inicio" id="inicio" class="form-control"
                value="{{ \Carbon\Carbon::parse($trabajador->inicio)->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="terminacion" class="form-label">Terminación</label>
            <input type="date" name="terminacion" id="terminacion" class="form-control"
                value="{{ \Carbon\Carbon::parse($trabajador->terminacion)->format('Y-m-d') }}" required>
        </div>

        <div>
            <label for="salario">Salario</label>
            <input type="text" name="salario" value="{{ $trabajador->salario }}" required>
        </div>

        <div class="mb-3">
            <label for="contrato" class="form-label">Contrato</label>
            <select name="contrato" id="contrato" class="form-select" required>
                <option value="" disabled {{ $trabajador->contrato == null ? 'selected' : '' }}>Seleccione una opción</option>
                <option value="Permanente" {{ $trabajador->contrato == 'Permanente' ? 'selected' : '' }}>Permanente</option>
                <option value="Temporal" {{ $trabajador->contrato == 'Temporal' ? 'selected' : '' }}>Temporal</option>
                <option value="Practicante" {{ $trabajador->contrato == 'Practicante' ? 'selected' : '' }}>Practicante</option>
            </select>
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

        <div class="d-flex justify-content-between">
            <a href="{{ route('trabajadores.index') }}" class="btn btn-secondary btn-md w-50 ms-2">Volver</a>
            <button type="submit" class="btn btn-primary btn-md w-50 me-2">Actualizar</button>
        </div>
    </form>
@endsection
