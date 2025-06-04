@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/documentos/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

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

    <!-- Lista de Carpetas -->
    <div class="grid-carpetas">
        @foreach ($carpetas as $carpeta)
            <div class="carpeta-item" data-id="{{ $carpeta->id }}" oncontextmenu="mostrarMenuContextual(event, this)">
                <a href="{{ route('documentos.index', ['parent_id' => $carpeta->id]) }}">
                    <span class="material-icons carpeta-icon">folder</span>
                    <span class="carpeta-nombre">{{ $carpeta->nombre }}</span>
                </a>
            </div>
        @endforeach
    </div>

    <p class="separator"></p>

    @if ($archivos->count() > 0)
        <input type="text" id="buscador" placeholder="Buscar archivo..." class="buscador">
        <table class="tabla-archivos">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Descripción</th>
                    <th>Archivo</th>
                    <th style="width: 1%; white-space: nowrap;">Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-cuerpo">
                @forelse($archivos as $i => $archivo)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $archivo->descripcion }}</td>
                        <td>{{ $archivo->nombre_archivo }}</td>
                        <td>
                            <div class="acciones-botones">
                                <a href="{{ route('archivos.ver', $archivo->nombre_archivo) }}" target="_blank" class="btn-ver">Ver</a>
                               
                                <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-eliminar">Eliminar</button>
                                </form>

                                <button type="button" class="btn-editar" onclick="abrirModalEditar({{ $archivo->id }}, '{{ addslashes($archivo->descripcion) }}')">Editar</button>
                            </div>
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

    <!-- Modal para crear carpetas -->
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

    <!-- Modal para editar archivo -->
    <dialog id="modalEditar" class="modal-subir">
        <form id="formEditar" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2>Editar Archivo</h2>

            <input type="hidden" name="archivo_id" id="archivo_id">

            <label for="editar_descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="editar_descripcion" required>

            <label for="editar_archivo">Archivo (opcional):</label>
            <input type="file" name="archivo" id="editar_archivo">

            <div class="modal-actions">
                <button type="button" onclick="document.getElementById('modalEditar').close()">Cancelar</button>
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </dialog>

    <!-- Menú contextual personalizado -->
    <div id="contextMenu" class="custom-context-menu">
        <ul>
            <li onclick="abrirRenombrar()">✏️ Editar</li>
            <li onclick="eliminarCarpeta()">🗑️ Eliminar</li>
        </ul>
    </div>

    <!-- Modal Renombrar Carpeta -->
    <div id="modalRenombrar" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>Renombrar Carpeta</h3>
            <input type="text" id="inputNuevoNombre" placeholder="Nuevo nombre" />
            <div class="modal-buttons">
            <button id="btnCancelarRenombrar">Cancelar</button>
            <button id="btnGuardarRenombrar">Guardar</button>
            </div>
        </div>
    </div>



</div>



<script>
    const modalRenombrar = document.getElementById('modalRenombrar');
    const inputNuevoNombre = document.getElementById('inputNuevoNombre');
    const btnCancelarRenombrar = document.getElementById('btnCancelarRenombrar');
    const btnGuardarRenombrar = document.getElementById('btnGuardarRenombrar');
    const buscador = document.getElementById('buscador');
    let carpetaSeleccionadaId = null;


    document.getElementById('toggleOpciones').addEventListener('click', () => {
        const menu = document.getElementById('opcionesFlotantes');
        menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';
    });

    function mostrarNombreArchivo(input) {
        const nombre = input.files.length ? input.files[0].name : '';
        document.getElementById('archivo-nombre').innerText = nombre;
    }

    if (buscador) {
        buscador.addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tabla-cuerpo tr');

            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? '' : 'none';
            });
        });
    }

    function abrirModalEditar(id, descripcion) {
        const form = document.getElementById('formEditar');
        form.action = `/documentos/${id}`; // Asegurate que esta ruta coincida con la de tu route
        document.getElementById('archivo_id').value = id;
        document.getElementById('editar_descripcion').value = descripcion;
        document.getElementById('modalEditar').showModal();
    }

    function mostrarMenuContextual(event, elemento) {
        event.preventDefault();
        carpetaSeleccionadaId = elemento.getAttribute('data-id');

        const menu = document.getElementById('contextMenu');
        const menuWidth = 200;
        const menuHeight = 120;

        const x = (window.innerWidth / 2) - (menuWidth / 2);
        const y = (window.innerHeight / 2) - (menuHeight / 2);

        menu.style.display = 'block';
        menu.style.left = `${x}px`;
        menu.style.top = `${y}px`;
    }

    btnCancelarRenombrar.addEventListener('click', cerrarModalRenombrar);
    function cerrarModalRenombrar() {
        modalRenombrar.style.display = 'none';
    }


    // Cerrar modal si se da click fuera del contenido
    modalRenombrar.addEventListener('click', e => {
        if (e.target === modalRenombrar) {
            cerrarModalRenombrar();
        }
    });

    function abrirRenombrar() {
        cerrarMenu();

        // Obtener nombre actual para ponerlo en input
        let nombreActualElem = document.querySelector(`[data-id='${carpetaSeleccionadaId}'] .carpeta-nombre`);
        if (!nombreActualElem) return alert('No se encontró la carpeta');

        inputNuevoNombre.value = nombreActualElem.textContent.trim();

        modalRenombrar.style.display = 'flex';
        inputNuevoNombre.focus();
    }

    btnGuardarRenombrar.addEventListener('click', () => {
        const nuevoNombre = inputNuevoNombre.value.trim();
        if (!nuevoNombre) {
            alert('El nombre no puede estar vacío');
        return;
        }

        fetch(`/carpeta/${carpetaSeleccionadaId}/rename`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ nuevo_nombre: nuevoNombre })
        }).then(res => {
            if (!res.ok) throw new Error('Error al renombrar');
            return res.json();
        }).then(data => {
            if (data.success) {
            document.querySelector(`[data-id='${carpetaSeleccionadaId}'] .carpeta-nombre`).textContent = data.nuevo_nombre;
            cerrarModalRenombrar();
            mostrarNotificacion('Carpeta renombrada correctamente');
            } else {
            alert('No se pudo renombrar la carpeta');
            }
        })
        .catch(err => alert(err.message));
        });

    function mostrarNotificacion(mensaje) {
        const notif = document.createElement('div');
        notif.textContent = mensaje;
        notif.style.position = 'fixed';
        notif.style.bottom = '20px';
        notif.style.right = '20px';
        notif.style.backgroundColor = '#28a745';
        notif.style.color = 'white';
        notif.style.padding = '10px 20px';
        notif.style.borderRadius = '5px';
        notif.style.boxShadow = '0 2px 6px rgba(0,0,0,0.3)';
        notif.style.zIndex = '11000';
        notif.style.fontWeight = '600';
        document.body.appendChild(notif);

        setTimeout(() => notif.remove(), 3000);
    }

    function eliminarCarpeta() {
        cerrarMenu();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará la carpeta permanentemente.",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/carpeta/${carpetaSeleccionadaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al eliminar la carpeta');
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        title: 'Eliminada',
                        text: data.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // O actualiza la lista de carpetas dinámicamente
                    });
                })
                .catch(error => {
                    Swal.fire('Error', error.message, 'error');
                });
            }
        });
    }

    function cerrarMenu() {
        document.getElementById('contextMenu').style.display = 'none';
    }

    // Ocultar el menú si se hace clic en otro lado
    document.addEventListener('click', cerrarMenu);
    document.addEventListener('scroll', cerrarMenu);

    document.querySelectorAll('.form-eliminar').forEach(form => {
        const btn = form.querySelector('.btn-eliminar');

        btn.addEventListener('click', () => {
            Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });


</script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection