<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dipconsa</title>
    <link rel="shortcut icon" href="images/logo.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                <i class="fas fa-users"></i>Trabajadores
                </a>
            </li>

            <li class="{{ Route::currentRouteNamed('documentos.index') ? 'active' : '' }}">
                <a href="{{ route('documentos.index') }}">
                    <i class="fas fa-chart-bar"></i>
                    Documentos
                </a>
            </li>

            <li class="{{ Route::currentRouteNamed('trabajadores.index') ? 'active' : '' }}">
                <a href="{{ route('trabajadores.index') }}">Configuraciones</a>
            </li>

            <li class="{{ Route::currentRouteNamed('trabajadores.index') ? 'active' : '' }}">
                <a href="{{ route('trabajadores.index') }}">Salir</a>
            </li>
        </ul>
    </nav>

    <div class="main-content" id="main">
        @yield('content')
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
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
    </script>
</body>
</html>