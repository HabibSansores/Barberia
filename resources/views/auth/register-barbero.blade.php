<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Barbero - BarberShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-center items-center px-4 relative overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full z-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-yellow-500 mb-2">Registro de Barbero</h1>
            <p class="text-gray-400 text-sm">Crea tu cuenta profesional para gestionar tus citas y servicios.</p>
        </div>

        <form method="POST" action="{{ route('register.barbero.store') }}" class="bg-[#0f0f0f] border border-gray-800 p-8 rounded-2xl shadow-xl space-y-5">
            @csrf

            <!-- Errores de Validación -->
            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Nombre -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre Completo</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ej. Carlos Díaz"
                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
            </div>

            <!-- Especialidad -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Especialidad</label>
                <input type="text" name="especialidad" value="{{ old('especialidad') }}" required placeholder="Ej. Especialista en Fades, Estilo Clásico, Barbería"
                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
            </div>

            <!-- Teléfono -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Teléfono (WhatsApp)</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" required placeholder="Ej. 6671234567"
                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
            </div>

            <!-- Correo electrónico -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="barbero@correo.com"
                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
            </div>

            <!-- Contraseña -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Contraseña</label>
                <input type="password" name="password" required placeholder="Mínimo 8 caracteres"
                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required placeholder="Repite tu contraseña"
                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
            </div>

            <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3.5 rounded-xl transition shadow-lg hover:shadow-yellow-500/20 active:scale-[0.98]">
                Crear Cuenta de Barbero
            </button>
        </form>

        <div class="mt-6 text-center space-y-2">
            <p class="text-gray-500 text-sm">¿Eres un cliente? 
                <a href="{{ route('register.cliente') }}" class="text-yellow-500 hover:underline">Regístrate aquí</a>
            </p>
            <a href="{{ route('register.select') }}" class="inline-block text-xs text-gray-400 hover:text-white transition">← Cambiar tipo de cuenta</a>
        </div>
    </div>
</body>
</html>
