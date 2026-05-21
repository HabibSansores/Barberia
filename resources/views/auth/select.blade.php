<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Selecciona tu Rol</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-center items-center px-4 relative overflow-hidden">
    <!-- Círculos de gradiente difusos en el fondo para estética premium -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>

    <div class="max-w-xl w-full z-10 text-center">
        <h1 class="text-3xl font-bold mb-2">Crear una cuenta</h1>
        <p class="text-gray-400 mb-8">Por favor, selecciona qué tipo de cuenta deseas registrar para comenzar.</p>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Tarjeta Cliente -->
            <a href="{{ route('register.cliente') }}" class="group bg-[#0f0f0f] border border-gray-800 hover:border-yellow-500 rounded-2xl p-8 flex flex-col items-center justify-center transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-yellow-500/5">
                <div class="w-16 h-16 rounded-full bg-yellow-500/10 flex items-center justify-center mb-4 group-hover:bg-yellow-500/20 transition-all">
                    <span class="text-3xl">🧔</span>
                </div>
                <h3 class="text-xl font-bold text-yellow-500 mb-2">Soy Cliente</h3>
                <p class="text-xs text-gray-400 text-center">Registra tus datos, agenda citas fácilmente y lleva un control de tu historial de estilo.</p>
            </a>

            <!-- Tarjeta Barbero -->
            <a href="{{ route('register.barbero') }}" class="group bg-[#0f0f0f] border border-gray-800 hover:border-yellow-500 rounded-2xl p-8 flex flex-col items-center justify-center transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-yellow-500/5">
                <div class="w-16 h-16 rounded-full bg-yellow-500/10 flex items-center justify-center mb-4 group-hover:bg-yellow-500/20 transition-all">
                    <span class="text-3xl">✂️</span>
                </div>
                <h3 class="text-xl font-bold text-yellow-500 mb-2">Soy Barbero</h3>
                <p class="text-xs text-gray-400 text-center">Crea tu perfil profesional, indica tu especialidad y gestiona tu agenda de clientes.</p>
            </a>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">¿Ya tienes cuenta? 
                <a href="/login" class="text-yellow-500 hover:underline">Inicia Sesión</a>
            </p>
            <a href="/" class="inline-block mt-4 text-xs text-gray-400 hover:text-white transition">Volver al inicio</a>
        </div>
    </div>
</body>
</html>
