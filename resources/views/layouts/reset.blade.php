<!DOCTYPE html>
<html lang="es" class="bg-slate-900 text-white min-h-screen">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dipconsa')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen">
    @yield('content')
</body>
</html>
