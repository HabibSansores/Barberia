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
        return Cita::query()
            ->orderByRaw("
                CASE 
                    WHEN estado IN ('Pendiente', 'pendiente', 'Confirmada', 'confirmada') THEN 1
                    WHEN estado IN ('Completada', 'completada') THEN 2
                    WHEN estado IN ('Cancelada', 'cancelada') THEN 3
                    ELSE 4
                END ASC
            ")
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'asc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
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
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('d/m/Y')),

            Column::make('Hora', 'hora')
                ->sortable()
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('g:i A')),

            Column::make('Estado', 'estado')
                ->sortable()
                ->format(fn ($value, $row) => view('admin.appointments.status', ['appointment' => $row])),
        ];
    }
}
