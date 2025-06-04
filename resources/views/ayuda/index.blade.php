@extends('layouts.app')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    body {
      background-color: #1e1e2f;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .help-card {
      background-color: #2b2b3d;
      color: #f0f0f0;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }
    .btn-whatsapp {
      background-color: #25D366;
      border: none;
    }
    .btn-whatsapp:hover {
      background-color: #1ebe5d;
    }
    .icon {
      font-size: 4rem;
      color: #25D366;
    }
  </style>
@endpush

<div class="container d-flex align-items-center justify-content-center" style="height: 100%;">
    <div class="help-card text-center">
    <div class="mb-4">
        <i class="bi bi-question-circle icon"></i>
    </div>
    <h2 class="mb-3">¿Necesitas ayuda?</h2>
    <p class="mb-4">Si tienes algún problema o duda con el sistema, puedes contactar directamente con el administrador.</p>
    <a href="https://wa.me/50235923774?text=Hola,%20necesito%20ayuda%20con%20el%20sistema" target="_blank" class="btn btn-whatsapp btn-lg">
        <i class="bi bi-whatsapp me-2"></i> Contactar por WhatsApp
    </a>
    </div>
</div>

@endsection