<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dipconsa</title>
    <link rel="shortcut icon" href="images/logo.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @stack('styles')
</head>
<body>
    <div class="header">
        <button class="menu-btn" onclick="toggleSidebar()">☰</button>
        <h2>Dashboard</h2>
    </div>

    <nav class="sidebar" id="sidebar">
        <ul>
            <li class="{{ Route::currentRouteNamed('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fas fa-house"></i>Inicio
                </a>
            </li>

            <li class="{{ Route::currentRouteNamed('trabajadores.index') ? 'active' : '' }}">
                <a href="{{ route('trabajadores.index') }}">
                <i class="fas fa-user-tie"></i>Colaboradores
                </a>
            </li>

            <li class="{{ Route::currentRouteNamed('documentos.index') ? 'active' : '' }}">
                <a href="{{ route('documentos.index') }}">
                    <i class="fas fa-chart-bar"></i>
                    Documentos
                </a>
            </li>

            @if(Auth::user()->rol === 'admin')
                <li class="{{ Route::currentRouteNamed('usuarios.index') ? 'active' : '' }}">
                    <a href="{{ route('usuarios.index') }}">
                        <i class="fas fa-users"></i> Usuarios
                    </a>
                </li>
            @endif

            <li class="{{ Route::currentRouteNamed('ayuda.index') ? 'active' : '' }}">
                <a href="{{ route('ayuda.index') }}">
                    <i class="fas fa-question-circle"></i> Ayuda
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>Salir
                </a>
            </li>

        </ul>
    </nav>

    <div class="main-content" id="main">
        @yield('content')
    </div>

    <!-- Toast Bootstrap -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="sessionExpiredToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <div class="toast-header">
        <strong class="me-auto text-danger">Sesión Expirada</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
        <div class="toast-body">
        Tu sesión expiró. Serás redirigido al login.
        </div>
    </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
    <script>
        lucide.createIcons();
        function toggleSidebar() {
            document.body.classList.toggle("collapsed");
        }

        // Cerrar en móvil al hacer clic fuera del sidebar
        window.addEventListener('click', (e) => {
            const sidebar = document.getElementById("sidebar");
            const btn = document.querySelector(".menu-btn");
                if (
                    window.innerWidth <= 768 &&
                    !sidebar.contains(e.target) &&
                    !btn.contains(e.target)
                ) {
                    document.body.classList.remove("collapsed");
                }
        })

        function toggleSubmenu(event) {
            event.preventDefault();
            const parent = event.target.closest('.has-submenu');
            parent.classList.toggle('active');
        }

        const sessionLifetimeMinutes = {{ config('session.lifetime') }};
        const sessionLifetimeMs = sessionLifetimeMinutes * 60 * 1000;

        let timeout;
        let modalInstance;

        function showSessionExpiredToast() {
        const toastEl = document.getElementById('sessionExpiredToast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();

        toastEl.addEventListener('hidden.bs.toast', () => {
            window.location.href = "{{ route('login') }}";
        });

        // O redirigir después de 5 segundos (por si no cierran el toast)
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 5000);
    }

        function resetTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(showSessionExpiredToast, sessionLifetimeMs);
        }

        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onmousedown = resetTimer;
        window.ontouchstart = resetTimer;
        window.onclick = resetTimer;
        window.onkeypress = resetTimer;
        window.addEventListener('scroll', resetTimer, true);
    </script>
    @stack('script')
</body>
</html>