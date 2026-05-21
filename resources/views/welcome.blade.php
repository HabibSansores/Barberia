<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarberShop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }

        html{
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-black text-white">

    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-yellow-500">
                BarberShop
            </h1>

            <div class="hidden md:flex gap-8 text-sm font-medium">
                <a href="#inicio" class="hover:text-yellow-500 transition">Inicio</a>
                <a href="#servicios" class="hover:text-yellow-500 transition">Servicios</a>
                <a href="#barberos" class="hover:text-yellow-500 transition">Barberos</a>
                <a href="#citas" class="hover:text-yellow-500 transition">Citas</a>
                <a href="#ubicacion" class="hover:text-yellow-500 transition">Ubicación</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="/dashboard"
                       class="bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-2 rounded-lg font-semibold transition">
                        Dashboard
                    </a>
                @else
                    <a href="/login"
                       class="text-white hover:text-yellow-500 transition font-semibold">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register.select') }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-2 rounded-lg font-semibold transition">
                        Regístrate
                    </a>
                @endauth
            </div>

        </div>
    </nav>


    <!-- HERO -->
    <section id="inicio"
             class="h-screen bg-cover bg-center relative flex items-center justify-center"
             style="background-image: url('https://images.unsplash.com/photo-1621605815971-fbc98d665033?q=80&w=2070&auto=format&fit=crop');">

        <div class="absolute inset-0 bg-black/70"></div>

        <div class="relative z-10 text-center px-4">

            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                Tu estilo comienza aquí
            </h1>

            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-8">
                Cortes modernos, fades, barba y atención profesional.
            </p>

            <a href="#citas"
               class="bg-yellow-500 hover:bg-yellow-600 text-black px-8 py-4 rounded-xl text-lg font-semibold transition">
                Reservar Cita
            </a>

        </div>
    </section>



    <!-- SERVICIOS -->
    <section id="servicios" class="py-24 bg-[#0f0f0f]">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-yellow-500 mb-4">
                    Nuestros Servicios
                </h2>

                <p class="text-gray-400">
                    Calidad y estilo en cada corte.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- CARD -->
                <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">

                    <div class="text-5xl mb-5">
                        ✂️
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Corte Clásico
                    </h3>

                    <p class="text-gray-400 mb-5">
                        Corte tradicional con acabado profesional.
                    </p>

                    <span class="text-yellow-500 text-2xl font-bold">
                        $120
                    </span>

                </div>


                <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">

                    <div class="text-5xl mb-5">
                        🔥
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Fade Premium
                    </h3>

                    <p class="text-gray-400 mb-5">
                        Fade moderno con diseño personalizado.
                    </p>

                    <span class="text-yellow-500 text-2xl font-bold">
                        $180
                    </span>

                </div>


                <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">

                    <div class="text-5xl mb-5">
                        🧔
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Barba
                    </h3>

                    <p class="text-gray-400 mb-5">
                        Perfilado y arreglo de barba profesional.
                    </p>

                    <span class="text-yellow-500 text-2xl font-bold">
                        $80
                    </span>

                </div>


                <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">

                    <div class="text-5xl mb-5">
                        ⭐
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Corte + Barba
                    </h3>

                    <p class="text-gray-400 mb-5">
                        Servicio completo premium.
                    </p>

                    <span class="text-yellow-500 text-2xl font-bold">
                        $220
                    </span>

                </div>

            </div>

        </div>

    </section>



    <!-- BARBEROS -->
    <section id="barberos" class="py-24 bg-black">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">

                <h2 class="text-4xl font-bold text-yellow-500 mb-4">
                    Nuestros Barberos
                </h2>

                <p class="text-gray-400">
                    Profesionales listos para darte el mejor estilo.
                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <!-- BARBER -->
                <div class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800">

                    <img src="https://images.unsplash.com/photo-1622286342621-4bd786c2447c?q=80&w=987&auto=format&fit=crop"
                         class="w-full h-80 object-cover">

                    <div class="p-6">

                        <h3 class="text-2xl font-bold mb-2">
                            Juan Pérez
                        </h3>

                        <p class="text-yellow-500 mb-3">
                            Especialista en fades
                        </p>

                        <p class="text-gray-400">
                            Más de 5 años de experiencia en cortes modernos.
                        </p>

                    </div>

                </div>



                <div class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800">

                    <img src="https://images.unsplash.com/photo-1517832606299-7ae9b720a186?q=80&w=987&auto=format&fit=crop"
                         class="w-full h-80 object-cover">

                    <div class="p-6">

                        <h3 class="text-2xl font-bold mb-2">
                            Carlos Díaz
                        </h3>

                        <p class="text-yellow-500 mb-3">
                            Barba y estilo clásico
                        </p>

                        <p class="text-gray-400">
                            Experto en perfilado y atención premium.
                        </p>

                    </div>

                </div>



                <div class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800">

                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=987&auto=format&fit=crop"
                         class="w-full h-80 object-cover">

                    <div class="p-6">

                        <h3 class="text-2xl font-bold mb-2">
                            Miguel Torres
                        </h3>

                        <p class="text-yellow-500 mb-3">
                            Diseños y freestyle
                        </p>

                        <p class="text-gray-400">
                            Cortes creativos y personalizados.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- AGENDAR CITA -->
    <section id="citas" class="py-24 bg-[#0f0f0f]">

        <div class="max-w-4xl mx-auto px-6">

            <div class="text-center mb-12">

                <h2 class="text-4xl font-bold text-yellow-500 mb-4">
                    Agenda Tu Cita
                </h2>

                <p class="text-gray-400">
                    Reserva tu espacio fácilmente.
                </p>

            </div>


            <form method="POST" action="{{ route('citas.store') }}" class="bg-[#181818] p-10 rounded-2xl border border-gray-800 space-y-6">
                @csrf

                @if(session('success'))
                    <div class="bg-green-900/40 border border-green-500/80 text-green-200 px-6 py-4 rounded-xl flex flex-col md:flex-row items-center justify-between gap-4 shadow-lg backdrop-blur-sm" role="alert">
                        <div class="text-center md:text-left">
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        @if(session('whatsapp_url'))
                            <div class="w-full md:w-auto text-center">
                                <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-full md:w-auto inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-5 rounded-lg shadow transition-all hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.458L0 24zm5.835-3.3c1.673.993 3.328 1.503 4.887 1.503 5.485 0 9.948-4.414 9.951-9.84.002-2.628-1.02-5.1-2.877-6.958C16.002 3.55 13.541 2.529 10.93 2.528 5.446 2.528 1.054 6.945 1.05 12.37c-.001 1.745.474 3.447 1.378 4.969L1.45 22.062l4.442-1.362zM18.175 14.9c-.33-.165-1.951-.963-2.25-1.072-.3-.11-.519-.165-.738.165-.219.33-.847 1.072-1.039 1.29-.192.219-.384.246-.714.081-.33-.165-1.393-.513-2.653-1.637-1.033-.92-1.73-2.057-1.933-2.404-.203-.347-.022-.534.143-.699.148-.148.33-.384.495-.577.165-.192.22-.33.33-.549.11-.219.055-.411-.027-.577-.082-.165-.738-1.782-1.011-2.44-.267-.643-.538-.553-.738-.563-.19-.01-.41-.01-.629-.01-.219 0-.575.082-.876.411-.3.33-1.15 1.124-1.15 2.741 0 1.617 1.178 3.181 1.339 3.4.162.22 2.316 3.537 5.611 4.96.783.338 1.395.54 1.872.693.787.25 1.5.215 2.065.13.629-.094 1.951-.797 2.226-1.566.275-.769.275-1.428.192-1.566-.083-.138-.302-.22-.632-.385z"/>
                                    </svg>
                                    Enviar WhatsApp
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Nombre
                        </label>
                        <input type="text" name="nombre_cliente" required
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white">
                    </div>


                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Teléfono
                        </label>
                        <input type="text" name="telefono" required placeholder="Ej: 6671234567"
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white">
                    </div>

                </div>

                <div>
                    <label class="block mb-2 text-sm text-gray-400">
                        Correo Electrónico (Para recibir ticket PDF)
                    </label>
                    <input type="email" name="email" placeholder="Ej: cliente@correo.com"
                           class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white">
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Servicio
                        </label>
                        <select name="servicio" required
                                class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white bg-black">
                            <option value="Corte Clásico">Corte Clásico ($120)</option>
                            <option value="Fade Premium">Fade Premium ($180)</option>
                            <option value="Barba">Barba ($80)</option>
                            <option value="Corte + Barba">Corte + Barba ($220)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Barbero
                        </label>
                        <select name="barbero" required
                                class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white bg-black">
                            <option value="Juan Pérez">Juan Pérez (Especialista en Fades)</option>
                            <option value="Carlos Díaz">Carlos Díaz (Barba y Estilo Clásico)</option>
                            <option value="Miguel Torres">Miguel Torres (Diseños y Freestyle)</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Fecha
                        </label>
                        <input type="text" name="fecha" id="fecha" required placeholder="Selecciona una fecha"
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white bg-black">
                    </div>


                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Hora
                        </label>
                        <select name="hora" id="hora" required disabled
                                class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500 text-white disabled:opacity-50">
                            <option value="">Seleccione una fecha primero</option>
                        </select>
                    </div>

                </div>

                <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-4 rounded-xl transition">
                    Confirmar Cita
                </button>

            </form>

        </div>

    </section>




    <!-- UBICACION -->
    <section id="ubicacion" class="py-24 bg-black">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">

                <h2 class="text-4xl font-bold text-yellow-500 mb-4">
                    Ubicación
                </h2>

                <p class="text-gray-400">
                    Visítanos en nuestra sucursal.
                </p>

            </div>

            <div class="grid md:grid-cols-2 gap-10 items-center">

                <div>

                    <h3 class="text-3xl font-bold mb-6">
                        BarberShop Mérida
                    </h3>

                    <p class="text-gray-400 mb-4">
                        Calle 123 #45 Col. Centro
                    </p>

                    <p class="text-gray-400 mb-4">
                        Mérida, Yucatán
                    </p>

                    <p class="text-gray-400 mb-4">
                        Lunes - Sábado
                    </p>

                    <p class="text-yellow-500 text-xl font-bold">
                        9:00 AM - 7:00 PM
                    </p>

                </div>


                <div class="rounded-2xl overflow-hidden border border-gray-800">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18"
                        width="100%"
                        height="350"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>

                </div>

            </div>

        </div>

    </section>



    <!-- FOOTER -->
    <footer class="bg-[#0a0a0a] border-t border-gray-800 py-8">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h2 class="text-2xl font-bold text-yellow-500 mb-4">
                BarberShop
            </h2>

            <p class="text-gray-500 mb-6">
                Estilo, elegancia y profesionalismo.
            </p>

            <div class="flex justify-center gap-6 mb-6">

                <a href="#" class="hover:text-yellow-500 transition">
                    Facebook
                </a>

                <a href="#" class="hover:text-yellow-500 transition">
                    Instagram
                </a>

                <a href="#" class="hover:text-yellow-500 transition">
                    WhatsApp
                </a>

            </div>

            <p class="text-gray-600 text-sm">
                © 2026 BarberShop. Todos los derechos reservados.
            </p>

        </div>

    </footer>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('fecha');
            const timeSelect = document.getElementById('hora');

            // Inicializar Flatpickr con tema oscuro y español
            flatpickr(dateInput, {
                locale: 'es',
                dateFormat: 'Y-m-d',
                minDate: 'today',
                disable: [
                    function(date) {
                        // Deshabilitar los Domingos (0 es Domingo)
                        return (date.getDay() === 0);
                    }
                ],
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) {
                        // Limpiar y deshabilitar temporalmente el select
                        timeSelect.innerHTML = '<option value="">Cargando horas...</option>';
                                // Hacer petición AJAX para obtener horas disponibles
                        fetch(`/citas/horas-disponibles?fecha=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                timeSelect.innerHTML = '';
                                if (data.error) {
                                    Swal.fire({
                                        title: 'Horario No Disponible',
                                        text: data.error,
                                        icon: 'warning',
                                        background: '#181818',
                                        color: '#fff',
                                        confirmButtonColor: '#eab308'
                                    });
                                    timeSelect.innerHTML = `<option value="">Seleccione otra fecha</option>`;
                                    timeSelect.disabled = true;
                                    return;
                                }
                                if (data.length > 0) {
                                    timeSelect.disabled = false;
                                    
                                    const placeholderOpt = document.createElement('option');
                                    placeholderOpt.value = '';
                                    placeholderOpt.textContent = 'Seleccione una hora';
                                    timeSelect.appendChild(placeholderOpt);
 
                                    data.forEach(hora => {
                                        const option = document.createElement('option');
                                        option.value = hora;
                                        
                                        // Formatear hora de 24h a 12h para mostrarla bonita
                                        const [h, m] = hora.split(':');
                                        const hourNum = parseInt(h);
                                        const ampm = hourNum >= 12 ? 'PM' : 'AM';
                                        const displayHour = hourNum % 12 || 12;
                                        option.textContent = `${displayHour}:${m} ${ampm}`;
                                        timeSelect.appendChild(option);
                                    });
                                } else {
                                    timeSelect.innerHTML = '<option value="">No hay horas disponibles para este día</option>';
                                    timeSelect.disabled = true;
                                }
                            });
                    } else {
                        timeSelect.innerHTML = '<option value="">Seleccione una fecha primero</option>';
                        timeSelect.disabled = true;
                    }
                }
            });
        });
    </script>

</body>
</html>