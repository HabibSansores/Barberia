<?php

namespace App\Livewire\Barber\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HistoryTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Appointment::query()
            ->with(['client', 'service'])
            ->where('barber_id', Auth::id())
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('start_time', 'desc');
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
            Column::make("Servicio", "service.name")
                ->sortable(),
            Column::make("Fecha", "appointment_date")
                ->sortable()
                ->format(fn($v) => \Carbon\Carbon::parse($v)->format('d/m/Y')),
            Column::make("Hora Inicio", "start_time")
                ->sortable()
                ->format(fn($v) => \Carbon\Carbon::parse($v)->format('H:i')),
            Column::make("Estado", "status")
                ->sortable()
                ->format(fn($v) => ucfirst($v)),
            Column::make("Precio", "total_price")
                ->sortable()
                ->format(fn($v) => '$' . number_format($v, 2)),
            Column::make("Acciones")
                ->label(fn($row) => view('barber.appointments.actions', ['appointment' => $row]))
        ];
    }
}
