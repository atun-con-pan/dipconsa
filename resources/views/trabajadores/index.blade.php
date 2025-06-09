@extends('layouts.app')

@section('content')
@push('styles')
    <style>
        /* Estilo extra para las cards */
        .user-card {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background-color: #fff;
            transition: box-shadow 0.2s ease-in-out;
        }
        .user-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .avatar {
            width: 60px;
            height: 60px;
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
            font-size: 1.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            user-select: none;
        }
        .view-btn {
            margin-top: auto;
            align-self: stretch;
        }
        .user-info {
            word-break: break-word;
        }
    </style>
@endpush

<h1 class="mb-4">Trabajadores</h1>

<div class="container">

    <!-- Barra de búsqueda y botón -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <input type="text" id="search-input" class="form-control" placeholder="Buscar trabajador..." style="max-width: 600px;" value="{{ request('search') }}">
        @if(Auth::user()->rol === 'admin')
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarTrabajador">
                Agregar Trabajador
            </button>
        @endif
    </div>



    <!-- MODAL PARA REGISTRAR TRABAJADORES -->
    <div class="modal fade" id="modalAgregarTrabajador" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalLabel">Agregar Trabajador</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" id="nombres" class="form-control" name="nombres" required>
                </div>
                <div class="col-md-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" class="form-control" name="apellidos" required>
                </div>
                <div class="col-md-6">
                <label for="dpi" class="form-label">DPI</label>
                <input type="text" id="dpi" class="form-control" name="dpi" required>
                </div>
                <div class="col-md-6">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" id="fecha_nacimiento" class="form-control" name="fecha_nacimiento" required>
                </div>
                <div class="col-md-6">
                <label for="estado_civil" class="form-label">Estado civil</label>
                <select class="form-select" id="estado_civil" name="estado_civil" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Casado">Casado/a</option>
                    <option value="Soltero">Soltero/a</option>
                    <option value="Divorciado">Divorciado/a</option>
                    <option value="Unido">Unido/a</option>
                </select>
                </div>
                <div class="col-md-6">
                <label for="residencia" class="form-label">Residencia</label>
                <input type="text" id="residencia" class="form-control" name="residencia" required>
                </div>
                <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" class="form-control" name="telefono" required>
                </div>
                <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" class="form-control" name="email" autocomplete="email" required>
                </div>
                <div class="col-md-6">
                <label for="cargo" class="form-label">Cargo/Puesto</label>
                <select class="form-select" id="cargo" name="cargo" required>
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
                <div class="col-md-6">
                <label for="inicio" class="form-label">Inicio</label>
                <input type="date" id="inicio" class="form-control" name="inicio" required>
                </div>
                <div class="col-md-6">
                <label for="terminacion" class="form-label">Terminación</label>
                <input type="date" class="form-control" id="terminacion" name="terminacion" required>
                </div>
                <div class="col-md-6">
                <label for="salario" class="form-label">Salario</label>
                <input type="text" class="form-control" id="salario" name="salario" required>
                </div>
                <div class="col-md-6">
                <label for="contrato" class="form-label">Contrato</label>
                <select class="form-select" id="contrato" name="contrato" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Permanente">Permanente</option>
                    <option value="Temporal">Temporal</option>
                    <option value="Practicante">Practicante</option>
                </select>
                </div>
                <div class="col-md-6">
                <label for="jefe" class="form-label">Jefe inmediato</label>
                <input type="text" id="jefe" class="form-control" name="jefe" required>
                </div>
                <div class="col-md-6">
                <label for="cuenta_bancaria" class="form-label">No. Cuenta bancaria</label>
                <input type="text" id="cuenta_bancaria" class="form-control" name="cuenta_bancaria" required>
                </div>
                <div class="col-md-6">
                <label for="No_IGSS" class="form-label">No. IGSS</label>
                <input type="text" id="No_IGSS" class="form-control" name="No_IGSS" required>
                </div>
            </div>

            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>


    <!-- MODAL PARA VER INFORMACIÓN DE LOS TRABAJADORES -->
    @foreach ($trabajadores as $trabajador)
    <div class="modal fade" id="modalTrabajador{{ $trabajador->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="detalleTrabajadorModalLabel">Detalles del Trabajador</h5>
            <a href="{{ route('trabajadores.index') }}" class="btn-close" aria-label="Cerrar"></a>
        </div>
        <div class="modal-body">
            <div class="container">

            <div class="row">
                <div class="col-md-6">
                <p><strong>Nombre:</strong> {{ $trabajador->nombres }}, {{ $trabajador->apellidos }}</p>
                <p><strong>DPI:</strong> {{ preg_replace('/(\d{4})(\d{5})(\d{4})/', '$1 $2 $3', $trabajador->dpi) }}</p>
                <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($trabajador->fecha_nacimiento)->format('d/m/Y') }}</p>
                <p><strong>Estado Civil:</strong> {{ $trabajador->estado_civil }}</p>
                <p><strong>Residencia:</strong> {{ $trabajador->residencia }}</p>
                <p><strong>Teléfono:</strong> +502 {{ preg_replace('/(\d{4})(\d{4})/', '$1-$2', $trabajador->telefono) }}</p>
                <p><strong>Correo Electrónico:</strong> {{ $trabajador->email }}</p>
                <p><strong>Cargo:</strong> {{ $trabajador->cargo }}</p>
                </div>

                <div class="col-md-6">
                <p><strong>Inicio de Contrato:</strong> {{ \Carbon\Carbon::parse($trabajador->inicio)->format('d/m/Y') }}</p>
                <p><strong>Terminación de Contrato:</strong> {{ \Carbon\Carbon::parse($trabajador->terminacion)->format('d/m/Y') }}</p>
                <p><strong>Salario:</strong> Q {{ number_format($trabajador->salario, 2, '.', ',') }}</p>
                <p><strong>Tipo de Contrato:</strong> {{ $trabajador->contrato }}</p>
                <p><strong>Jefe Inmediato:</strong> {{ $trabajador->jefe }}</p>
                <p><strong>Cuenta Bancaria:</strong> {{ $trabajador->cuenta_bancaria }}</p>
                <p><strong>Número IGSS:</strong> {{ $trabajador->No_IGSS }}</p>
                </div>
            </div>

            <hr>

            <h5 class="mt-4">Documentos del trabajador</h5>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(Auth::user()->rol === 'admin')
            <form action="{{ route('documentos.store', $trabajador) }}" method="POST" enctype="multipart/form-data" class="mb-3" id="upload-form">
                @csrf
                <div class="input-group">
                    <input type="file" name="archivo" id="archivo" class="form-control" required>
                </div>
            </form>
            @endif

            <ul class="list-group">
                @forelse ($trabajador->documentos as $documento)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p class="mb-0">{{ $documento->nombre }}</p>
                        <div class="d-flex gap-2" style="width: 200px;">
                            <a href="{{ route('documentos.ver', $documento->nombre) }}" class="btn btn-sm btn-primary flex-fill" target="_blank">Ver</a>

                            @if(Auth::user()->rol === 'admin')
                                <form action="{{ route('documentos.destroy', $documento) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">No hay documentos cargados.</li>
                @endforelse
            </ul>

            </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <a href="{{ route('trabajadores.index') }}" class="btn btn-secondary w-100">Volver</a>
                    </div>
                    @if(Auth::user()->rol === 'admin')
                    <div class="col-md-6">
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#editarTrabajadorModal{{ $trabajador->id }}">
                            ✎ Editar
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            </div>
        </div>
        </div>


        <!-- MODAL PARA EDITAR LA INFORMACIÓN DE LOS TRABAJADORES -->
        <div class="modal fade" id="editarTrabajadorModal{{ $trabajador->id }}" tabindex="-1" aria-labelledby="editarTrabajadorModalLabel{{ $trabajador->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarTrabajadorModalLabel{{ $trabajador->id }}">Editar Trabajador</h5>
                        <a href="{{ route('trabajadores.index') }}" class="btn-close" aria-label="Cerrar"></a>
                    </div>
                    <form action="{{ route('trabajadores.update', $trabajador->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombres</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $trabajador->nombres }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ $trabajador->apellidos }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="dpi" class="form-label">DPI</label>
                                    <input type="text" id="dpi" name="dpi" class="form-control" value="{{ $trabajador->dpi }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>
                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ \Carbon\Carbon::parse($trabajador->fecha_nacimiento)->format('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="estado_civil" class="form-label">Estado civil</label>
                                    <select name="estado_civil" id="estado_civil" class="form-select" required>
                                        <option value="" disabled {{ $trabajador->estado_civil == null ? 'selected' : '' }}>Seleccione una opción</option>
                                        <option value="Casado" {{ $trabajador->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                                        <option value="Soltero" {{ $trabajador->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                        <option value="Divorciado" {{ $trabajador->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                        <option value="Unido" {{ $trabajador->estado_civil == 'Unido' ? 'selected' : '' }}>Unido</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="residencia" class="form-label">Residencia</label>
                                    <input type="text" id="residencia" name="residencia" class="form-control" value="{{ $trabajador->residencia }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" id="telefono" name="telefono" class="form-control" value="{{ $trabajador->telefono }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ $trabajador->email }}" required>
                                </div>

                                <div class="col-md-6">
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

                                <div class="col-md-6">
                                    <label for="inicio" class="form-label">Inicio</label>
                                    <input type="date" id="inicio" name="inicio" class="form-control" value="{{ \Carbon\Carbon::parse($trabajador->inicio)->format('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="terminacion" class="form-label">Terminación</label>
                                    <input type="date" id="terminacion" name="terminacion" class="form-control" value="{{ \Carbon\Carbon::parse($trabajador->terminacion)->format('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="salario" class="form-label">Salario</label>
                                    <input type="text" id="salario" name="salario" class="form-control" value="{{ $trabajador->salario }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="contrato" class="form-label">Contrato</label>
                                    <select name="contrato" id="contrato" class="form-select" required>
                                        <option value="" disabled {{ $trabajador->contrato == null ? 'selected' : '' }}>Seleccione una opción</option>
                                        <option value="Permanente" {{ $trabajador->contrato == 'Permanente' ? 'selected' : '' }}>Permanente</option>
                                        <option value="Temporal" {{ $trabajador->contrato == 'Temporal' ? 'selected' : '' }}>Temporal</option>
                                        <option value="Practicante" {{ $trabajador->contrato == 'Practicante' ? 'selected' : '' }}>Practicante</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="jefe" class="form-label">Jefe inmediato</label>
                                    <input type="text" id="jefe" name="jefe" class="form-control" value="{{ $trabajador->jefe }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="cuenta_bancaria" class="form-label">No. Cuenta bancaria</label>
                                    <input type="text" id="cuenta_bancaria" name="cuenta_bancaria" class="form-control" value="{{ $trabajador->cuenta_bancaria }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="No_IGSS" class="form-label">No. IGSS</label>
                                    <input type="text" id="No_IGSS" name="No_IGSS" class="form-control" value="{{ $trabajador->No_IGSS }}" required>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <a href="{{ route('trabajadores.index') }}" class="btn btn-secondary w-100">Volver</a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary w-100">Actualizar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        @endforeach



    <!-- Contenedor de tarjetas de los trabajadores -->
    <div class="d-flex flex-wrap gap-3 justify-content-center" id="card-grid">
        @forelse ($trabajadores as $trabajador)
            <div style="flex: 1 1 250px; max-width: 100%;">
                <div class="user-card d-flex flex-column">
                    <div class="avatar">{{ strtoupper(substr($trabajador->nombres, 0, 1)) }}</div>
                    <div class="user-info mb-3">
                        <strong>{{ $trabajador->nombres }}</strong><strong>,</strong>
                        <strong>{{ $trabajador->apellidos }}</strong><br>
                        <span>+502 {{ preg_replace('/(\d{4})(\d{4})/', '$1-$2', $trabajador->telefono) }}</span><br>
                        <span>{{ $trabajador->email }}</span>
                    </div>
                        <!-- Botón que abre el modal -->
                        <a href="#" class="btn btn-outline-primary view-btn" data-bs-toggle="modal" data-bs-target="#modalTrabajador{{ $trabajador->id }}">
                            Ver Detalles
                        </a>
                </div>
            </div>
        @empty
            <p>No hay trabajadores registrados.</p>
        @endforelse
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("search-input");
        const cards = document.querySelectorAll("#card-grid .user-card");

        input.addEventListener("input", function () {
            const value = input.value.toLowerCase();

            cards.forEach(function (card) {
                const fullText = card.innerText.toLowerCase();

                if (fullText.includes(value)) {
                    card.parentElement.style.display = "";
                } else {
                    card.parentElement.style.display = "none";
                }
            });
        });


        const fileInput = document.getElementById('archivo');
        const form = document.getElementById('upload-form');

        fileInput.addEventListener('change', function () {
            form.submit();  // Enviar el formulario automáticamente al seleccionar el archivo
        })

        
        function cerrarModalYAbrirOtro(idCerrar, idAbrir) {
            const modalCerrar = bootstrap.Modal.getInstance(document.getElementById(idCerrar));
            if (modalCerrar) {
                modalCerrar.hide();
            }
            const modalAbrir = new bootstrap.Modal(document.getElementById(idAbrir));
            setTimeout(() => {
                modalAbrir.show();
            }, 300);  // espera un poco para que el primer modal cierre antes de abrir el otro
        }
    });
</script>

@endsection
