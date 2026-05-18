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

                <x-wire-textarea label="Descripción" name="description">{{ old('description', $service->description) }}</x-wire-textarea>

                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input label="Precio" name="price" type="number" step="0.01" required prefix="$" :value="old('price', $service->price)"></x-wire-input>

                    <x-wire-input label="Duración (minutos)" name="duration_minutes" type="number" required :value="old('duration_minutes', $service->duration_minutes)"></x-wire-input>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" name="image_path" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                    @if ($service->image_path)
                        <img src="{{ Storage::url($service->image_path) }}" alt="{{ $service->name }}" class="w-32 h-32 object-cover rounded">
                    @endif
                </div>

                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>Actualizar</x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
