<x-barber-layout title="Historial de Citas" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('barber.dashboard')],
    ['name' => 'Historial']
]">
    @livewire('barber.datatables.history-table')
</x-barber-layout>
