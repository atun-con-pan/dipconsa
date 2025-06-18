@extends('layouts.app')

@section('content')
@push('styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<style>
  .documentos-container {
    max-width: 1200px;
    margin: 0 auto;
    background: #1e1e2f;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.7);
    padding: 30px 40px;
  }

  .title {
    font-weight: 700;
    font-size: 2.3rem;
    margin-bottom: 25px;
    color: #82aaff;
    text-align: center;
    letter-spacing: 1.2px;
  }

  /* RUTA ACTUAL */
  .ruta-actual {
    background: #292a46;
    border-radius: 6px;
    padding: 12px 20px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.9rem;
    user-select: none;
    color: #82aaff;
  }

  .ruta-texto a {
    color: #82aaff;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
  }
  .ruta-texto a:hover {
    color: #aaccff;
    text-decoration: underline;
  }

  /* Botón regresar */
  .retroceder button {
    background: #3c404d;
    color: #82aaff;
    border: none;
    padding: 8px 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
    user-select: none;
  }
  .retroceder button:hover {
    background: #5360ff;
    color: white;
  }

  /* GRID CARPETAS */
  .grid-carpetas {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
  }

  .carpeta-item {
    background: #292a46;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(40, 40, 60, 0.7);
    transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.3s ease;
    user-select: none;
  }
  .carpeta-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(100, 100, 255, 0.7);
    background: #39405a;
  }

  .carpeta-item a {
    color: #82aaff;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    user-select: none;
  }

  /* Icono carpeta */
  .carpeta-icon {
    font-size: 48px;
    color: #aabbff;
    margin-bottom: 10px;
    transition: color 0.3s ease;
  }
  .carpeta-item:hover .carpeta-icon {
    color: #cdd6f4;
  }

  .carpeta-nombre {
    font-weight: 600;
    font-size: 1rem;
    word-break: break-word;
  }

  /* Separador */
  .separator {
    height: 1px;
    background: #44475a;
    margin: 35px 0;
  }

  /* BUSCADOR */
  .buscador {
    width: 100%;
    padding: 10px 15px;
    border-radius: 25px;
    border: 1.8px solid #6272a4;
    background: #282a36;
    color: #f8f8f2;
    font-size: 1rem;
    margin-bottom: 25px;
    transition: border-color 0.3s ease, background-color 0.3s ease;
  }
  .buscador::placeholder {
    color: #6272a4;
  }
  .buscador:focus {
    outline: none;
    border-color: #82aaff;
    background: #3a3f58;
    box-shadow: 0 0 8px #82aaffaa;
  }

  /* TABLA ARCHIVOS */
  .tabla-archivos {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.8);
    border-radius: 10px;
    overflow: hidden;
    background: #1e1e2f;
    color: #cdd6f4;
  }

  .tabla-archivos thead {
    background: #282a36;
    color: #82aaff;
  }
  .tabla-archivos th,
  .tabla-archivos td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #44475a;
  }
  .tabla-archivos tbody tr {
    background: #1e1e2f;
    transition: background-color 0.25s ease;
  }
  .tabla-archivos tbody tr:hover {
    background: #39405a;
  }

  .acciones-botones {
    display: flex;
    gap: 8px;
  }

  /* Botones en tabla */
  .btn-ver,
  .btn-eliminar,
  .btn-editar {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
    user-select: none;
  }

  .btn-ver {
    background-color: #6272a4;
    color: #f8f8f2;
  }
  .btn-ver:hover {
    background-color: #82aaff;
  }

  .btn-eliminar {
    background-color: #ff5555;
    color: #f8f8f2;
  }
  .btn-eliminar:hover {
    background-color: #ff4444;
  }

  .btn-editar {
    background-color: #f1fa8c;
    color: #282a36;
  }
  .btn-editar:hover {
    background-color: #f7f99a;
  }

  /* TOOLTIP CONTENEDOR */
  .tooltip-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
  }

  .opciones-wrapper {
    position: relative;
  }

  .btn-flotante {
    background-color: #6272a4;
    border: none;
    color: #f8f8f2;
    width: 55px;
    height: 55px;
    font-size: 2rem;
    font-weight: 700;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.6);
    transition: background-color 0.3s ease, transform 0.2s ease;
    user-select: none;
  }
  .btn-flotante:hover {
    background-color: #82aaff;
    transform: rotate(90deg);
  }

  .tooltip-text {
    position: absolute;
    bottom: 70px;
    right: 50%;
    transform: translateX(50%);
    background: #6272a4;
    color: #f8f8f2;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    user-select: none;
  }
  .btn-flotante:hover + .tooltip-text {
    opacity: 1;
  }

  .opciones-flotantes {
    position: absolute;
    width: 250px;
    bottom: 75px;
    right: 0;
    display: none;
    flex-direction: column;
    gap: 10px;
    background: #282a36;
    padding: 15px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.8);
    user-select: none;
    z-index: 10000;
  }

  .btn-subopcion {
    background: #6272a4;
    color: #f8f8f2;
    border: none;
    padding: 10px 14px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    user-select: none;
  }
  .btn-subopcion:hover {
    background: #82aaff;
  }

  /* MODALES */
  dialog.modal-crear,
  dialog.modal-subir {
    border: none;
    border-radius: 14px;
    width: 400px;
    max-width: 90vw;
    padding: 25px 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
    font-size: 1rem;
    font-family: inherit;
    background: #292a46;
    color: #f8f8f2;
    user-select: none;
    animation: fadeInDialog 0.25s ease forwards;
  }

  @keyframes fadeInDialog {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
  }

  dialog.modal-crear h2,
  dialog.modal-subir h2 {
    margin-top: 0;
    margin-bottom: 18px;
    color: #82aaff;
    font-weight: 700;
  }

  dialog.modal-crear input[type="text"],
  dialog.modal-subir input[type="text"],
  dialog.modal-subir input[type="file"] {
    width: 100%;
    padding: 10px 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    border: 1.8px solid #6272a4;
    font-size: 1rem;
    background: #1e1e2f;
    color: #f8f8f2;
    transition: border-color 0.3s ease;
  }
  dialog.modal-crear input[type="text"]:focus,
  dialog.modal-subir input[type="text"]:focus,
  dialog.modal-subir input[type="file"]:focus {
    outline: none;
    border-color: #82aaff;
    box-shadow: 0 0 6px #82aaffaa;
  }

  .modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
  }

  .modal-actions button {
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    user-select: none;
  }
  .modal-actions button[type="submit"] {
    background-color: #6272a4;
    color: #f8f8f2;
  }
  .modal-actions button[type="submit"]:hover {
    background-color: #82aaff;
  }
  .modal-actions button[type="button"] {
    background-color: #44475a;
    color: #f8f8f2;
  }
  .modal-actions button[type="button"]:hover {
    background-color: #5e5f78;
  }

  /* INPUT FILE PERSONALIZADO */
  input[type="file"] {
    display: none;
  }

  .custom-file-label {
    display: inline-block;
    background: #6272a4;
    color: #f8f8f2;
    padding: 9px 20px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    margin-bottom: 10px;
    transition: background-color 0.3s ease;
    user-select: none;
  }
  .custom-file-label:hover {
    background: #82aaff;
  }

  #archivo-nombre {
    font-style: italic;
    color: #8a8a9f;
    margin-bottom: 15px;
  }

  /* MENU CONTEXTUAL */
  .custom-context-menu {
    position: fixed;
    background: #292a46;
    box-shadow: 0 6px 20px rgba(0,0,0,0.8);
    border-radius: 10px;
    width: 200px;
    z-index: 10500;
    display: none;
    user-select: none;
  }

  .custom-context-menu ul {
    margin: 0;
    padding: 10px 0;
    list-style: none;
  }
  .custom-context-menu ul li {
    padding: 12px 20px;
    cursor: pointer;
    font-weight: 600;
    color: #82aaff;
    transition: background-color 0.3s ease, color 0.3s ease;
    user-select: none;
  }
  .custom-context-menu ul li:hover {
    background: #82aaff;
    color: #1e1e2f;
  }

  /* MODAL RENOMBRAR CARPETA */
  #modalRenombrar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(18, 18, 18, 0.95);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 11000;
  }

  #modalRenombrar .modal-content {
    background: #292a46;
    padding: 30px 40px;
    border-radius: 14px;
    max-width: 400px;
    width: 90vw;
    box-shadow: 0 6px 20px rgba(0,0,0,0.8);
    user-select: none;
    color: #f8f8f2;
  }

  #modalRenombrar h3 {
    margin-top: 0;
    color: #82aaff;
    font-weight: 700;
    margin-bottom: 20px;
  }

  #inputNuevoNombre {
    width: 100%;
    padding: 10px 14px;
    font-size: 1rem;
    border-radius: 8px;
    border: 1.8px solid #6272a4;
    margin-bottom: 25px;
    background: #1e1e2f;
    color: #f8f8f2;
    transition: border-color 0.3s ease;
  }
  #inputNuevoNombre:focus {
    outline: none;
    border-color: #82aaff;
    box-shadow: 0 0 8px #82aaffbb;
  }

  .modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
  }

  .modal-buttons button {
    border: none;
    padding: 10px 18px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s ease;
  }
  #btnCancelarRenombrar {
    background: #44475a;
    color: #f8f8f2;
  }
  #btnCancelarRenombrar:hover {
    background: #5e5f78;
  }
  #btnGuardarRenombrar {
    background: #6272a4;
    color: #f8f8f2;
  }
  #btnGuardarRenombrar:hover {
    background: #82aaff;
  }

  /* Scroll estético para modales */
    .modal-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .modal-scroll::-webkit-scrollbar-track {
        background: #1f2937; /* gris oscuro */
    }
    .modal-scroll::-webkit-scrollbar-thumb {
        background-color: #4b5563; /* gris medio */
        border-radius: 6px;
    }
    .ruta-actual .ruta-texto a,
    .ruta-actual .ruta-texto span {
        display: inline;
        font-weight: 500;
        color: #74b9ff;
        text-decoration: none;
    }

    dialog.modal-subir {
        background-color: #1e1e2f;
        border: none;
        border-radius: 10px;
        padding: 20px;
        color: #fff;
        width: 100%;
        max-width: 420px;
    }

    .modal-subir h2 {
        margin-top: 0;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .modal-subir label {
        display: block;
        margin-top: 12px;
        font-size: 14px;
        color: #ddd;
    }

    .modal-subir input[type="text"] {
        width: 100%;
        margin-top: 6px;
        background-color: #2c2c3e;
        border: 1px solid #444;
        border-radius: 6px;
        color: #fff;
        font-size: 14px;
        padding: 8px;
        box-sizing: border-box;
    }

    .input-file-container {
        margin-top: 6px;
        position: relative;
        width: 100%;
    }

    .input-file-container input[type="file"] {
        opacity: 0;
        width: 100%;
        height: 42px;
        position: absolute;
        top: 0;
        left: 0;
        cursor: pointer;
        z-index: 2;
    }

    .custom-file-label {
        background-color: #2c2c3e;
        border: 1px solid #444;
        border-radius: 6px;
        padding: 8px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        color: #ccc;
        font-size: 14px;
        z-index: 1;
        position: relative;
    }

    .custom-file-label:hover {
        background-color: #3a3a4f;
    }

    .file-button {
        background-color: #444;
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
        font-size: 13px;
        margin-left: 10px;
    }

    .modal-actions {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .modal-actions button {
        background-color: #3f3f5f;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .modal-actions button:hover {
        background-color: #5b5b85;
    }

</style>


<div class="documentos-container">
    <h1 class="title">Explorador de Documentos</h1>

    <!-- Ruta actual -->
    <div class="ruta-actual">
    <div class="ruta-texto">
        @if($parent_id)
            @php 
                $ruta = []; 
                $carpeta = \App\Models\Carpetas::find($parent_id); 
            @endphp
            @while($carpeta)
                @php $ruta[] = $carpeta; @endphp
                @php $carpeta = $carpeta->padre; @endphp
            @endwhile

            <a href="{{ route('documentos.index') }}">Página Principal</a><span class="separador"> &gt;</span>

            @foreach(array_reverse($ruta) as $item)
                @if($loop->last)
                    <span>{{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($item->nombre)) }}</span>
                @else
                    <a href="{{ route('documentos.index', ['parent_id' => $item->id]) }}">{{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($item->nombre)) }}</a><span class="separador"> &gt;</span>
                @endif
            @endforeach
        @else
            <a href="{{ route('documentos.index') }}">Página Principal</a>
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
                    <i class="fa-solid fa-folder carpeta-icon"></i>
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
                               @if(Auth::user()->rol === 'admin')
                                <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-eliminar">Eliminar</button>
                                </form>

                                <button type="button" class="btn-editar" onclick="abrirModalEditar({{ $archivo->id }}, '{{ addslashes($archivo->descripcion) }}')">Editar</button>
                                @endif
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
            <div class="input-file-container">
                <label for="editar_archivo" class="custom-file-label">
                    <span id="file-name">Selecciona un archivo</span>
                </label>
                <input type="file" name="archivo" id="editar_archivo" onchange="mostrarNombreArchivo()">
            </div>

            <div class="modal-actions">
                <button type="button" onclick="document.getElementById('modalEditar').close()">Cancelar</button>
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </dialog>

    @if(Auth::user()->rol === 'admin')
    <!-- Menú contextual personalizado -->
    <div id="contextMenu" class="custom-context-menu">
        <ul>
            <li onclick="abrirRenombrar()">✏️ Editar</li>
            <li onclick="eliminarCarpeta()">🗑️ Eliminar</li>
        </ul>
    </div>
    @endif

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

    function mostrarNombreArchivo() {
        const input = document.getElementById('editar_archivo');
        const nombre = input.files.length ? input.files[0].name : 'Selecciona un archivo';
        document.getElementById('nombre-archivo').textContent = nombre;
    }


</script>

@endsection