<x-barber-layout title="Detalle de la Cita" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('barber.dashboard')],
    ['name' => 'Citas', 'href' => route('barber.calendar.index')],
    ['name' => 'Detalle']
]">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Perfil del Cliente -->
        <div class="md:col-span-1">
            <x-wire-card title="Perfil del Cliente">
                <div class="flex flex-col items-center text-center">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" 
                        src="{{ $appointment->client->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($appointment->client->name ?? 'C') }}" 
                        alt="Profile image"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $appointment->client->name ?? 'Desconocido' }}</h5>
                    <span class="text-sm text-gray-500">{{ $appointment->client->email ?? '' }}</span>
                    @if(optional($appointment->client)->phone)
                        <span class="text-sm text-gray-500 mt-1"><i class="fa-solid fa-phone mr-1"></i> {{ $appointment->client->phone }}</span>
                    @endif
                </div>
            </x-wire-card>
        </div>

        <!-- Detalles de la cita y Acciones -->
        <div class="md:col-span-2 space-y-6">
            <x-wire-card title="Información de la Cita">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Servicio Asignado</p>
                        <p class="font-semibold">{{ $appointment->service->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Precio</p>
                        <p class="font-semibold">${{ number_format($appointment->total_price, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Fecha</p>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Horario</p>
                        <p class="font-semibold">
                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i') }}
                        </p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-gray-500">Estado Actual</p>
                        <p class="font-semibold uppercase">{{ $appointment->status }}</p>
                    </div>
                </div>
            </x-wire-card>

            <x-wire-card title="Acciones">
                <div class="flex gap-4">
                    <form action="{{ route('barber.appointments.updateStatus', $appointment) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <x-wire-button type="submit" positive class="w-full" icon="check" :disabled="$appointment->status == 'completed' || $appointment->status == 'cancelled'">
                            Marcar como Completada
                        </x-wire-button>
                    </form>

                    <form action="{{ route('barber.appointments.updateStatus', $appointment) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <x-wire-button type="submit" negative class="w-full" icon="x-mark" :disabled="$appointment->status == 'completed' || $appointment->status == 'cancelled'">
                            No Asistió (Cancelar)
                        </x-wire-button>
                    </form>
                </div>
            </x-wire-card>
        </div>
    </div>
</x-barber-layout>
