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
        'name' => 'Editar',
    ],
]">

    <x-wire-card>
        <x-validation-errors class="mb-4 text-red-500" />
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <x-wire-input label="Nombre del servicio" name="name" required :value="old('name', $service->name)"></x-wire-input>

                <x-wire-textarea label="Descripción" name="description" required>{{ old('description', $service->description) }}</x-wire-textarea>

                <div>
                    <x-wire-input label="Precio" name="price" type="number" min="0" step="0.01" required prefix="$" :value="old('price', $service->price)"></x-wire-input>
                </div>

                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>Actualizar</x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
