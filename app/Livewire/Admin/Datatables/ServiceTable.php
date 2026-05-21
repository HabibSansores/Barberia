<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;

class ServiceTable extends DataTableComponent
{
    protected $model = Service::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Precio", "price")
                ->sortable()
                ->format(fn($value) => '$' . number_format($value, 2)),
            Column::make("Acciones")
                ->label(function($row) {
                    return view('admin.services.actions', ['service' => $row]);
                })
        ];
    }
}
