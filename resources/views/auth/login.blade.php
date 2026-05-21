<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | BarberShop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0d0d0d;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }

        .login-header {
            text-align: center;
        }

        .login-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #f5b800;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .login-header p {
            margin-top: 0.4rem;
            color: #aaa;
            font-size: 0.95rem;
            font-weight: 400;
        }

        .login-card {
            background: #1a1a1a;
            border-radius: 18px;
            padding: 2.2rem 2rem;
            width: 100%;
            box-shadow: 0 25px 60px rgba(0,0,0,0.6);
        }

        /* Errores de validación */
        .validation-errors {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.2rem;
        }

        .validation-errors ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .validation-errors li {
            color: #f87171;
            font-size: 0.82rem;
        }

        .status-msg {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.2rem;
            color: #4ade80;
            font-size: 0.85rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            color: #ccc;
            font-size: 0.82rem;
            font-weight: 500;
            margin-bottom: 0.45rem;
        }

        .form-group input {
            width: 100%;
            background: #111;
            border: 1px solid #2a2a2a;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: #fff;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input::placeholder {
            color: #555;
        }

        .form-group input:focus {
            border-color: #f5b800;
            box-shadow: 0 0 0 3px rgba(245, 184, 0, 0.12);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #f5b800;
            cursor: pointer;
        }

        .remember-label span {
            color: #aaa;
            font-size: 0.83rem;
        }

        .forgot-link {
            color: #f5b800;
            font-size: 0.83rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #ffd23f;
        }

        .btn-login {
            width: 100%;
            background: #f5b800;
            color: #0d0d0d;
            border: none;
            border-radius: 10px;
            padding: 0.85rem;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: #ffd23f;
            box-shadow: 0 6px 20px rgba(245, 184, 0, 0.35);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            color: #666;
            font-size: 0.88rem;
        }

        .login-footer a {
            color: #f5b800;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-footer a:hover {
            color: #ffd23f;
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    {{-- Encabezado --}}
    <div class="login-header">
        <h1>Bienvenido</h1>
        <p>Inicia sesión para continuar</p>
    </div>

    {{-- Card del formulario --}}
    <div class="login-card">

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="validation-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mensaje de sesión --}}
        @session('status')
            <div class="status-msg">{{ $value }}</div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="correo@ejemplo.com"
                    required
                    autofocus
                    autocomplete="username"
                >
            </div>

            {{-- Contraseña --}}
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
            </div>

            {{-- Recuérdame + Olvidé contraseña --}}
            <div class="form-options">
                <label class="remember-label">
                    <input type="checkbox" id="remember_me" name="remember">
                    <span>Recuérdame</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            {{-- Botón --}}
            <button type="submit" class="btn-login">
                Iniciar Sesión
            </button>
        </form>
    </div>

    {{-- Pie: ¿No tienes cuenta? --}}
    <div class="login-footer">
        ¿No tienes cuenta? <a href="{{ route('register.select') }}">Regístrate</a>
    </div>

</div>

</body>
</html>
