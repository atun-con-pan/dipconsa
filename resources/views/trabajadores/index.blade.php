@extends('layouts.app')
<style>
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
</style>
@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-900 min-h-screen text-gray-100">
    <h1 class="text-3xl font-bold mb-6">Trabajadores</h1>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <input 
            type="text" 
            id="search-input" 
            class="w-full md:w-1/2 px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
            placeholder="Buscar trabajador..." 
            value="{{ request('search') }}"
        >
        
        @if(Auth::user()->rol === 'admin')
        <button 
            type="button" 
            class="w-full md:w-auto px-6 py-2 bg-yellow-500 text-gray-900 font-medium rounded-lg hover:bg-yellow-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
            id="btnOpenModalAgregar"
        >
            Agregar Trabajador
        </button>
        @endif
    </div>

    <!-- MODAL PARA REGISTRAR TRABAJADORES -->
    <div id="modalAgregarTrabajador" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="modal-scroll bg-gray-800 rounded-lg shadow-lg max-w-4xl p-8 w-full max-h-[90vh] overflow-y-auto text-gray-100">
            
            <div class="p-6">
                <div class="flex justify-between items-center text-white rounded-t-lg mb-4 border-b">
                    <h5 class="text-3xl font-bold mb-6 text-white">Agregar Trabajador</h5>
                    <button id="btnCloseModalAgregar" class="text-white hover:text-gray-300 focus:outline-none text-2xl leading-none">&times;</button>
                </div>
                <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nombres" class="block text-sm font-medium mb-1">Nombres</label>
                            <input type="text" id="nombres" name="nombres" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                        </div>
                        <div>
                            <label for="apellidos" class="block text-sm font-medium mb-1">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                        </div>
                        <div>
                            <label for="dpi" class="block text-sm font-medium mb-1">DPI</label>
                            <input type="text" id="dpi" name="dpi" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                        </div>
                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-medium mb-1">Fecha de nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                        </div>
                        <div>
                            <label for="estado_civil" class="block text-sm font-medium mb-1">Estado civil</label>
                            <select id="estado_civil" name="estado_civil" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected class="bg-gray-700 text-gray-300">Seleccione una opción</option>
                                <option value="Casado">Casado/a</option>
                                <option value="Soltero">Soltero/a</option>
                                <option value="Divorciado">Divorciado/a</option>
                                <option value="Unido">Unido/a</option>
                            </select>
                        </div>
                        <div>
                            <label for="residencia" class="block text-sm font-medium mb-1">Residencia</label>
                            <input type="text" id="residencia" name="residencia" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                        </div>
                        <div>
                            <label for="telefono" class="block text-sm font-medium mb-1">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">E-mail</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                        </div>
                        <div>
                            <label for="cargo" class="block text-sm font-medium mb-1">Cargo/Puesto</label>
                            <select name="cargo" id="cargo" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Gerente</option>
                                <option>Ingeniero/a</option>
                                <option>Abogado/a</option>
                                <option>Arquitecto/a</option>
                                <option>Contador/a</option>
                                <option>Auditor/a</option>
                                <option>Técnico/a</option>
                                <option>Recepcionista</option>
                                <option>Practicante</option>
                            </select>
                        </div>
                        <div>
                            <label for="inicio" class="block text-sm font-medium mb-1">Inicio</label>
                            <input type="date" name="inicio" id="inicio" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="terminacion" class="block text-sm font-medium mb-1">Terminación</label>
                            <input type="date" name="terminacion" id="terminacion" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="salario" class="block text-sm font-medium mb-1">Salario</label>
                            <input type="text" name="salario" id="salario" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="contrato" class="block text-sm font-medium mb-1">Contrato</label>
                            <select name="contrato" id="contrato" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Permanente</option>
                                <option>Temporal</option>
                                <option>Practicante</option>
                            </select>
                        </div>

                        <div>
                            <label for="jefe" class="block text-sm font-medium mb-1">Jefe inmediato</label>
                            <input type="text" name="jefe" id="jefe" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="cuenta_bancaria" class="block text-sm font-medium mb-1">No. Cuenta bancaria</label>
                            <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="No_IGSS" class="block text-sm font-medium mb-1">No. IGSS</label>
                            <input type="text" name="No_IGSS" id="No_IGSS" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <button type="button" id="btnCancelModalAgregar" class="px-4 py-2 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- TERMINA MODAL PARA REGISTRAR TRABAJADORES -->

    

    <!-- Contenedor de tarjetas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="card-grid">
        @forelse ($trabajadores as $trabajador)
            <div class="bg-gray-800 rounded-lg shadow-md border border-gray-700 hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                <div class="p-6 flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-600 text-white font-bold text-2xl rounded-full flex items-center justify-center mb-4">
                        {{ strtoupper(substr($trabajador->nombres, 0, 1)) }}
                    </div>
                    <div class="text-center mb-4">
                        <h3 class="text-lg font-semibold">{{ $trabajador->nombres }}, {{ $trabajador->apellidos }}</h3>
                        <p class="text-gray-400 mt-1">+502 {{ preg_replace('/(\d{4})(\d{4})/', '$1-$2', $trabajador->telefono) }}</p>
                        <p class="text-gray-400 text-sm truncate w-full">{{ $trabajador->email }}</p>
                    </div>
                    <button
                        type="button"
                        class="ver-detalles-btn w-full px-4 py-2 border border-blue-500 text-blue-400 rounded-md hover:bg-blue-700 hover:text-white transition-colors duration-200 text-center"
                        data-modal-target="modal-{{ $trabajador->id }}"
                    >
                        Ver Detalles
                    </button>
                </div>
            </div>

            <!-- Modal para cada trabajador -->
            <div id="modal-{{ $trabajador->id }}" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
                <div class="modal-scroll bg-gray-900 rounded-lg max-w-4xl w-full mx-4 p-8 text-gray-300 relative max-h-[90vh] overflow-y-auto">
                    <button class="modal-close absolute top-4 right-4 text-gray-400 hover:text-white text-3xl font-bold">&times;</button>
                    <h2 class="text-3xl font-bold mb-6 text-white">{{ $trabajador->nombres }} {{ $trabajador->apellidos }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left">
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">DPI</p>
                            <p class="text-lg font-mono tracking-widest">{{ preg_replace('/(\d{4})(\d{4})(\d{4})/', '$1 $2 $3', $trabajador->dpi) }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Fecha Nacimiento</p>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($trabajador->fecha_nacimiento)->format('d/m/Y') }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Estado Civil</p>
                            <p class="text-lg">{{ $trabajador->estado_civil }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Residencia</p>
                            <p class="text-lg">{{ $trabajador->residencia }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Teléfono</p>
                            <p class="text-lg">+502 {{ preg_replace('/(\d{4})(\d{4})/', '$1 $2', $trabajador->telefono) }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Email</p>
                            <p class="text-lg truncate">{{ $trabajador->email }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Cargo/Puesto</p>
                            <p class="text-lg">{{ $trabajador->cargo }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Inicio</p>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($trabajador->inicio)->format('d/m/Y') }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Terminación</p>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($trabajador->terminacion)->format('d/m/Y') }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Salario</p>
                            <p class="text-lg">{{ 'Q' . number_format($trabajador->salario, 2) }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Contrato</p>
                            <p class="text-lg">{{ $trabajador->contrato }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">Jefe Inmediato</p>
                            <p class="text-lg">{{ $trabajador->jefe }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">No. Cuenta Bancaria</p>
                            <p class="text-lg font-mono tracking-widest">{{ $trabajador->cuenta_bancaria }}</p>
                        </div>
                        <div class="border-b border-gray-700 pb-3">
                            <p class="text-sm font-semibold text-gray-400 mb-1">No. IGSS</p>
                            <p class="text-lg font-mono tracking-widest">{{ preg_replace('/(\d{4})(\d{4})(\d{3})/', '$1 $2 $3', $trabajador->No_IGSS) }}</p>
                        </div>
                        <!-- BOTÓN PARA ABRIR EL MODAL -->
                        <button class="modal-close px-8 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">Cerrar</button>
                        @if(Auth::user()->rol === 'admin')
                        <button 
                            onclick="openModal('modal-editar-{{ $trabajador->id }}')" 
                            class="px-8 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition"
                        >
                            Editar
                        </button>
                        @endif
                    </div>
                    
                </div>
            </div>

            <!-- MODAL EDITAR TRABAJADOR -->
            <div 
                id="modal-editar-{{ $trabajador->id }}" 
                class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden"
            >
                <div class="modal-scroll bg-gray-900 rounded-lg max-w-4xl w-full mx-4 p-8 text-gray-300 relative max-h-[90vh] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
                    <div class="flex justify-between items-center p-4 border-b">
                        <h2 class="text-3xl font-bold mb-6 text-white">Editar Trabajador</h2>
                        <button onclick="closeModal('modal-editar-{{ $trabajador->id }}')" class="text-gray-500 hover:text-gray-800 text-2xl font-bold">
                            ×
                        </button>
                    </div>

                    <form action="{{ route('trabajadores.update', $trabajador->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Nombres -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Nombres</label>
                                <input type="text" name="nombre" value="{{ $trabajador->nombres }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Apellidos -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Apellidos</label>
                                <input type="text" name="apellidos" value="{{ $trabajador->apellidos }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- DPI -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">DPI</label>
                                <input type="text" name="dpi" value="{{ $trabajador->dpi }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Fecha nacimiento -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento" value="{{ \Carbon\Carbon::parse($trabajador->fecha_nacimiento)->format('Y-m-d') }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Estado civil -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Estado civil</label>
                                <select name="estado_civil" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400">
                                    @foreach(['Casado', 'Soltero', 'Divorciado', 'Unido'] as $estado)
                                        <option value="{{ $estado }}" {{ $trabajador->estado_civil == $estado ? 'selected' : '' }}>{{ $estado }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Residencia -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Residencia</label>
                                <input type="text" name="residencia" value="{{ $trabajador->residencia }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Teléfono</label>
                                <input type="text" name="telefono" value="{{ $trabajador->telefono }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Email</label>
                                <input type="email" name="email" value="{{ $trabajador->email }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Cargo -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Cargo</label>
                                <select name="cargo" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400">
                                    @foreach(['Gerente', 'Ingeniero/a', 'Abogado/a', 'Arquitecto/a', 'Contador', 'Auditor', 'Tecnico', 'Recepcionista', 'Practicante'] as $cargo)
                                        <option value="{{ $cargo }}" {{ $trabajador->cargo == $cargo ? 'selected' : '' }}>{{ $cargo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Inicio -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Inicio</label>
                                <input type="date" name="inicio" value="{{ \Carbon\Carbon::parse($trabajador->inicio)->format('Y-m-d') }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Terminación -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Terminación</label>
                                <input type="date" name="terminacion" value="{{ \Carbon\Carbon::parse($trabajador->terminacion)->format('Y-m-d') }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Salario -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Salario</label>
                                <input type="number" name="salario" value="{{ $trabajador->salario }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- Contrato -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Contrato</label>
                                <select name="contrato" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400">
                                    @foreach(['Permanente', 'Temporal', 'Practicante'] as $contrato)
                                        <option value="{{ $contrato }}" {{ $trabajador->contrato == $contrato ? 'selected' : '' }}>{{ $contrato }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jefe inmediato -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Jefe inmediato</label>
                                <input type="text" name="jefe" value="{{ $trabajador->jefe }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- No. Cuenta bancaria -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">Cuenta bancaria</label>
                                <input type="text" name="cuenta_bancaria" value="{{ $trabajador->cuenta_bancaria }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>

                            <!-- No. IGSS -->
                            <div>
                                <label class="text-sm font-semibold text-gray-400 mb-1">No. IGSS</label>
                                <input type="text" name="No_IGSS" value="{{ $trabajador->No_IGSS }}" required class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-md p-2 focus:outline-none focus:ring focus:ring-yellow-500 placeholder-gray-400" />
                            </div>
                            <button 
                                type="button" 
                                onclick="closeModal('modal-editar-{{ $trabajador->id }}')" 
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                            >
                                Cancelar
                            </button>
                            <button 
                                type="submit" 
                                class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700"
                            >
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- TERMINA MODAL EDITAR TRABAJADOR -->

        @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                No hay trabajadores registrados.
            </div>
        @endforelse
    </div>

</div>


<script>
    // Igual que antes: búsqueda y modal
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("search-input");
        const cards = document.querySelectorAll("#card-grid > div");

        input.addEventListener("input", function () {
            const value = input.value.toLowerCase();

            cards.forEach(function (card) {
                const fullText = card.innerText.toLowerCase();

                if (fullText.includes(value)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });

        // AGREGAR TRABAJADORES
        const modal = document.getElementById('modalAgregarTrabajador');
        const btnOpen = document.getElementById('btnOpenModalAgregar');
        const btnClose = document.getElementById('btnCloseModalAgregar');
        const btnCancel = document.getElementById('btnCancelModalAgregar');

        function openModal() {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
        }

        function closeModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
        }

        btnOpen?.addEventListener('click', openModal);
        btnClose?.addEventListener('click', closeModal);
        btnCancel?.addEventListener('click', closeModal);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // VER DETALLES DE TRABAJADORES
        document.querySelectorAll('.ver-detalles-btn').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
            });
        });

        document.querySelectorAll('.modal-close').forEach(button => {
            button.addEventListener('click', () => {
                button.closest('[id^="modal-"]').classList.add('hidden');
            });
        });

        // Cerrar modal al dar clic fuera del contenido
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        window.openModal = function(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        window.closeModal = function(id) {
            document.getElementById(id).classList.add('hidden');
        }

    });
</script>
@endsection
