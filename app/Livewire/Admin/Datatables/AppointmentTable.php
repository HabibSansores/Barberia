<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Cita;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Cita::query()->latest('fecha');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Cliente', 'nombre_cliente')
                ->sortable()
                ->searchable(),

            Column::make('Teléfono', 'telefono')
                ->sortable(),

            Column::make('Barbero', 'barbero')
                ->sortable()
                ->searchable(),

            Column::make('Servicio', 'servicio')
                ->sortable(),

            Column::make('Fecha', 'fecha')
                ->sortable()
                ->label(fn ($row) => \Carbon\Carbon::parse($row->fecha)->format('d/m/Y')),

            Column::make('Hora', 'hora')
                ->sortable()
                ->label(fn ($row) => \Carbon\Carbon::parse($row->hora)->format('g:i A')),

            Column::make('Estado', 'estado')
                ->sortable()
                ->label(fn ($row) => view('admin.appointments.status', ['appointment' => $row])),

            Column::make('Acciones')
                ->label(fn ($row) => view('admin.appointments.actions', ['appointment' => $row])),
        ];
    }
}
