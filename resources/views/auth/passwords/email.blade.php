@extends('layouts.reset')

@section('content')
<div class="max-w-md mx-auto p-6 bg-slate-800 rounded-lg shadow-lg text-white">
    <h2 class="text-2xl mb-4">Restablecer contraseña</h2>

    @if (session('status'))
        <div class="mb-4 p-3 bg-green-600 rounded">{{ session('status') }}</div>
    @endif

    @error('email')
        <div class="mb-4 p-3 bg-red-600 rounded">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email" class="block mb-1 font-semibold">Correo Electrónico</label>
        <input id="email" type="email" name="email" required autofocus
            class="w-full px-3 py-2 mb-2 rounded bg-slate-700 border border-slate-600 text-white" />
        <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded font-semibold">Enviar enlace de restablecimiento</button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="inline-block text-cyan-400 hover:underline hover:text-cyan-300 transition">
            Regresar al inicio de sesión
        </a>
    </div>
</div>
@endsection
