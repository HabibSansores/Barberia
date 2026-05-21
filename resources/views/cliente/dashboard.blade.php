<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Cliente - BarberShop</title>
    
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
        .active-tab {
            border-bottom: 2px solid #eab308; /* yellow-500 */
            color: #eab308;
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-[#0f0f0f]/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-yellow-500">
                BarberShop <span class="text-xs text-gray-400 font-normal">Panel Cliente</span>
            </h1>

            <div class="flex gap-6 text-sm font-medium">
                <button onclick="switchTab('inicio')" id="tab-inicio" class="tab-btn py-1 hover:text-yellow-500 transition active-tab">Inicio</button>
                <button onclick="switchTab('servicios')" id="tab-servicios" class="tab-btn py-1 hover:text-yellow-500 transition">Servicios</button>
                <button onclick="switchTab('barberos')" id="tab-barberos" class="tab-btn py-1 hover:text-yellow-500 transition">Barberos</button>
                <button onclick="switchTab('citas')" id="tab-citas" class="tab-btn py-1 hover:text-yellow-500 transition">Citas</button>
                <button onclick="switchTab('perfil')" id="tab-perfil" class="tab-btn py-1 hover:text-yellow-500 transition">Perfil</button>
            </div>

            <!-- Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex items-center gap-1 border border-yellow-500 hover:bg-yellow-500 hover:text-black text-yellow-500 px-4 py-2 rounded-lg font-semibold text-sm transition">
                Salir 
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow pt-24 max-w-7xl w-full mx-auto px-6 pb-12">

        <!-- WELCOME BANNER (SIEMPRE VISIBLE O ADAPTABLE) -->
        <div class="relative rounded-2xl overflow-hidden mb-10 h-64 flex items-center bg-cover bg-center border border-gray-800"
             style="background-image: url('https://images.unsplash.com/photo-1621605815971-fbc98d665033?q=80&w=2070&auto=format&fit=crop');">
            <div class="absolute inset-0 bg-black/70"></div>
            <div class="relative z-10 px-8">
                <span class="text-yellow-500 text-sm font-semibold uppercase tracking-wider">Tu Barbería de Confianza</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-1 mb-4">Bienvenido, {{ $user->name }}</h2>
                
                <button onclick="switchTab('citas')" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-3 rounded-xl font-bold transition shadow-lg hover:shadow-yellow-500/20">
                    Reservar Cita
                </button>
            </div>
        </div>

        <!-- ALERTA DE AGENDAMIENTO EXITOSO CON WHATSAPP -->
        @if(session('success'))
            <div class="bg-green-900/40 border border-green-500/80 text-green-200 px-6 py-4 rounded-xl flex flex-col md:flex-row items-center justify-between gap-4 shadow-lg backdrop-blur-sm mb-6" role="alert">
                <div class="text-center md:text-left">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                @if(session('whatsapp_url'))
                    <div class="w-full md:w-auto text-center">
                        <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener noreferrer" 
                           class="w-full md:w-auto inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-5 rounded-lg shadow transition-all hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.458L0 24zm5.835-3.3c1.673.993 3.328 1.503 4.887 1.503 5.485 0 9.948-4.414 9.951-9.84.002-2.628-1.02-5.1-2.877-6.958C16.002 3.55 13.541 2.529 10.93 2.528 5.446 2.528 1.054 6.945 1.05 12.37c-.001 1.745.474 3.447 1.378 4.969L1.45 22.062l4.442-1.362zM18.175 14.9c-.33-.165-1.951-.963-2.25-1.072-.3-.11-.519-.165-.738.165-.219.33-.847 1.072-1.039 1.29-.192.219-.384.246-.714.081-.33-.165-1.393-.513-2.653-1.637-1.033-.92-1.73-2.057-1.933-2.404-.203-.347-.022-.534.143-.699.148-.148.33-.384.495-.577.165-.192.22-.33.33-.549.11-.219.055-.411-.027-.577-.082-.165-.738-1.782-1.011-2.44-.267-.643-.538-.553-.738-.563-.19-.01-.41-.01-.629-.01-.219 0-.575.082-.876.411-.3.33-1.15 1.124-1.15 2.741 0 1.617 1.178 3.181 1.339 3.4.162.22 2.316 3.537 5.611 4.96.783.338 1.395.54 1.872.693.787.25 1.5.215 2.065.13.629-.094 1.951-.797 2.226-1.566.275-.769.275-1.428.192-1.566-.083-.138-.302-.22-.632-.385z"/>
                            </svg>
                            Enviar WhatsApp
                        </a>
                    </div>
                @endif
            </div>
        @endif

        @if(session('success_profile'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Operación Exitosa!',
                        text: "{{ session('success_profile') }}",
                        icon: 'success',
                        background: '#181818',
                        color: '#fff',
                        confirmButtonColor: '#eab308'
                    });
                });
            </script>
        @endif

        <!-- ==================== TABS CONTENT ==================== -->

        <!-- TAB: INICIO -->
        <section id="content-inicio" class="tab-content space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Card Servicios -->
                <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between hover:border-yellow-500/30 transition">
                    <div>
                        <h3 class="text-xl font-bold text-yellow-500 mb-2">Servicios y Tarifas</h3>
                        <p class="text-gray-400 text-sm">Explora nuestra gama de cortes, fades y arreglo de barba profesional con los mejores precios.</p>
                    </div>
                    <button onclick="switchTab('servicios')" class="mt-6 text-sm text-yellow-500 hover:underline text-left font-semibold">Ver servicios disponibles →</button>
                </div>
                <!-- Card Barberos -->
                <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between hover:border-yellow-500/30 transition">
                    <div>
                        <h3 class="text-xl font-bold text-yellow-500 mb-2">Nuestros Barberos</h3>
                        <p class="text-gray-400 text-sm">Conoce a nuestro equipo de estilistas profesionales y elige al indicado para tu estilo.</p>
                    </div>
                    <button onclick="switchTab('barberos')" class="mt-6 text-sm text-yellow-500 hover:underline text-left font-semibold">Conocer barberos →</button>
                </div>
            </div>
        </section>

        <!-- TAB: SERVICIOS -->
        <section id="content-servicios" class="tab-content hidden space-y-6">
            <h3 class="text-2xl font-bold mb-6">Nuestros Servicios</h3>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between hover:border-yellow-500/40 transition">
                        <div>
                            <h4 class="text-xl font-bold text-yellow-500 mb-2">{{ $service->name }}</h4>
                            <p class="text-gray-400 text-sm mb-4">{{ $service->description }}</p>
                        </div>
                        <span class="text-2xl font-extrabold text-white mt-4">${{ number_format($service->price, 0) }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- TAB: BARBEROS -->
        <section id="content-barberos" class="tab-content hidden space-y-6">
            <h3 class="text-2xl font-bold mb-6">Barberos Disponibles</h3>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($barberos as $barbero)
                    <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col items-center text-center hover:border-yellow-500/40 transition">
                        <div class="w-20 h-20 rounded-full bg-yellow-500/10 flex items-center justify-center mb-4 border border-yellow-500/20">
                            <span class="text-4xl">🧔</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-1">{{ $barbero->name }}</h4>
                        <span class="text-xs text-yellow-500 uppercase tracking-widest font-semibold mb-3">
                            {{ $barbero->barbero ? $barbero->barbero->especialidad : 'Estilista' }}
                        </span>
                        <p class="text-gray-400 text-xs mt-2">Teléfono: {{ $barbero->phone }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- TAB: CITAS -->
        <section id="content-citas" class="tab-content hidden max-w-2xl mx-auto">
            <div class="bg-[#181818] border border-gray-800 p-8 rounded-2xl space-y-6">
                <div class="text-center mb-4">
                    <h3 class="text-2xl font-bold text-yellow-500">Agendar Cita</h3>
                    <p class="text-gray-400 text-sm mt-1">Completa el formulario para reservar tu espacio con tu barbero de preferencia.</p>
                </div>

                <form method="POST" action="{{ route('citas.store') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Precompletamos nombre y teléfono con la sesión del cliente -->
                    <input type="hidden" name="nombre_cliente" value="{{ $user->name }}">
                    <input type="hidden" name="telefono" value="{{ $user->phone }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">

                    <div>
                        <label class="block mb-1.5 text-sm text-gray-400">Servicio</label>
                        <select name="servicio" required
                                class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white bg-black">
                            @foreach($services as $service)
                                <option value="{{ $service->name }}">{{ $service->name }} (${{ number_format($service->price, 0) }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm text-gray-400">Barbero</label>
                        <select name="barbero" required
                                class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white bg-black">
                            @foreach($barberos as $barbero)
                                <option value="{{ $barbero->name }}">{{ $barbero->name }} ({{ $barbero->barbero ? $barbero->barbero->especialidad : 'Estilista' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-1.5 text-sm text-gray-400 font-semibold">Fecha</label>
                            <input type="text" name="fecha" id="citas-datepicker" required placeholder="Seleccione una fecha"
                                   class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white text-center font-medium bg-black">
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm text-gray-400 font-semibold">Hora</label>
                            <select name="hora" id="citas-hora" required disabled
                                    class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white disabled:opacity-50">
                                <option value="">Seleccione una fecha primero</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-4 rounded-xl transition shadow-lg hover:shadow-yellow-500/20 active:scale-[0.98] mt-4">
                        Confirmar Cita
                    </button>
                </form>
            </div>
        </section>

        <!-- TAB: PERFIL -->
        <section id="content-perfil" class="tab-content hidden">
            <div class="max-w-xl mx-auto bg-[#181818] border border-gray-800 p-8 rounded-2xl">
                <h3 class="text-2xl font-bold mb-6 text-yellow-500">Mi Perfil</h3>

                <form method="POST" action="{{ route('perfil.update') }}" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre Completo</label>
                        <input type="text" name="name" value="{{ $user->name }}" required
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Teléfono</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" required
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ $user->email }}" required
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div class="border-t border-gray-800 my-6 pt-4">
                        <span class="text-xs text-yellow-500/80 block mb-3 font-semibold uppercase tracking-wider">Cambiar Contraseña (Dejar en blanco para mantener la actual)</span>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nueva Contraseña</label>
                                <input type="password" name="password" placeholder="Mínimo 8 caracteres"
                                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Confirmar Nueva Contraseña</label>
                                <input type="password" name="password_confirmation" placeholder="Repite tu nueva contraseña"
                                       class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3.5 rounded-xl transition shadow-lg hover:shadow-yellow-500/20">
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </section>

    </main>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    <script>
        // ==================== TABS SWITCHER ====================
        function switchTab(tabName) {
            // Ocultar todos los contenidos de tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            // Remover estado activo de botones
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active-tab'));
            
            // Mostrar el tab seleccionado
            document.getElementById('content-' + tabName).classList.remove('hidden');
            document.getElementById('tab-' + tabName).classList.add('active-tab');
        }

        // ==================== CALENDARIO Y HORAS EN CITAS ====================
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('citas-datepicker');
            const timeSelect = document.getElementById('citas-hora');

            // Inicializar Flatpickr
            flatpickr(dateInput, {
                locale: 'es',
                dateFormat: 'Y-m-d',
                minDate: 'today',
                disable: [
                    function(date) {
                        return (date.getDay() === 0); // Deshabilitar Domingos
                    }
                ],
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) {
                        timeSelect.innerHTML = '<option value="">Cargando horas...</option>';
                        timeSelect.disabled = true;

                        fetch(`/citas/horas-disponibles?fecha=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                timeSelect.innerHTML = '';
                                if (data.length > 0) {
                                    timeSelect.disabled = false;
                                    
                                    const placeholderOpt = document.createElement('option');
                                    placeholderOpt.value = '';
                                    placeholderOpt.textContent = 'Seleccione una hora';
                                    timeSelect.appendChild(placeholderOpt);

                                    data.forEach(hora => {
                                        const option = document.createElement('option');
                                        option.value = hora;
                                        
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
                            })
                            .catch(error => {
                                console.error('Error cargando horas:', error);
                                timeSelect.innerHTML = '<option value="">Error al cargar horas</option>';
                                timeSelect.disabled = true;
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
