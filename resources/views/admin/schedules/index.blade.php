<x-admin-layout tittle="Horarios" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Horarios',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.schedules.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo Horario
        </x-wire-button>
    </x-slot>
    @livewire('admin.datatables.schedule-table')

</x-admin-layout>
