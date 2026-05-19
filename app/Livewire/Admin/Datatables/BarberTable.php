<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class BarberTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return User::query()
            ->whereHas('roles', function($q) {
                $q->where('name', 'Barbero');
            });
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
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make("Acciones")
                ->label(function($row) {
                    return view('admin.barbers.actions', ['barber' => $row]);
                })
        ];
    }
}
