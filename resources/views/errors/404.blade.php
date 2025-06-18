<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>404 Not Found</title>
    <link rel="shortcut icon" href="images/logo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e0e7ff);
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .error-card {
            max-width: 500px;
            padding: 2rem;
            border-radius: 1rem;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .error-code {
            font-size: 6rem;
            font-weight: 800;
            color: #0d6efd;
        }
        .message {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .btn-custom {
            border-radius: 30px;
            padding: 0.5rem 1.5rem;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-code">404</div>
        <div class="message">La página que estás buscando no existe.</div>
        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-custom">Ir al inicio</a>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
