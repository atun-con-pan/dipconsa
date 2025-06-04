@extends('layouts.app')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
@endpush
@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('openModalId'))
            var modalId = 'editarModal-{{ session('openModalId') }}';
            var myModal = new bootstrap.Modal(document.getElementById(modalId));
            myModal.show();
        @endif
    });

    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
@endpush

<!-- Modal -->
<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-primary" id="registroModalLabel">
            <i class="fas fa-user-plus me-2"></i>Registrar Usuario
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body px-4">
        <form action="{{ route('usuarios.store') }}" method="POST" novalidate>
            @csrf
            <div class="mb-3 text-start">
                <label for="nombre" class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control rounded-pill" required>
            </div>
            <div class="mb-3 text-start">
                <label for="apellido" class="form-label fw-semibold">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control rounded-pill" required>
            </div>
            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email" class="form-control rounded-pill" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label fw-semibold">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control rounded-pill" required>
            </div>
            <div class="mb-4 text-start">
                <label for="rol" class="form-label fw-semibold">Rol</label>
                <select name="rol" id="rol" class="form-select rounded-pill" required>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary rounded-pill fw-semibold">
                    <i class="fas fa-paper-plane me-2"></i>Registrar
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Botón para abrir el modal -->
<div class="text-end mb-4">
    <button type="button" class="btn btn-success rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#registroModal">
        <i class="fas fa-user-plus me-2"></i> Nuevo Usuario
    </button>
</div>

<div class="container my-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered shadow-sm rounded">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($usuarios as $index => $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->apellido }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <span class="badge bg-{{ $usuario->rol == 'admin' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($usuario->rol) }}
                            </span>
                        </td>
                        <td>
                            <!-- Botón que abre el modal con id único -->
                            <button 
                                class="btn btn-sm btn-outline-primary me-1" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editarModal-{{ $usuario->id }}"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>

                            <form id="delete-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $usuario->id }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal con formulario para cada usuario -->
                    <div class="modal fade" id="editarModal-{{ $usuario->id }}" tabindex="-1" aria-labelledby="editarModalLabel-{{ $usuario->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                                    @csrf
                                    
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarModalLabel-{{ $usuario->id }}">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nombre-{{ $usuario->id }}" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre-{{ $usuario->id }}" name="nombre" value="{{ $usuario->nombre }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="apellido-{{ $usuario->id }}" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="apellido-{{ $usuario->id }}" name="apellido" value="{{ $usuario->apellido }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email-{{ $usuario->id }}" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email-{{ $usuario->id }}" name="email" value="{{ $usuario->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rol-{{ $usuario->id }}" class="form-label">Rol</label>
                                            <select class="form-select" id="rol-{{ $usuario->id }}" name="rol" required>
                                                <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="usuario" {{ $usuario->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-muted">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
