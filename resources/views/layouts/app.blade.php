<!DOCTYPE html>
<html lang="es" class="min-h-screen">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dipconsa</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" defer></script>
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
</head>
<body class="min-h-screen bg-slate-900 text-white font-sans">
  <div class="flex flex-col min-h-screen">
    <!-- Sidebar -->
    <aside
      id="sidebar"
      class="fixed top-0 left-0 h-full w-64 bg-slate-800 p-6 space-y-6 z-40 transform transition-transform duration-300 ease-in-out"
    >
      <h1 class="text-2xl font-bold tracking-widest">Dipconsa</h1>
      <nav class="space-y-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-house"></i> Inicio
        </a>
        <a href="{{ route('trabajadores.index') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-user-tie"></i> Colaboradores
        </a>
        <a href="{{ route('documentos.index') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-chart-bar"></i> Documentos
        </a>
        <a href="{{ route('mensajeria.index') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-envelope"></i> Mensajería
        </a>
        <a href="{{ route('universidad.index') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-university"></i> Universidad
        </a>
        @if(Auth::user()->rol === 'admin')
        <a href="{{ route('usuarios.index') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-users"></i> Usuarios
        </a>
        @endif
        <a href="{{ route('ayuda.index') }}" class="flex items-center gap-2 hover:text-cyan-400">
          <i class="fas fa-question-circle"></i> Ayuda
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-2 hover:text-red-400">
          <i class="fas fa-sign-out-alt"></i> Salir
        </a>
      </nav>
    </aside>

    <!-- Main content -->
    <div id="mainContent" class="flex-1 flex flex-col transition-all duration-300 ease-in-out ml-64">
    <header class="flex items-center justify-between bg-slate-800 px-6 py-4 shadow-md">
        <div class="flex items-center gap-4">
            <button id="toggleSidebar" class="text-xl focus:outline-none">
            <i class="fas fa-bars"></i>
            </button>
            <h2 class="text-2xl font-bold hidden md:block">Dashboard</h2>
        </div>
        @if(Auth::check())
        <div class="flex items-center gap-3 bg-slate-700 px-4 py-2 rounded-lg">
            <span class="text-cyan-400">👋 ¡Hola, <strong>{{ Auth::user()->nombre }}</strong>!</span>
        </div>
        @endif
    </header>

      <main class="modal-scroll grow overflow-y-auto p-6 bg-slate-900">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Script -->
  <script>
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  const toggleBtn = document.getElementById("toggleSidebar");

  let sidebarOpen = window.innerWidth >= 768;

  function updateLayout() {
    if (sidebarOpen) {
      sidebar.style.transform = "translateX(0)";
      mainContent.classList.add("ml-64");
    } else {
      sidebar.style.transform = "translateX(-100%)";
      mainContent.classList.remove("ml-64");
    }
  }

  toggleBtn.addEventListener("click", () => {
    sidebarOpen = !sidebarOpen;
    updateLayout();
  });

  window.addEventListener("load", () => {
    sidebarOpen = window.innerWidth >= 768;
    updateLayout();
  });

  window.addEventListener("resize", () => {
    const isNowWide = window.innerWidth >= 768;
    if (isNowWide !== sidebarOpen) {
      sidebarOpen = isNowWide;
      updateLayout();
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('script')
</body>
</html>
