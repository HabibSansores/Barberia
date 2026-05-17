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

            <a href="/login"
               class="bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-2 rounded-lg font-semibold transition">
                Login
            </a>

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


            <form class="bg-[#181818] p-10 rounded-2xl border border-gray-800 space-y-6">

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Nombre
                        </label>

                        <input type="text"
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500">
                    </div>


                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Teléfono
                        </label>

                        <input type="text"
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500">
                    </div>

                </div>


                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Servicio
                        </label>

                        <select class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500">

                            <option>Corte Clásico</option>
                            <option>Fade Premium</option>
                            <option>Barba</option>
                            <option>Corte + Barba</option>

                        </select>
                    </div>


                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Barbero
                        </label>

                        <select class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500">

                            <option>Juan Pérez</option>
                            <option>Carlos Díaz</option>
                            <option>Miguel Torres</option>

                        </select>
                    </div>

                </div>



                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Fecha
                        </label>

                        <input type="date"
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500">
                    </div>


                    <div>
                        <label class="block mb-2 text-sm text-gray-400">
                            Hora
                        </label>

                        <input type="time"
                               class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-yellow-500">
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
                        10:00 AM - 9:00 PM
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

</body>
</html>