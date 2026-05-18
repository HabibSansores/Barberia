<x-barber-layout title="Dashboard del Barbero" :breadcrumbs="[
    ['name' => 'Dashboard']
]">
    <!-- Tarjetas de Resumen -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <i class="fa-regular fa-calendar-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Total Hoy</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $appointmentsToday->count() }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <i class="fa-solid fa-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Completadas</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $completedToday }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <i class="fa-solid fa-hourglass-half text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Pendientes</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingToday }}</p>
                </div>
            </div>
        </x-wire-card>
    </div>

    <!-- Lista de Citas del Día -->
    <h2 class="text-xl font-bold text-gray-800 mb-4">Próximas Citas de Hoy</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($upcomingAppointments as $appointment)
            <x-wire-card>
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h4 class="font-bold text-lg">{{ $appointment->client->name ?? 'Cliente' }}</h4>
                        <p class="text-sm text-gray-500">{{ $appointment->service->name ?? 'Servicio' }}</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-400">
                        {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}
                    </span>
                </div>
                <div class="mt-4 flex gap-2">
                    <x-wire-button href="{{ route('barber.appointments.show', $appointment) }}" blue class="w-full">
                        Ver Detalles
                    </x-wire-button>
                </div>
            </x-wire-card>
        @empty
            <div class="col-span-full">
                <p class="text-gray-500 text-center py-4">No tienes más citas programadas para hoy.</p>
            </div>
        @endforelse
    </div>
</x-barber-layout>
