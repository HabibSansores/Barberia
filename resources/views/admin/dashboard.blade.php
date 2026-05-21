<x-admin-layout title="Dashboard" :breadcrumbs="[['name' => 'Dashboard']]">

    {{-- ── KPI Cards ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <i class="fa-regular fa-calendar-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Citas Hoy</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $citasHoy }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <i class="fa-solid fa-hourglass-half text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pendientes</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $citasPendientes }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                    <i class="fa-solid fa-scissors text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Barberos Activos</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalBarberos }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <i class="fa-regular fa-calendar text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Citas Este Mes</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $citasEsteMes }}</p>
                </div>
            </div>
        </x-wire-card>

    </div>

    {{-- ── Gráficas ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        {{-- Línea: Citas últimos 7 días --}}
        <div class="lg:col-span-2">
            <x-wire-card>
                <h3 class="text-base font-semibold text-gray-700 mb-4">📈 Citas — Últimos 7 días</h3>
                <div class="relative h-64">
                    <canvas id="chartLinea"></canvas>
                </div>
            </x-wire-card>
        </div>

        {{-- Donut: Por estado --}}
        <div>
            <x-wire-card>
                <h3 class="text-base font-semibold text-gray-700 mb-4">🟡 Citas por Estado</h3>
                <div class="relative h-64 flex items-center justify-center">
                    <canvas id="chartDonut"></canvas>
                </div>
            </x-wire-card>
        </div>

    </div>

    {{-- Barras: Por barbero --}}
    <x-wire-card>
        <h3 class="text-base font-semibold text-gray-700 mb-4">✂️ Top Barberos por Citas</h3>
        <div class="relative h-64">
            <canvas id="chartBarberos"></canvas>
        </div>
    </x-wire-card>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // ── Datos desde PHP ──
        const datosLinea = {
            labels: {!! $citasUltimos7Dias->pluck('fecha')->map(fn($f) => "'" . \Carbon\Carbon::parse($f)->format('d/m') . "'")->implode(',') !!},
            valores: {!! $citasUltimos7Dias->pluck('total')->implode(',') !!}
        };

        const datosEstado = {
            labels: {!! $citasPorEstado->pluck('estado')->map(fn($e) => "'" . ucfirst($e) . "'")->implode(',') !!},
            valores: {!! $citasPorEstado->pluck('total')->implode(',') !!}
        };

        const datosBarbero = {
            labels: {!! $citasPorBarbero->pluck('barbero')->map(fn($b) => "'" . addslashes($b) . "'")->implode(',') !!},
            valores: {!! $citasPorBarbero->pluck('total')->implode(',') !!}
        };

        const coloresEstado = ['#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#8b5cf6'];

        // ── Chart 1: Línea (últimos 7 días) ──
        new Chart(document.getElementById('chartLinea'), {
            type: 'line',
            data: {
                labels: datosLinea.labels,
                datasets: [{
                    label: 'Citas',
                    data: datosLinea.valores,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245,158,11,0.1)',
                    borderWidth: 2,
                    pointBackgroundColor: '#f59e0b',
                    pointRadius: 5,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        // ── Chart 2: Donut (por estado) ──
        new Chart(document.getElementById('chartDonut'), {
            type: 'doughnut',
            data: {
                labels: datosEstado.labels,
                datasets: [{
                    data: datosEstado.valores,
                    backgroundColor: coloresEstado,
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 12, font: { size: 11 } } }
                },
                cutout: '65%',
            }
        });

        // ── Chart 3: Barras (por barbero) ──
        new Chart(document.getElementById('chartBarberos'), {
            type: 'bar',
            data: {
                labels: datosBarbero.labels,
                datasets: [{
                    label: 'Citas totales',
                    data: datosBarbero.valores,
                    backgroundColor: '#f59e0b',
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    </script>

</x-admin-layout>
