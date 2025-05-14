@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/documentos/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

<div class="documentos-container">
    <h1>Explorador de Documentos</h1>

    <!-- Ruta actual -->
    <div class="ruta-actual">
    <div class="ruta-texto">
        <strong>Ruta actual:</strong>
        @if($parent_id)
            @php 
                $ruta = []; 
                $carpeta = \App\Models\Carpetas::find($parent_id); 
            @endphp
            @while($carpeta)
                @php $ruta[] = $carpeta; @endphp
                @php $carpeta = $carpeta->padre; @endphp
            @endwhile

            <a href="{{ route('documentos.index') }}">Raíz</a><strong>/</strong>

            @foreach(array_reverse($ruta) as $item)
                @if($loop->last)
                    <span>{{ $item->nombre }}</span>
                @else
                    <a href="{{ route('documentos.index', ['parent_id' => $item->id]) }}">{{ $item->nombre }}</a><strong>/</strong>
                @endif
            @endforeach
        @else
            <a href="{{ route('documentos.index') }}">Raíz</a>
        @endif
    </div>

    @if($parent_id)
        @php
            $carpetaActual = \App\Models\Carpetas::find($parent_id);
        @endphp
        <div class="retroceder">
            @if($carpetaActual && $carpetaActual->padre)
                <a href="{{ route('documentos.index', ['parent_id' => $carpetaActual->padre->id]) }}">
                    <button>← Regresar</button>
                </a>
            @else
                <a href="{{ route('documentos.index') }}">
                    <button>← Regresar</button>
                </a>
            @endif
        </div>
        @endif
    </div>

    <!-- Formulario Crear Carpeta -->
    <!-- Modal de creación centrado -->
    <dialog id="modalCrear" class="modal-crear">
        <form method="POST" action="{{ route('documentos.crear-carpeta') }}">
            @csrf
            <h2>Crear nueva carpeta</h2>
            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
            <input type="text" name="nombre" placeholder="Nombre de la nueva carpeta" required>
            <div class="modal-actions">
                <button type="button" onclick="document.getElementById('modalCrear').close()">Cancelar</button>
                <button type="submit">Crear</button>
            </div>
        </form>
    </dialog>

    <!-- Lista de Carpetas -->
    <div class="grid-carpetas">
        @foreach ($carpetas as $carpeta)
            <div class="carpeta-item">
                <a href="{{ route('documentos.index', ['parent_id' => $carpeta->id]) }}">
                    <span class="material-icons carpeta-icon">folder</span>
                    <span class="carpeta-nombre">{{ $carpeta->nombre }}</span>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Modal para subir archivo -->
    <dialog id="modalSubir" class="modal-subir">
        <form method="POST" action="{{ route('documentos.subir-archivo') }}" enctype="multipart/form-data">
            @csrf
            <h2>Subir Archivo</h2>
            <input type="hidden" name="parent_id" value="{{ $parent_id }}">

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>

            <label for="archivo">Archivo:</label>
            <label for="archivo" class="custom-file-label">Seleccionar archivo</label>
            <input type="file" name="archivo" id="archivo" required onchange="mostrarNombreArchivo(this)">
            <div id="archivo-nombre"></div>

            <div class="modal-actions">
                <button type="button" onclick="document.getElementById('modalSubir').close()">Cancelar</button>
                <button type="submit">Subir</button>
            </div>
        </form>
    </dialog>

    <p class="separator"></p>

    @if ($archivos->count() > 0)
        <input type="text" id="buscador" placeholder="Buscar archivo..." class="buscador">
        <table class="tabla-archivos">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Descripción</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-cuerpo">
                @forelse($archivos as $i => $archivo)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $archivo->descripcion }}</td>
                        <td>{{ $archivo->nombre_archivo }}</td>
                        <td>
                            <a href="#" target="_blank" class="btn-ver">Ver</a>
                            <form method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este archivo?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    @endif

    <div class="tooltip-container">
    <div class="opciones-wrapper">
        <button class="btn-flotante" id="toggleOpciones">+</button>
        <span class="tooltip-text">Opciones</span>

        <div class="opciones-flotantes" id="opcionesFlotantes">
            <button onclick="document.getElementById('modalCrear').showModal()" class="btn-subopcion">
                📁 Nueva carpeta
            </button>
            <button onclick="document.getElementById('modalSubir').showModal()" class="btn-subopcion">
                ⬆️ Subir archivo
            </button>
        </div>
    </div>
</div>


</div>



<script>
    document.getElementById('toggleOpciones').addEventListener('click', () => {
        const menu = document.getElementById('opcionesFlotantes');
        menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';
    });

    function mostrarNombreArchivo(input) {
        const nombre = input.files.length ? input.files[0].name : '';
        document.getElementById('archivo-nombre').innerText = nombre;
    }

    document.getElementById('buscador').addEventListener('keyup', function () {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tabla-cuerpo tr');

        filas.forEach(fila => {
            const textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? '' : 'none';
        });
    });
</script>
@endsection