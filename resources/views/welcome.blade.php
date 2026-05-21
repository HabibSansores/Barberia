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
        body {
            font-family: 'Poppins', sans-serif;
        }

        html {
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
                    <a href="/login" class="text-white hover:text-yellow-500 transition font-semibold">
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
    <section id="inicio" class="h-screen bg-cover bg-center relative flex items-center justify-center"
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
                @forelse($services as $service)
                    <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">
                        <div class="text-5xl mb-5">
                            ✂️
                        </div>
                        <h3 class="text-2xl font-semibold mb-3">
                            {{ $service->name }}
                        </h3>
                        <p class="text-gray-400 mb-5">
                            {{ $service->description }}
                        </p>
                        <span class="text-yellow-500 text-2xl font-bold">
                            ${{ number_format($service->price, 0) }}
                        </span>
                    </div>
                @empty
                    <!-- Fallback default cards in case no services have been created yet -->
                    <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">
                        <div class="text-5xl mb-5">✂️</div>
                        <h3 class="text-2xl font-semibold mb-3">Corte Clásico</h3>
                        <p class="text-gray-400 mb-5">Corte tradicional con acabado profesional.</p>
                        <span class="text-yellow-500 text-2xl font-bold">$120</span>
                    </div>
                    <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">
                        <div class="text-5xl mb-5">🔥</div>
                        <h3 class="text-2xl font-semibold mb-3">Fade Premium</h3>
                        <p class="text-gray-400 mb-5">Fade moderno con diseño personalizado.</p>
                        <span class="text-yellow-500 text-2xl font-bold">$180</span>
                    </div>
                    <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">
                        <div class="text-5xl mb-5">🧔</div>
                        <h3 class="text-2xl font-semibold mb-3">Barba</h3>
                        <p class="text-gray-400 mb-5">Perfilado y arreglo de barba profesional.</p>
                        <span class="text-yellow-500 text-2xl font-bold">$80</span>
                    </div>
                    <div class="bg-[#181818] p-8 rounded-2xl border border-gray-800 hover:border-yellow-500 transition">
                        <div class="text-5xl mb-5">⭐</div>
                        <h3 class="text-2xl font-semibold mb-3">Corte + Barba</h3>
                        <p class="text-gray-400 mb-5">Servicio completo premium.</p>
                        <span class="text-yellow-500 text-2xl font-bold">$220</span>
                    </div>
                @endforelse
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
                @php
                    $fotosBarberos = [
                        'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?q=80&w=987&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1517832606299-7ae9b720a186?q=80&w=987&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=987&auto=format&fit=crop',
                    ];
                @endphp
                @forelse($barberos as $barbero)
                    <div
                        class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800 hover:border-yellow-500/50 transition">
                        <img src="{{ $fotosBarberos[$loop->index % count($fotosBarberos)] }}"
                            class="w-full h-80 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2">
                                {{ $barbero->name }}
                            </h3>
                            <p class="text-yellow-500 mb-3">
                                {{ $barbero->barbero ? $barbero->barbero->especialidad : 'Estilista' }}
                            </p>
                            <p class="text-gray-400 text-sm">
                                Especialista en atención al cliente y cortes personalizados. Teléfono:
                                {{ $barbero->phone }}
                            </p>
                        </div>
                    </div>
                @empty
                    <!-- Fallback default barbers in case no barbers are registered yet -->
                    <div class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800">
                        <img src="https://images.unsplash.com/photo-1622286342621-4bd786c2447c?q=80&w=987&auto=format&fit=crop"
                            class="w-full h-80 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2">Juan Pérez</h3>
                            <p class="text-yellow-500 mb-3">Especialista en fades</p>
                            <p class="text-gray-400">Más de 5 años de experiencia en cortes modernos.</p>
                        </div>
                    </div>
                    <div class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800">
                        <img src="https://images.unsplash.com/photo-1517832606299-7ae9b720a186?q=80&w=987&auto=format&fit=crop"
                            class="w-full h-80 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2">Carlos Díaz</h3>
                            <p class="text-yellow-500 mb-3">Barba y estilo clásico</p>
                            <p class="text-gray-400">Experto en perfilado y atención premium.</p>
                        </div>
                    </div>
                    <div class="bg-[#181818] rounded-2xl overflow-hidden border border-gray-800">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=987&auto=format&fit=crop"
                            class="w-full h-80 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2">Miguel Torres</h3>
                            <p class="text-yellow-500 mb-3">Diseños y freestyle</p>
                            <p class="text-gray-400">Cortes creativos y personalizados.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>

    </section>



    <!-- AGENDAR CITA -->
    <section id="citas" class="py-24 bg-[#0f0f0f]">

        <div class="max-w-xl mx-auto px-6 text-center">

            <div class="mb-8">
                <h2 class="text-4xl font-bold text-yellow-500 mb-4">
                    Agenda Tu Cita
                </h2>
                <p class="text-gray-400">
                    Reserva tu espacio fácilmente y disfruta del mejor servicio.
                </p>
            </div>

            <div class="bg-[#181818] p-10 rounded-2xl border border-gray-800 space-y-6 flex flex-col items-center">
                <p class="text-gray-300 text-base mb-2">
                    Elige a tu barbero preferido, selecciona el horario que más te acomode y recibe un comprobante
                    digital al instante.
                </p>
                <button type="button" id="btn-agendar-alerta"
                    class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-4 px-8 rounded-xl transition shadow-lg hover:shadow-yellow-500/20 active:scale-[0.98]">
                    Agendar Cita
                </button>
            </div>

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
                        C. 14 90-A, Felipe Carrillo Puerto, 97208
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
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14898.278426136822!2d-89.63462141926155!3d21.009882830303045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f56757286ea3ced%3A0x61bb7ea6f1f6aa32!2sSal%C3%B3n%20y%20barber%C3%ADa%20Congo!5e0!3m2!1ses-419!2smx!4v1779341207874!5m2!1ses-419!2smx"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
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
                                    timeSelect.innerHTML =
                                        `<option value="">Seleccione otra fecha</option>`;
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
                                    timeSelect.innerHTML =
                                        '<option value="">No hay horas disponibles para este día</option>';
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agendarBtn = document.getElementById('btn-agendar-alerta');
            if (agendarBtn) {
                agendarBtn.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Inicio de Sesión Requerido',
                        text: 'Para poder agendar una cita con nosotros, debes iniciar sesión o crear una cuenta',
                        icon: 'info',
                        background: '#181818',
                        color: '#fff',
                        confirmButtonColor: '#eab308',
                        confirmButtonText: 'Entendido'
                    });
                });
            }
        });
    </script>

</body>

</html>
