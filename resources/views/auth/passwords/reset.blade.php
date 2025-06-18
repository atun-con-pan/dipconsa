@extends('layouts.reset')

@section('content')
<div class="max-w-md mx-auto p-6 bg-slate-800 rounded-lg shadow-lg text-white">
    <h2 class="text-2xl mb-4">Nueva contraseña</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}" />

        <label for="email" class="block mb-1 font-semibold">Correo Electrónico</label>
        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
            class="w-full px-3 py-2 mb-2 rounded bg-slate-700 border border-slate-600 text-white" />

        @error('email')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <label for="password" class="block mb-1 font-semibold">Nueva Contraseña</label>
        <input id="password" type="password" name="password" required class="w-full px-3 py-2 mb-2 rounded bg-slate-700 border border-slate-600 text-white" autofocus/>

        <div id="password-rules" class="mb-4 text-sm">
        <ul>
            <li id="rule-length" class="text-red-500">Ingresa al menos 8 caracteres</li>
            <li id="rule-uppercase" class="text-red-500">Ingresa al menos una letra mayúscula</li>
            <li id="rule-lowercase" class="text-red-500">Ingresa al menos una letra minúscula</li>
            <li id="rule-number" class="text-red-500">Ingresa al menos un número</li>
        </ul>
        </div>
        @error('password')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <label for="password_confirmation" class="block mb-1 font-semibold">Confirmar Contraseña</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-3 py-2 mb-4 rounded bg-slate-700 border border-slate-600 text-white" />

        <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded font-semibold">Restablecer contraseña</button>
    </form>
</div>

<script>
  const passwordInput = document.getElementById('password');
  const rules = {
    length: document.getElementById('rule-length'),
    uppercase: document.getElementById('rule-uppercase'),
    lowercase: document.getElementById('rule-lowercase'),
    number: document.getElementById('rule-number')
  };

  passwordInput.addEventListener('input', () => {
    const val = passwordInput.value;

    // Validar longitud
    if (val.length >= 8) {
      rules.length.classList.remove('text-red-500');
      rules.length.classList.add('text-green-500');
    } else {
      rules.length.classList.remove('text-green-500');
      rules.length.classList.add('text-red-500');
    }

    // Validar mayúscula
    if (/[A-Z]/.test(val)) {
      rules.uppercase.classList.remove('text-red-500');
      rules.uppercase.classList.add('text-green-500');
    } else {
      rules.uppercase.classList.remove('text-green-500');
      rules.uppercase.classList.add('text-red-500');
    }

    // Validar minúscula
    if (/[a-z]/.test(val)) {
      rules.lowercase.classList.remove('text-red-500');
      rules.lowercase.classList.add('text-green-500');
    } else {
      rules.lowercase.classList.remove('text-green-500');
      rules.lowercase.classList.add('text-red-500');
    }

    // Validar número
    if (/\d/.test(val)) {
      rules.number.classList.remove('text-red-500');
      rules.number.classList.add('text-green-500');
    } else {
      rules.number.classList.remove('text-green-500');
      rules.number.classList.add('text-red-500');
    }
  });
</script>

@endsection
