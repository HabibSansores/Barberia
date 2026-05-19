<x-admin-layout tittle="Horarios" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Horarios',
        'href' => route('admin.schedules.index'),
    ],
    [
        'name' => 'Editar',
    ],
]">

    <x-wire-card>
        <x-validation-errors class="mb-4 text-red-500" />
        <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <x-wire-native-select name="user_id" label="Barbero" required>
                    <option value="">Seleccione un barbero</option>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}" @selected(old('user_id', $schedule->user_id) == $barber->id)>{{ $barber->name }}</option>
                    @endforeach
                </x-wire-native-select>

                <x-wire-native-select name="day_of_week" label="Día de la semana" required>
                    <option value="">Seleccione un día</option>
                    <option value="1" @selected(old('day_of_week', $schedule->day_of_week) == "1")>Lunes</option>
                    <option value="2" @selected(old('day_of_week', $schedule->day_of_week) == "2")>Martes</option>
                    <option value="3" @selected(old('day_of_week', $schedule->day_of_week) == "3")>Miércoles</option>
                    <option value="4" @selected(old('day_of_week', $schedule->day_of_week) == "4")>Jueves</option>
                    <option value="5" @selected(old('day_of_week', $schedule->day_of_week) == "5")>Viernes</option>
                    <option value="6" @selected(old('day_of_week', $schedule->day_of_week) == "6")>Sábado</option>
                    <option value="0" @selected(old('day_of_week', $schedule->day_of_week) == "0")>Domingo</option>
                </x-wire-native-select>

                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input label="Hora de Inicio" name="start_time" type="time" required :value="old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i'))"></x-wire-input>
                    <x-wire-input label="Hora de Fin" name="end_time" type="time" required :value="old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i'))"></x-wire-input>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_working" id="is_working" value="1" @checked(old('is_working', $schedule->is_working)) class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="is_working" class="text-sm font-medium text-gray-700">Día Laboral</label>
                </div>

                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>Actualizar</x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
