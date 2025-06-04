<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f5f7fa; /* fondo muy claro gris */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: #fff; /* blanco puro */
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        h2 {
            font-weight: 700;
            margin-bottom: 2rem;
            color: #2c3e50; /* azul oscuro */
            text-align: center;
            letter-spacing: 1px;
        }
        label {
            font-weight: 600;
            color: #34495e; /* gris oscuro */
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1.8px solid #bdc3c7; /* gris claro */
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #2980b9; /* azul profesional */
            box-shadow: 0 0 8px #2980b9;
        }
        .btn-primary {
            background: #34495e; /* gris oscuro */
            border: none;
            padding: 0.75rem;
            font-weight: 700;
            border-radius: 8px;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #2c3e50; /* azul grisáceo más oscuro */
        }
        small.text-danger {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    required
                    autofocus
                    value="abelardofelipe722@gmail.com"
                />
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    required
                    value="123456789"
                />
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
