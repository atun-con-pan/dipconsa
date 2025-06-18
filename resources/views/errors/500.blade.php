<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Error interno del servidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .error-container {
            padding: 40px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            max-width: 500px;
        }

        .error-code {
            font-size: 96px;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 20px;
            margin-bottom: 20px;
            color: #6c757d;
        }

        .btn-home {
            background-color: #0d6efd;
            color: white;
            padding: 10px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-home:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <div class="error-message">¡Ups! Algo salió mal en el servidor.</div>
        <p>No te preocupes, nuestro equipo ya está trabajando para solucionarlo.</p>
        <a href="{{ url('/') }}" class="btn-home mt-3">Volver al inicio</a>
    </div>
</body>
</html>