<!DOCTYPE html>
<html lang="es" class="min-h-screen bg-slate-900 text-white">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" defer></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-slate-900">

  <div class="w-full max-w-md bg-slate-800 rounded-2xl shadow-xl p-8 sm:p-10">
    <div class="text-center mb-6">
      <i class="fas fa-hard-hat text-yellow-400 text-5xl mb-3"></i>
      <h2 class="text-2xl font-bold tracking-wide">Constructora Dipconsa</h2>
      <p class="text-sm text-gray-300 mt-1">Accede a tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-200 mb-1">Correo Electrónico</label>
        <input
          type="email"
          name="email"
          id="email"
          class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-500"
          placeholder="ejemplo@correo.com"
          required
          autofocus
        />
        @error('email')
          <p class="text-sm text-red-400 font-semibold mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-200 mb-1">Contraseña</label>
        <input
          type="password"
          name="password"
          id="password"
          class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-500"
          placeholder="********"
          required
        />
        @error('password')
          <p class="text-sm text-red-400 font-semibold mt-1">{{ $message }}</p>
        @enderror
      </div>

        <div class="flex justify-end mt-1">
            <a href="{{ route('password.request') }}" class="text-sm text-cyan-400 hover:text-cyan-600 font-semibold">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

      <div class="pt-2">
        <button
          type="submit"
          class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 rounded-lg transition duration-200"
        >
          Entrar
        </button>
      </div>
    </form>
  </div>

</body>
</html>
