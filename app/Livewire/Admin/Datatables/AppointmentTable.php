<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;

class AppointmentTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Appointment::query()->with(['client', 'barber', 'service']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Cliente", "client.name")
                ->sortable()
                ->searchable(),
            Column::make("Barbero", "barber.name")
                ->sortable()
                ->searchable(),
            Column::make("Servicio", "service.name")
                ->sortable(),
            Column::make("Fecha", "appointment_date")
                ->sortable(),
            Column::make("Hora Inicio", "start_time")
                ->sortable(),
            Column::make("Estado", "status")
                ->sortable()
                ->label(fn($row) => view('admin.appointments.status', ['appointment' => $row])),
            Column::make("Acciones")
                ->label(function($row) {
                    return view('admin.appointments.actions', ['appointment' => $row]);
                })
        ];
    }
}
