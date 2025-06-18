@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-full px-4 py-12">
  <div class="bg-slate-800 text-white rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    
    <div class="mb-6">
      <i class="fas fa-question-circle text-6xl text-emerald-400"></i>
    </div>

    <h2 class="text-2xl font-bold mb-4">¿Necesitas ayuda?</h2>
    
    <p class="text-slate-300 mb-6">
      Si tienes algún problema o duda con el sistema, puedes contactar directamente con el administrador.
    </p>

    <a href="https://wa.me/50235923774?text=Hola,%20necesito%20ayuda%20con%20el%20sistema"
       target="_blank"
       class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-lg font-semibold px-6 py-3 rounded-lg transition duration-200"
    >
      <i class="fab fa-whatsapp text-xl"></i>
      Contactar por WhatsApp
    </a>
  </div>
</div>
@endsection
