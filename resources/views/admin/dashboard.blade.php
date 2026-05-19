<x-admin-layout title="Dashboard" :breadcrumbs="[
    [
        'name' => 'Dashboard',
    ],
]">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <i class="fa-regular fa-calendar-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Citas Hoy</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $appointmentsToday }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <i class="fa-solid fa-money-bill-wave text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Ingresos del Mes</h3>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($incomeMonth, 2) }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <i class="fa-solid fa-hourglass-half text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Citas Pendientes</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingAppointments }}</p>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                    <i class="fa-solid fa-scissors text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">Barberos Activos</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalBarbers }}</p>
                </div>
            </div>
        </x-wire-card>
    </div>
</x-admin-layout>
