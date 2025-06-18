<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Página Expirada - Error 419</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-cyan-500 to-blue-600 min-h-screen flex items-center justify-center text-center p-6">
  <div class="bg-white bg-opacity-90 rounded-lg shadow-lg p-10 max-w-md w-full">
    <h1 class="text-8xl font-extrabold text-red-600 mb-6 select-none">419</h1>
    <h2 class="text-3xl font-semibold mb-4 text-gray-800">Página Expirada</h2>
    <p class="text-gray-700 mb-8 leading-relaxed">
      Lo sentimos, tu sesión ha expirado.<br />
      Por favor, recarga la página e inténtalo de nuevo.
    </p>
    <a href="{{ url()->previous() }}" 
       class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-6 rounded transition">
       Volver
    </a>
  </div>
</body>
</html>