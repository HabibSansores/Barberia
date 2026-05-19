<x-admin-layout tittle="Barberos" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Barberos',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.barbers.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo Barbero
        </x-wire-button>
    </x-slot>
    @livewire('admin.datatables.barber-table')

</x-admin-layout>
