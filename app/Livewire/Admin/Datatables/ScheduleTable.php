<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;

class ScheduleTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Schedule::query()->with('user');
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
            Column::make("Barbero", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Día", "day_of_week")
                ->sortable()
                ->format(function($value) {
                    $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                    return $days[$value] ?? 'Desconocido';
                }),
            Column::make("Hora Inicio", "start_time")
                ->sortable(),
            Column::make("Hora Fin", "end_time")
                ->sortable(),
            Column::make("Laboral", "is_working")
                ->sortable()
                ->format(fn($v) => $v ? 'Sí' : 'No'),
            Column::make("Acciones")
                ->label(function($row) {
                    return view('admin.schedules.actions', ['schedule' => $row]);
                })
        ];
    }
}
