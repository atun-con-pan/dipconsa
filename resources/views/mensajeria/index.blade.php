@extends('layouts.app')

@section('content')
@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Abrir modal editar si hay sesión
    @if(session('openModalId'))
        openModal('editarModal-{{ session('openModalId') }}');
    @endif
});

function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush

<!-- Modal Crear Registro -->
<div id="registroModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-slate-800 rounded-xl shadow-lg w-full max-w-md p-6 relative">
    <h3 class="text-primary-400 text-xl font-bold mb-4 flex items-center gap-2">
      <i class="fas fa-envelope"></i> Nuevo Registro de Mensajería
    </h3>
    <button onclick="closeModal('registroModal')" class="absolute top-4 right-4 text-gray-400 hover:text-white focus:outline-none">
      <i class="fas fa-times"></i>
    </button>
    <form action="{{ route('mensajeria.store') }}" method="POST" class="space-y-4 text-gray-200" enctype="multipart/form-data">
      @csrf
      <div>
        <label for="recibido_por" class="block mb-1 font-semibold">Recibido por</label>
        <input type="text" name="recibido_por" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="entregado_por" class="block mb-1 font-semibold">Entregado por</label>
        <input type="text" name="entregado_por" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="fecha" class="block mb-1 font-semibold">Fecha</label>
        <input type="date" name="fecha" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="hora" class="block mb-1 font-semibold">Hora</label>
        <input type="time" name="hora" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="tipo" class="block mb-1 font-semibold">Tipo</label>
        <select name="tipo" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:ring-cyan-400 text-white">
          <option value="recibido">Recibido</option>
          <option value="entregado">Entregado</option>
        </select>
      </div>
        <div class="w-full">
            <label class="block mb-1 font-semibold text-gray-300" for="documento">Documento</label>
            <input type="file" id="documento" name="documento" class="w-full rounded-md bg-slate-700 border border-slate-600 text-white cursor-pointer file:bg-cyan-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-0 file:cursor-pointer hover:file:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-1">
        </div>
      <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 transition rounded-full py-2 font-semibold text-white">
        Guardar Registro
      </button>
    </form>
  </div>
</div>

<!-- Botón Crear -->
<div class="text-right mb-6">
  <button onclick="openModal('registroModal')" class="bg-green-600 hover:bg-green-700 rounded-full px-6 py-2 font-semibold text-white transition">
    <i class="fas fa-envelope"></i> Nuevo Registro
  </button>
</div>

<!-- Tabla de Mensajería -->
<div class="w-full overflow-x-auto rounded-lg shadow-lg bg-slate-800 p-4">
  <table class="min-w-[640px] w-full text-center text-gray-300">
    <thead class="bg-cyan-700 rounded-t-lg">
      <tr>
        <th class="px-4 py-2">No</th>
        <th class="px-4 py-2">Recibido por</th>
        <th class="px-4 py-2">Entregado por</th>
        <th class="px-4 py-2">Fecha</th>
        <th class="px-4 py-2">Hora</th>
        <th class="px-4 py-2">Tipo</th>
        <th class="px-4 py-2">Documento</th>
        <th class="px-4 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($registros as $index => $registro)
      <tr class="border-t border-slate-700 hover:bg-slate-700 transition">
        <td class="px-4 py-2">{{ $loop->iteration }}</td>
        <td class="px-4 py-2">{{ $registro->recibido_por }}</td>
        <td class="px-4 py-2">{{ $registro->entregado_por }}</td>
        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
        <td class="px-4 py-2">{{ $registro->hora }}</td>
        <td class="px-4 py-2">
          <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $registro->tipo == 'Recibido' ? 'bg-blue-600' : 'bg-green-600' }}">
            {{ ucfirst($registro->tipo) }}
          </span>
        </td>
        <td class="px-4 py-2 break-all">{{ $registro->nombre_documento }}</a></td>
        <td class="px-4 py-2 space-x-2 flex items-center justify-center">
            <a href="{{ route('mensajeria.verArchivo', basename($registro->nombre_documento)) }}" target="_blank"
                class="text-cyan-600 hover:text-cyan-800 text-lg"
                title="Ver documento">
                <i class="fas fa-eye"></i>
            </a>
            @if(Auth::user()->rol === 'admin')
            <button onclick="openModal('editarModal-{{ $registro->id }}')"
                    class="text-blue-600 hover:text-blue-800 text-lg"
                    title="Editar">
                <i class="fas fa-edit"></i>
            </button>
            <form id="delete-form-{{ $registro->id }}" action="{{ route('mensajeria.destroy', $registro->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
            </form>
            <button onclick="confirmDelete({{ $registro->id }})"
                    class="text-red-600 hover:text-red-800 text-lg"
                    title="Eliminar">
                <i class="fas fa-trash-alt"></i>
            </button>
            @endif
        </td>
    </tr>

      <!-- Modal Editar -->
      <div id="editarModal-{{ $registro->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-slate-800 rounded-xl shadow-lg w-full max-w-md p-6 relative">
          <h3 class="text-cyan-400 text-xl font-bold mb-4">Editar Registro</h3>
          <button onclick="closeModal('editarModal-{{ $registro->id }}')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
          </button>
          <form method="POST" action="{{ route('mensajeria.update', $registro->id) }}" class="space-y-4 text-gray-200" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
              <label class="block mb-1 font-semibold">Recibido por</label>
              <input type="text" name="recibido_por" value="{{ $registro->recibido_por }}" required class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 text-white" />
            </div>
            <div>
              <label class="block mb-1 font-semibold">Entregado por</label>
              <input type="text" name="entregado_por" value="{{ $registro->entregado_por }}" required class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 text-white" />
            </div>
            <div>
              <label class="block mb-1 font-semibold">Fecha</label>
              <input type="date" name="fecha" value="{{ $registro->fecha }}" required class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 text-white" />
            </div>
            <div>
              <label class="block mb-1 font-semibold">Hora</label>
              <input type="time" name="hora" value="{{ $registro->hora }}" required class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 text-white" />
            </div>
            <div>
              <label class="block mb-1 font-semibold">Tipo</label>
              <select name="tipo" required class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 text-white">
                <option value="recibido" {{ $registro->tipo == 'recibido' ? 'selected' : '' }}>Recibido</option>
                <option value="entregado" {{ $registro->tipo == 'entregado' ? 'selected' : '' }}>Entregado</option>
              </select>
            </div>
            <div class="w-full">
                <label class="block mb-1 font-semibold text-gray-300" for="documento-{{ $registro->id }}">Documento</label>
                <input type="file" id="documento-{{ $registro->id }}" name="documento" class="w-full rounded-md bg-slate-700 border border-slate-600 text-white cursor-pointer file:bg-cyan-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-0 file:cursor-pointer hover:file:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-1" onchange="document.getElementById('file-name-{{ $registro->id }}').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'">
                <span id="file-name-{{ $registro->id }}" class="block mt-1 text-sm text-gray-300">{{ $registro->nombre_documento }}</span>
            </div>
            <div class="flex justify-end gap-2 mt-2">
              <button type="button" onclick="closeModal('editarModal-{{ $registro->id }}')" class="px-4 py-2 rounded-md bg-gray-600 hover:bg-gray-700 text-white">Cancelar</button>
              <button type="submit" class="px-4 py-2 rounded-md bg-yellow-600 hover:bg-yellow-700 text-white font-semibold">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
      @empty
      <tr>
        <td colspan="8" class="py-4 text-gray-400">No hay registros disponibles.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
