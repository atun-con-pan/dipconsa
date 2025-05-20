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

    function abrirModalEditar(id, descripcion) {
        const form = document.getElementById('formEditar');
        form.action = `/documentos/${id}`; // Asegurate que esta ruta coincida con la de tu route
        document.getElementById('archivo_id').value = id;
        document.getElementById('editar_descripcion').value = descripcion;
        document.getElementById('modalEditar').showModal();
    }


    let carpetaSeleccionadaId = null;

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


    const modalRenombrar = document.getElementById('modalRenombrar');
    const inputNuevoNombre = document.getElementById('inputNuevoNombre');
    const btnCancelarRenombrar = document.getElementById('btnCancelarRenombrar');
    const btnGuardarRenombrar = document.getElementById('btnGuardarRenombrar');

    function abrirRenombrar() {
        cerrarMenu();

        // Obtener nombre actual para ponerlo en input
        let nombreActualElem = document.querySelector(`[data-id='${carpetaSeleccionadaId}'] .carpeta-nombre`);
        if (!nombreActualElem) return alert('No se encontró la carpeta');

        inputNuevoNombre.value = nombreActualElem.textContent.trim();

        modalRenombrar.style.display = 'flex';
        inputNuevoNombre.focus();
    }

    function cerrarModalRenombrar() {
        modalRenombrar.style.display = 'none';
    }

    // Cerrar modal si se da click fuera del contenido
    modalRenombrar.addEventListener('click', e => {
        if (e.target === modalRenombrar) {
            cerrarModalRenombrar();
        }
    });

    btnCancelarRenombrar.addEventListener('click', cerrarModalRenombrar);

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
        })
        .then(res => {
            if (!res.ok) throw new Error('Error al renombrar');
            return res.json();
        })
        .then(data => {
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