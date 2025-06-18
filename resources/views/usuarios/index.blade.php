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

// Funciones modales con Tailwind + JS
function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden'); // Evitar scroll fondo
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Confirmar eliminación con SweetAlert2
function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626', // rojo Tailwind
        cancelButtonColor: '#6b7280', // gris Tailwind
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

<!-- Modal Crear Usuario -->
<div id="registroModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-slate-800 rounded-xl shadow-lg w-full max-w-md p-6 relative">
    <h3 class="text-primary-400 text-xl font-bold mb-4 flex items-center gap-2">
      <i class="fas fa-user-plus"></i> Registrar Usuario
    </h3>
    <button onclick="closeModal('registroModal')" class="absolute top-4 right-4 text-gray-400 hover:text-white focus:outline-none" aria-label="Cerrar modal">
      <i class="fas fa-times"></i>
    </button>
    <form action="{{ route('usuarios.store') }}" method="POST" novalidate class="space-y-4 text-gray-200">
      @csrf
      <div>
        <label for="nombre" class="block mb-1 font-semibold">Nombre</label>
        <input type="text" name="nombre" id="nombre" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="apellido" class="block mb-1 font-semibold">Apellido</label>
        <input type="text" name="apellido" id="apellido" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="email" class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" id="email" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="password" class="block mb-1 font-semibold">Contraseña</label>
        <input type="password" name="password" id="password" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white" />
      </div>
      <div>
        <label for="rol" class="block mb-1 font-semibold">Rol</label>
        <select name="rol" id="rol" required class="w-full rounded-full px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white">
          <option value="admin">Administrador</option>
          <option value="user">Usuario</option>
        </select>
      </div>
      <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 transition rounded-full py-2 font-semibold flex justify-center items-center gap-2 text-white">
        <i class="fas fa-paper-plane"></i> Registrar
      </button>
    </form>
  </div>
</div>

<!-- Botón Abrir Modal Crear -->
<div class="text-right mb-6">
  <button onclick="openModal('registroModal')" class="bg-green-600 hover:bg-green-700 rounded-full px-6 py-2 font-semibold flex items-center gap-2 text-white transition">
    <i class="fas fa-user-plus"></i> Nuevo Usuario
  </button>
</div>

<!-- Tabla usuarios -->
<div class="w-full overflow-x-auto rounded-lg shadow-lg bg-slate-800 p-4">
  <table class="min-w-[640px] w-full text-center text-gray-300">
    <thead class="bg-cyan-700 rounded-t-lg">
      <tr>
        <th class="px-4 py-2">No</th>
        <th class="px-4 py-2">Nombres</th>
        <th class="px-4 py-2">Apellidos</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Roles</th>
        <th class="px-4 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($usuarios as $index => $usuario)
      <tr class="border-t border-slate-700 hover:bg-slate-700 transition">
        <td class="px-4 py-2">{{ $loop->iteration }}</td>
        <td class="px-4 py-2">{{ $usuario->nombre }}</td>
        <td class="px-4 py-2">{{ $usuario->apellido }}</td>
        <td class="px-4 py-2 break-all">{{ $usuario->email }}</td>
        <td class="px-4 py-2">
          <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold
            {{ $usuario->rol == 'admin' ? 'bg-red-600 text-white' : 'bg-gray-500 text-gray-100' }}">
            {{ ucfirst($usuario->rol) }}
          </span>
        </td>
        <td class="px-4 py-2 space-x-2">
          <!-- Botón editar abre modal -->
          <button
            class="text-cyan-400 hover:text-cyan-600 transition"
            title="Editar"
            onclick="openModal('editarModal-{{ $usuario->id }}')">
            <i class="fas fa-edit"></i>
          </button>

          <form id="delete-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
          </form>

          <button
            class="text-red-500 hover:text-red-700 transition"
            title="Eliminar"
            onclick="confirmDelete({{ $usuario->id }})">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>

      <!-- Modal editar usuario -->
      <div
        id="editarModal-{{ $usuario->id }}"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
        aria-hidden="true"
        aria-labelledby="editarModalLabel-{{ $usuario->id }}"
        role="dialog"
      >
        <div class="bg-slate-800 rounded-xl shadow-lg w-full max-w-md p-6 relative">
          <h3 class="text-cyan-400 text-xl font-bold mb-4">Editar Usuario</h3>
          <button
            onclick="closeModal('editarModal-{{ $usuario->id }}')"
            class="absolute top-4 right-4 text-gray-400 hover:text-white focus:outline-none"
            aria-label="Cerrar modal"
          >
            <i class="fas fa-times"></i>
          </button>
          <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" class="space-y-4 text-gray-200">
            @csrf
            @method('PUT')
            <div>
              <label for="nombre-{{ $usuario->id }}" class="block mb-1 font-semibold">Nombre</label>
              <input
                type="text"
                id="nombre-{{ $usuario->id }}"
                name="nombre"
                value="{{ $usuario->nombre }}"
                required
                class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white"
              />
            </div>
            <div>
              <label for="apellido-{{ $usuario->id }}" class="block mb-1 font-semibold">Apellido</label>
              <input
                type="text"
                id="apellido-{{ $usuario->id }}"
                name="apellido"
                value="{{ $usuario->apellido }}"
                required
                class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white"
              />
            </div>
            <div>
              <label for="email-{{ $usuario->id }}" class="block mb-1 font-semibold">Correo Electrónico</label>
              <input
                type="email"
                id="email-{{ $usuario->id }}"
                name="email"
                value="{{ $usuario->email }}"
                required
                class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white"
              />
            </div>
            <div>
              <label for="rol-{{ $usuario->id }}" class="block mb-1 font-semibold">Rol</label>
              <select
                id="rol-{{ $usuario->id }}"
                name="rol"
                required
                class="w-full rounded-md px-4 py-2 bg-slate-700 border border-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-white"
              >
                <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="usuario" {{ $usuario->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
              </select>
            </div>
            <div class="flex justify-end gap-2 pt-2">
              <button
                type="button"
                onclick="closeModal('editarModal-{{ $usuario->id }}')"
                class="px-4 py-2 rounded-md bg-gray-600 hover:bg-gray-700 text-white transition"
              >
                Cancelar
              </button>
              <button
                type="submit"
                class="px-4 py-2 rounded-md bg-cyan-600 hover:bg-cyan-700 text-white font-semibold transition"
              >
                Guardar Cambios
              </button>
            </div>
          </form>
        </div>
      </div>

      @empty
      <tr>
        <td colspan="6" class="py-4 text-gray-400">No hay usuarios registrados.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
