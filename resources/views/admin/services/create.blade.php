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

                <x-wire-textarea label="Descripción" name="description" :value="old('description')"></x-wire-textarea>

                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input label="Precio" name="price" type="number" min="0" step="0.01" required prefix="$" :value="old('price')"></x-wire-input>

                    <x-wire-input label="Duración (minutos)" name="duration_minutes" type="number" min="1" required :value="old('duration_minutes')"></x-wire-input>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" name="image_path" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>Guardar</x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
