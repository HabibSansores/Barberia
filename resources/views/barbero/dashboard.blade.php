<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Barbero - BarberShop</title>
    
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
                BarberShop <span class="text-xs text-gray-400 font-normal">Panel Barbero</span>
            </h1>

            <div class="flex gap-6 text-sm font-medium">
                <button onclick="switchTab('inicio')" id="tab-inicio" class="tab-btn py-1 hover:text-yellow-500 transition active-tab">Inicio</button>
                <button onclick="switchTab('servicios')" id="tab-servicios" class="tab-btn py-1 hover:text-yellow-500 transition">Servicios</button>
                <button onclick="switchTab('citas')" id="tab-citas" class="tab-btn py-1 hover:text-yellow-500 transition">Citas</button>
                <button onclick="switchTab('historial')" id="tab-historial" class="tab-btn py-1 hover:text-yellow-500 transition">Historial</button>
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
             style="background-image: url('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=2070&auto=format&fit=crop');">
            <div class="absolute inset-0 bg-black/70"></div>
            <div class="relative z-10 px-8">
                <span class="text-yellow-500 text-sm font-semibold uppercase tracking-wider">Perfil Profesional</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-1 mb-2">Bienvenido, {{ $user->name }}</h2>
                <p class="text-gray-300 text-lg">Especialidad: <span class="text-yellow-400 font-medium">{{ $especialidad }}</span></p>
            </div>
        </div>

        <!-- NOTIFICACIONES FLASH DE SESSION -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Operación Exitosa!',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        background: '#181818',
                        color: '#fff',
                        confirmButtonColor: '#eab308'
                    });
                });
            </script>
        @endif

        @if(session('error_msg'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Horario No Disponible',
                        text: "{{ session('error_msg') }}",
                        icon: 'warning',
                        background: '#181818',
                        color: '#fff',
                        confirmButtonColor: '#eab308'
                    });
                });
            </script>
        @endif

        @if(session('service_success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Servicio Guardado!',
                        text: "{{ session('service_success') }}",
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

            {{-- ── ESTADÍSTICAS DEL DÍA ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Total citas hoy --}}
                <div class="bg-[#181818] border border-blue-900/50 p-5 rounded-2xl flex items-center gap-4">
                    <div class="p-3 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-2xl flex-shrink-0">
                        📅
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Total Hoy</p>
                        <p class="text-3xl font-extrabold text-white">{{ $citas->count() }}</p>
                    </div>
                </div>
                {{-- Completadas --}}
                <div class="bg-[#181818] border border-green-900/50 p-5 rounded-2xl flex items-center gap-4">
                    <div class="p-3 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-2xl flex-shrink-0">
                        ✅
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Completadas</p>
                        <p class="text-3xl font-extrabold text-white">{{ $citas->where('estado', 'completada')->count() }}</p>
                    </div>
                </div>
                {{-- Pendientes --}}
                <div class="bg-[#181818] border border-yellow-900/50 p-5 rounded-2xl flex items-center gap-4">
                    <div class="p-3 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-2xl flex-shrink-0">
                        ⏳
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Pendientes</p>
                        <p class="text-3xl font-extrabold text-white">{{ $citas->whereIn('estado', ['pendiente', 'confirmada', null])->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- ── RESUMEN GENERAL ── --}}
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Card Servicios -->
                <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-400 mb-2">Servicios Disponibles</h3>
                        <span class="text-4xl font-extrabold text-yellow-500">{{ $services->count() }}</span>
                    </div>
                    <button onclick="switchTab('servicios')" class="mt-4 text-sm text-yellow-500 hover:underline text-left">Gestionar servicios →</button>
                </div>
                <!-- Card Citas -->
                <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-400 mb-2">Mis Citas de Hoy</h3>
                        <span class="text-4xl font-extrabold text-yellow-500">{{ $citas->count() }}</span>
                    </div>
                    <button onclick="switchTab('citas')" class="mt-4 text-sm text-yellow-500 hover:underline text-left">Ver agenda completa →</button>
                </div>
                <!-- Card Especialidad -->
                <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-400 mb-2">Mi Especialidad</h3>
                        <p class="text-gray-300 mt-2">{{ $especialidad }}</p>
                    </div>
                    <button onclick="switchTab('perfil')" class="mt-4 text-sm text-yellow-500 hover:underline text-left">Editar perfil →</button>
                </div>
            </div>
        </section>

        <!-- TAB: SERVICIOS -->
        <section id="content-servicios" class="tab-content hidden space-y-6">
            <!-- LISTADO DE SERVICIOS -->
            <div id="services-list-container" class="space-y-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Catálogo de Servicios</h3>
                    <button onclick="showServiceForm()" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg font-semibold text-sm transition">
                        + Nuevo Servicio
                    </button>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl flex flex-col justify-between relative hover:border-yellow-500/50 transition">
                            <div>
                                <h4 class="text-xl font-bold text-yellow-500 mb-2">{{ $service->name }}</h4>
                                <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $service->description }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-2xl font-extrabold text-white">${{ number_format($service->price, 0) }}</span>
                                <div class="flex gap-2">
                                    <!-- Editar -->
                                    <button onclick="editService({{ $service->id }}, '{{ addslashes($service->name) }}', '{{ addslashes($service->description) }}', {{ $service->price }})" 
                                            class="p-2 bg-blue-900/50 border border-blue-700 text-blue-300 rounded-lg hover:bg-blue-800 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <!-- Eliminar -->
                                    <form id="delete-service-form-{{ $service->id }}" action="{{ route('servicios.destroy', $service->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeleteService({{ $service->id }})" 
                                                class="p-2 bg-red-900/50 border border-red-700 text-red-300 rounded-lg hover:bg-red-800 hover:text-white transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- FORMULARIO CREAR/EDITAR SERVICIO -->
            <div id="service-form-container" class="hidden max-w-xl mx-auto bg-[#181818] border border-gray-800 p-8 rounded-2xl">
                <h3 id="service-form-title" class="text-2xl font-bold mb-6 text-yellow-500">Nuevo Servicio</h3>
                
                <form id="service-form" method="POST" action="{{ route('servicios.store') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="_method" id="service-form-method" value="POST">

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre del Servicio</label>
                        <input type="text" name="name" id="service-name" required placeholder="Ej. Fade Premium"
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Descripción (máx. 150 caracteres)</label>
                        <textarea name="description" id="service-description" required maxlength="150" rows="3" placeholder="Ej. Fade moderno con diseño personalizado..."
                                  class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition"></textarea>
                        <div class="text-right text-xs text-gray-500 mt-1">
                            <span id="char-counter">0</span> / 150 caracteres
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Precio ($)</label>
                        <input type="number" name="price" id="service-price" required min="0" step="any" placeholder="Ej. 180"
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="button" onclick="hideServiceForm()" class="w-1/2 border border-gray-700 hover:bg-gray-800 text-white font-bold py-3.5 rounded-xl transition">
                            Volver
                        </button>
                        <button type="submit" class="w-1/2 bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3.5 rounded-xl transition shadow-lg hover:shadow-yellow-500/20">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- TAB: CITAS -->
        <section id="content-citas" class="tab-content hidden space-y-6">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- COLUMNA CALENDARIO -->
                <div class="bg-[#181818] border border-gray-800 p-6 rounded-2xl space-y-4">
                    <h3 class="text-lg font-bold text-yellow-500 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Filtrar por Fecha
                    </h3>
                    <input type="text" id="citas-datepicker" placeholder="Seleccione una fecha" class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 text-white text-center font-medium">
                    
                    <button onclick="showCitaModal()" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 rounded-xl transition text-sm">
                        Nueva Cita
                    </button>
                </div>

                <!-- COLUMNA LISTADO CITAS -->
                <div class="lg:col-span-2 bg-[#181818] border border-gray-800 p-6 rounded-2xl">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Agenda de Citas</h3>
                        <span id="citas-selected-date" class="text-sm font-semibold text-yellow-500 uppercase tracking-wider">Hoy</span>
                    </div>

                    <div id="citas-list-container" class="space-y-4 max-h-[450px] overflow-y-auto pr-2">
                        <!-- Se carga vía AJAX/DOM o Laravel inicialmente -->
                        @if($citas->count() > 0)
                            @foreach($citas as $cita)
                                <div class="bg-black border border-gray-800 p-4 rounded-xl flex justify-between items-center hover:border-yellow-500/30 transition">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2">
                                            <span class="bg-yellow-500/10 border border-yellow-500/30 text-yellow-500 text-xs px-2 py-0.5 rounded font-mono">
                                                {{ date('h:i A', strtotime($cita->hora)) }}
                                            </span>
                                            <h4 class="font-bold text-gray-200">{{ $cita->nombre_cliente }}</h4>
                                        </div>
                                        <p class="text-xs text-gray-400">Servicio: <span class="text-gray-300">{{ $cita->servicio }}</span></p>
                                        <p class="text-xs text-gray-400">Teléfono: <span class="text-gray-300">{{ $cita->telefono }}</span></p>
                                    </div>
                                    <div>
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-500/10 text-yellow-500 border border-yellow-500/20">
                                            {{ $cita->estado }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <span class="text-4xl block mb-2">📅</span>
                                No tienes citas registradas para este día.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- TAB: HISTORIAL -->
        <section id="content-historial" class="tab-content hidden space-y-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold">Historial de Citas</h3>
                <span class="text-sm font-semibold text-yellow-500 uppercase tracking-wider">Historial Profesional</span>
            </div>

            {{-- ── Botones de Filtro ── --}}
            <div class="inline-flex flex-row items-center gap-1 sm:gap-2 bg-[#121212] p-1.5 rounded-xl border border-gray-800 overflow-x-auto max-w-full">
                <button onclick="filterBarberHistory('todas')" id="btn-filter-todas" class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg text-xs font-bold transition bg-yellow-500 text-black whitespace-nowrap">
                    Todas ({{ $todasLasCitas->count() }})
                </button>
                <button onclick="filterBarberHistory('activas')" id="btn-filter-activas" class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg text-xs font-bold transition text-gray-400 hover:text-white whitespace-nowrap">
                    Activas ({{ $todasLasCitas->whereIn('estado', ['Pendiente', 'pendiente', 'Confirmada', 'confirmada'])->count() }})
                </button>
                <button onclick="filterBarberHistory('finalizadas')" id="btn-filter-finalizadas" class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg text-xs font-bold transition text-gray-400 hover:text-white whitespace-nowrap">
                    Finalizadas ({{ $todasLasCitas->where('estado', 'completada')->count() }})
                </button>
                <button onclick="filterBarberHistory('canceladas')" id="btn-filter-canceladas" class="filter-btn px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg text-xs font-bold transition text-gray-400 hover:text-white whitespace-nowrap">
                    Canceladas ({{ $todasLasCitas->whereIn('estado', ['Cancelada', 'cancelada'])->count() }})
                </button>
            </div>

            {{-- ── Listado del Historial ── --}}
            <div class="bg-[#181818] border border-gray-800 rounded-2xl overflow-hidden">
                <div class="divide-y divide-gray-800/60 max-h-[600px] overflow-y-auto" id="barber-history-list">
                    @forelse($todasLasCitas as $cita)
                        @php
                            $estadoOriginal = strtolower($cita->estado);
                            
                            // Categorizar para el filtro de JS
                            $categoria = 'otras';
                            if (in_array($estadoOriginal, ['pendiente', 'confirmada'])) {
                                $categoria = 'activas';
                            } elseif ($estadoOriginal === 'completada') {
                                $categoria = 'finalizadas';
                            } elseif (in_array($estadoOriginal, ['cancelada'])) {
                                $categoria = 'canceladas';
                            }

                            $colorBadge = match(true) {
                                in_array($estadoOriginal, ['pendiente']) => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                in_array($estadoOriginal, ['confirmada']) => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                $estadoOriginal === 'completada' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                in_array($estadoOriginal, ['cancelada']) => 'bg-red-500/10 text-red-400 border-red-500/20',
                                default => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                            };
                        @endphp
                        <div class="barber-history-item px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 hover:bg-white/5 transition" data-category="{{ $categoria }}">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 text-xs px-2.5 py-0.5 rounded font-mono font-semibold">
                                        {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }} — {{ date('g:i A', strtotime($cita->hora)) }}
                                    </span>
                                </div>
                                <h4 class="text-base font-bold text-white">{{ $cita->nombre_cliente }}</h4>
                                <p class="text-xs text-gray-400">
                                    Servicio: <span class="text-gray-300 font-semibold">{{ $cita->servicio }}</span> &nbsp;·&nbsp;
                                    Teléfono: <span class="text-gray-300 font-semibold">{{ $cita->telefono }}</span>
                                    @if($cita->email)
                                        &nbsp;·&nbsp; Email: <span class="text-gray-300">{{ $cita->email }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $colorBadge }} self-start sm:self-auto uppercase tracking-wide">
                                    {{ $cita->estado }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center text-gray-500">
                            <span class="text-4xl block mb-3">📋</span>
                            No se encontraron citas en tu historial profesional.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- TAB: PERFIL -->
        <section id="content-perfil" class="tab-content hidden">
            <div class="max-w-xl mx-auto bg-[#181818] border border-gray-800 p-8 rounded-2xl">
                <h3 class="text-2xl font-bold mb-6 text-yellow-500">Editar Perfil</h3>

                <form method="POST" action="{{ route('perfil.update') }}" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre Completo</label>
                        <input type="text" name="name" value="{{ $user->name }}" required
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Especialidad</label>
                        <input type="text" name="especialidad" value="{{ $especialidad }}" required
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 text-white transition">
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Teléfono (WhatsApp)</label>
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

    <!-- MODAL REGISTRO DE CITA -->
    <div id="cita-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm hidden px-4">
        <div class="max-w-md w-full bg-[#181818] border border-gray-800 p-8 rounded-2xl space-y-6 relative">
            <button onclick="hideCitaModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white text-xl font-bold">×</button>
            <h3 class="text-2xl font-bold text-yellow-500">Agendar Cita</h3>

            <form id="modal-cita-form" method="POST" action="{{ route('citas.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="barbero" value="{{ $user->name }}">

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Correo Electrónico (Para auto-completar)</label>
                    <input type="email" name="email" id="modal-email" placeholder="cliente@correo.com"
                           class="w-full bg-black border border-gray-700 rounded-xl px-4 py-2.5 focus:outline-none focus:border-yellow-500 text-white transition-all duration-300">
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre del Cliente</label>
                    <input type="text" name="nombre_cliente" id="modal-nombre_cliente" required readonly placeholder="Se completará al ingresar correo"
                           class="w-full bg-[#121212] border border-gray-800 rounded-xl px-4 py-2.5 focus:outline-none text-gray-400 cursor-not-allowed transition-all duration-300">
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Teléfono</label>
                    <input type="text" name="telefono" id="modal-telefono" required readonly placeholder="Se completará al ingresar correo"
                           class="w-full bg-[#121212] border border-gray-800 rounded-xl px-4 py-2.5 focus:outline-none text-gray-400 cursor-not-allowed transition-all duration-300">
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Servicio</label>
                    <select name="servicio" required
                            class="w-full bg-black border border-gray-700 rounded-xl px-4 py-2.5 focus:outline-none focus:border-yellow-500 text-white">
                        @foreach($services as $service)
                            <option value="{{ $service->name }}">{{ $service->name }} (${{ number_format($service->price, 0) }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</label>
                        <input type="text" name="fecha" id="modal-fecha" required placeholder="AAAA-MM-DD"
                               class="w-full bg-black border border-gray-700 rounded-xl px-4 py-2.5 focus:outline-none focus:border-yellow-500 text-white">
                    </div>
                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Hora</label>
                        <select name="hora" id="modal-hora" required disabled
                                class="w-full bg-black border border-gray-700 rounded-xl px-4 py-2.5 focus:outline-none focus:border-yellow-500 text-white disabled:opacity-50">
                            <option value="">Fecha primero</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3.5 rounded-xl transition shadow-lg mt-4">
                    Confirmar Cita
                </button>
            </form>
        </div>
    </div>

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

        // ==================== SERVICE FORM ACTIONS ====================
        const charCounter = document.getElementById('char-counter');
        const serviceDescription = document.getElementById('service-description');

        if(serviceDescription) {
            serviceDescription.addEventListener('input', function() {
                charCounter.textContent = this.value.length;
            });
        }

        function showServiceForm() {
            document.getElementById('services-list-container').classList.add('hidden');
            document.getElementById('service-form-container').classList.remove('hidden');
            
            // Resetear para creación
            document.getElementById('service-form-title').textContent = 'Nuevo Servicio';
            document.getElementById('service-form').action = "{{ route('servicios.store') }}";
            document.getElementById('service-form-method').value = 'POST';
            document.getElementById('service-name').value = '';
            document.getElementById('service-description').value = '';
            document.getElementById('service-price').value = '';
            charCounter.textContent = 0;
        }

        function hideServiceForm() {
            document.getElementById('service-form-container').classList.add('hidden');
            document.getElementById('services-list-container').classList.remove('hidden');
        }

        function editService(id, name, description, price) {
            document.getElementById('services-list-container').classList.add('hidden');
            document.getElementById('service-form-container').classList.remove('hidden');
            
            document.getElementById('service-form-title').textContent = 'Editar Servicio';
            
            // Configurar ruta y método PUT para edición
            document.getElementById('service-form').action = `/servicios/${id}`;
            document.getElementById('service-form-method').value = 'PUT';
            
            document.getElementById('service-name').value = name;
            document.getElementById('service-description').value = description;
            document.getElementById('service-price').value = price;
            charCounter.textContent = description.length;
        }

        function confirmDeleteService(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará permanentemente el servicio del catálogo.",
                icon: 'warning',
                showCancelButton: true,
                background: '#181818',
                color: '#fff',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-service-form-' + id).submit();
                }
            });
        }

        // ==================== CALENDARIO Y AGENDA AJAX ====================
        document.addEventListener('DOMContentLoaded', function() {
            const datepicker = document.getElementById('citas-datepicker');
            const citasContainer = document.getElementById('citas-list-container');
            const selectedDateLabel = document.getElementById('citas-selected-date');
            
            // Inicializar Flatpickr en español
            flatpickr(datepicker, {
                locale: 'es',
                dateFormat: 'Y-m-d',
                defaultDate: 'today',
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) {
                        // Cambiar la etiqueta
                        selectedDateLabel.textContent = dateStr;
                        
                        // Consultar citas por AJAX
                        citasContainer.innerHTML = '<div class="text-center py-8 text-gray-500">Cargando citas...</div>';
                        
                        fetch(`/barbero/citas?fecha=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                citasContainer.innerHTML = '';
                                if(data.length > 0) {
                                    data.forEach(cita => {
                                        // Formatear hora de 24h a 12h para mostrarla bonita
                                        const [h, m] = cita.hora.split(':');
                                        const hourNum = parseInt(h);
                                        const ampm = hourNum >= 12 ? 'PM' : 'AM';
                                        const displayHour = hourNum % 12 || 12;
                                        const displayTime = `${displayHour}:${m} ${ampm}`;

                                        const item = document.createElement('div');
                                        item.className = "bg-black border border-gray-800 p-4 rounded-xl flex justify-between items-center hover:border-yellow-500/30 transition";
                                        item.innerHTML = `
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="bg-yellow-500/10 border border-yellow-500/30 text-yellow-500 text-xs px-2 py-0.5 rounded font-mono">
                                                        ${displayTime}
                                                    </span>
                                                    <h4 class="font-bold text-gray-200">${cita.nombre_cliente}</h4>
                                                </div>
                                                <p class="text-xs text-gray-400">Servicio: <span class="text-gray-300">${cita.servicio}</span></p>
                                                <p class="text-xs text-gray-400">Teléfono: <span class="text-gray-300">${cita.telefono}</span></p>
                                            </div>
                                            <div>
                                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-500/10 text-yellow-500 border border-yellow-500/20">
                                                    ${cita.estado}
                                                </span>
                                            </div>
                                        `;
                                        citasContainer.appendChild(item);
                                    });
                                } else {
                                    citasContainer.innerHTML = `
                                        <div class="text-center py-8 text-gray-500">
                                            <span class="text-4xl block mb-2">📅</span>
                                            No tienes citas registradas para este día.
                                        </div>
                                    `;
                                }
                            })
                            .catch(error => {
                                console.error('Error cargando citas:', error);
                                citasContainer.innerHTML = '<div class="text-center py-8 text-red-500">Error al cargar citas del día.</div>';
                            });
                    }
                }
            });

            // ==================== FORMULARIO DE CITA MODAL ====================
            const modalFechaInput = document.getElementById('modal-fecha');
            const modalHoraSelect = document.getElementById('modal-hora');

            flatpickr(modalFechaInput, {
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
                        modalHoraSelect.innerHTML = '<option value="">Cargando horas...</option>';
                        modalHoraSelect.disabled = true;

                        fetch(`/citas/horas-disponibles?fecha=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                modalHoraSelect.innerHTML = '';
                                if (data.error) {
                                    Swal.fire({
                                        title: 'Horario No Disponible',
                                        text: data.error,
                                        icon: 'warning',
                                        background: '#181818',
                                        color: '#fff',
                                        confirmButtonColor: '#eab308'
                                    });
                                    modalHoraSelect.innerHTML = `<option value="">Seleccione otra fecha</option>`;
                                    modalHoraSelect.disabled = true;
                                    return;
                                }
                                if (data.length > 0) {
                                    modalHoraSelect.disabled = false;
                                    const placeholderOpt = document.createElement('option');
                                    placeholderOpt.value = '';
                                    placeholderOpt.textContent = 'Seleccione una hora';
                                    modalHoraSelect.appendChild(placeholderOpt);

                                    data.forEach(hora => {
                                        const option = document.createElement('option');
                                        option.value = hora;
                                        
                                        const [h, m] = hora.split(':');
                                        const hourNum = parseInt(h);
                                        const ampm = hourNum >= 12 ? 'PM' : 'AM';
                                        const displayHour = hourNum % 12 || 12;
                                        option.textContent = `${displayHour}:${m} ${ampm}`;
                                        modalHoraSelect.appendChild(option);
                                    });
                                } else {
                                    modalHoraSelect.innerHTML = '<option value="">No hay horas disponibles</option>';
                                }
                            });
                    }
                }
            });

            // Auto-completar datos del cliente por correo
            const modalEmail = document.getElementById('modal-email');
            const modalNombre = document.getElementById('modal-nombre_cliente');
            const modalTelefono = document.getElementById('modal-telefono');
            let searchTimeout = null;

            if (modalEmail) {
                modalEmail.addEventListener('input', function() {
                    const email = this.value.trim();
                    
                    // Limpiar timeout anterior
                    clearTimeout(searchTimeout);

                    // Si está vacío o no parece correo, limpiar campos y quitar estilos de éxito
                    if (!email || !email.includes('@')) {
                        modalNombre.value = '';
                        modalTelefono.value = '';
                        modalNombre.classList.remove('border-green-500', 'text-green-400');
                        modalNombre.classList.add('border-gray-800', 'text-gray-400');
                        modalTelefono.classList.remove('border-green-500', 'text-green-400');
                        modalTelefono.classList.add('border-gray-800', 'text-gray-400');
                        return;
                    }

                    searchTimeout = setTimeout(() => {
                        fetch(`/citas/buscar-cliente?email=${encodeURIComponent(email)}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Auto-completar
                                    modalNombre.value = data.nombre;
                                    modalTelefono.value = data.telefono;

                                    // Aplicar efectos visuales premium
                                    modalNombre.classList.remove('border-gray-800', 'text-gray-400');
                                    modalNombre.classList.add('border-green-500', 'text-green-400');
                                    modalTelefono.classList.remove('border-gray-800', 'text-gray-400');
                                    modalTelefono.classList.add('border-green-500', 'text-green-400');

                                    // Mostrar Toast de éxito elegante con SweetAlert2
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        background: '#181818',
                                        color: '#fff',
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                    });

                                    Toast.fire({
                                        icon: 'success',
                                        title: '¡Cliente encontrado y auto-completado!'
                                    });
                                } else {
                                    // Limpiar valores y clases si no se encuentra
                                    modalNombre.value = '';
                                    modalTelefono.value = '';
                                    modalNombre.classList.remove('border-green-500', 'text-green-400');
                                    modalNombre.classList.add('border-gray-800', 'text-gray-400');
                                    modalTelefono.classList.remove('border-green-500', 'text-green-400');
                                    modalTelefono.classList.add('border-gray-800', 'text-gray-400');
                                }
                            })
                            .catch(error => {
                                console.error('Error al buscar cliente:', error);
                            });
                    }, 400); // 400ms debounce
                });
            }

            // Validar que el formulario no se envíe vacío o incompleto
            const modalCitaForm = document.getElementById('modal-cita-form');
            if (modalCitaForm) {
                modalCitaForm.addEventListener('submit', function(e) {
                    const email = modalEmail.value.trim();
                    const nombre = modalNombre.value.trim();
                    const telefono = modalTelefono.value.trim();
                    const fecha = document.getElementById('modal-fecha').value.trim();
                    const hora = document.getElementById('modal-hora').value.trim();

                    if (!email || !nombre || !telefono || !fecha || !hora) {
                        e.preventDefault(); // Detener el envío del formulario
                        
                        Swal.fire({
                            title: 'Campos Incompletos',
                            text: 'Por favor, ingrese el correo electrónico de un cliente registrado para auto-completar sus datos y seleccione la fecha/hora de la cita para poder continuar.',
                            icon: 'warning',
                            background: '#181818',
                            color: '#fff',
                            confirmButtonColor: '#eab308'
                        });
                    }
                });
            }
        });

        function showCitaModal() {
            document.getElementById('cita-modal').classList.remove('hidden');
        }

        function hideCitaModal() {
            document.getElementById('cita-modal').classList.add('hidden');
        }

        // ==================== BARBER HISTORY FILTER ====================
        function filterBarberHistory(category) {
            // Reset active states for filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-yellow-500', 'text-black');
                btn.classList.add('text-gray-400', 'hover:text-white');
            });

            // Set active button
            const activeBtn = document.getElementById('btn-filter-' + category);
            if (activeBtn) {
                activeBtn.classList.remove('text-gray-400', 'hover:text-white');
                activeBtn.classList.add('bg-yellow-500', 'text-black');
            }

            // Filter the elements
            const items = document.querySelectorAll('.barber-history-item');
            items.forEach(item => {
                if (category === 'todas') {
                    item.classList.remove('hidden');
                } else {
                    if (item.getAttribute('data-category') === category) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                }
            });
        }
    </script>
</body>
</html>
