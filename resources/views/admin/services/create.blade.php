<x-admin-layout tittle="Servicios" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Servicios',
        'href' => route('admin.services.index'),
    ],
    [
        'name' => 'Crear',
    ],
]">

    <x-wire-card>
        <x-validation-errors class="mb-4 text-red-500" />
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <x-wire-input label="Nombre del servicio" name="name" required :value="old('name')"></x-wire-input>

                <x-wire-textarea label="Descripción" name="description" required :value="old('description')"></x-wire-textarea>

                <div>
                    <x-wire-input label="Precio" name="price" type="number" min="0" step="0.01" required prefix="$" :value="old('price')"></x-wire-input>
                </div>

                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>Guardar</x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
