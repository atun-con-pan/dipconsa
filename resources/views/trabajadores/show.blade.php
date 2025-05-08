@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trabajadores/show.css') }}">
@endpush

<h1>Detalles del Trabajador</h1>

<div class="detalle-trabajador">
    <div class="info-grid">
        <p><strong>Nombre:</strong> {{ $trabajador->nombres }} {{ $trabajador->apellidos }}</p>
        <p><strong>DPI:</strong> {{ $trabajador->dpi }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $trabajador->fecha_nacimiento }}</p>
        <p><strong>Estado Civil:</strong> {{ $trabajador->estado_civil }}</p>
        <p><strong>Residencia:</strong> {{ $trabajador->residencia }}</p>
        <p><strong>Teléfono:</strong> {{ $trabajador->telefono }}</p>
        <p><strong>Correo Electrónico:</strong> {{ $trabajador->email }}</p>
        <p><strong>Cargo:</strong> {{ $trabajador->cargo }}</p>
        <p><strong>Inicio de Contrato:</strong> {{ $trabajador->inicio }}</p>
        <p><strong>Terminación de Contrato:</strong> {{ $trabajador->terminacion }}</p>
        <p><strong>Salario:</strong> {{ $trabajador->salario }}</p>
        <p><strong>Tipo de Contrato:</strong> {{ $trabajador->contrato }}</p>
        <p><strong>Jefe Inmediato:</strong> {{ $trabajador->jefe }}</p>
        <p><strong>Cuenta Bancaria:</strong> {{ $trabajador->cuenta_bancaria }}</p>
        <p><strong>Número IGSS:</strong> {{ $trabajador->No_IGSS }}</p>

        @if ($trabajador->archivo)
            <p><strong>Archivo:</strong> 
                <a href="{{ asset('storage/' . $trabajador->archivo) }}" target="_blank">Ver Documento</a>
            </p>
        @endif
    </div>

    <a href="{{ route('trabajadores.index') }}" class="back-btn">← Volver al listado</a>
</div>

<hr>

<div class="documentos-section">
    <h2>Documentos del trabajador</h2>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('documentos.store', $trabajador) }}" method="POST" enctype="multipart/form-data" class="upload-form" id="upload-form">
        @csrf
        <label for="archivo" class="upload-label">
            <span>Seleccionar Documento</span>
            <input type="file" name="archivo" id="archivo" required class="upload-input">
        </label>
    </form>

    <ul class="document-list">
        @forelse ($trabajador->documentos as $documento)
            <li>
                <a href="{{ route('documentos.ver', $documento) }}" target="_blank">{{ $documento->nombre }}</a>
                <form action="{{ route('documentos.destroy', $documento) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Eliminar</button>
                </form>
            </li>
        @empty
            <li>No hay documentos cargados.</li>
        @endforelse
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('archivo');
        const form = document.getElementById('upload-form');

        fileInput.addEventListener('change', function () {
            form.submit();  // Enviar el formulario automáticamente al seleccionar el archivo
        });
    });
</script>

@endsection
