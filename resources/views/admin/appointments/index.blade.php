<x-admin-layout tittle="Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Citas',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.appointments.pdf') }}" target="_blank">
            <i class="fa-solid fa-file-pdf"></i>
            Exportar PDF
        </x-wire-button>
    </x-slot>
    
    @livewire('admin.datatables.appointment-table')

</x-admin-layout>
