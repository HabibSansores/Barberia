<x-admin-layout tittle="Barberos" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Barberos',
        'href' => route('admin.barbers.index'),
    ],
    [
        'name' => 'Editar',
    ],
]">

    <x-wire-card>
        <x-validation-errors class="mb-4 text-red-500" />
        <form action="{{ route('admin.barbers.update', $barber) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input label="Nombre" name="name" placeholder="Nombre completo" required
                        :value="old('name', $barber->name)"></x-wire-input>

                    <x-wire-input label="Correo electronico" name="email" type="email"
                        placeholder="ejemplo@dominio.com" required autocomplete="email"
                        :value="old('email', $barber->email)"></x-wire-input>

                    <x-wire-input label="Contraseña" name="password" type="password" placeholder="Minimo 8 caracteres"
                        autocomplete="new-password"></x-wire-input>

                    <x-wire-input label="Confirmar contraseña" name="password_confirmation" type="password"
                        placeholder="Repita la contraseña" autocomplete="new-password"></x-wire-input>

                    <x-wire-input label="Numero de ID" name="id_number" placeholder="Ej. 123456789" autocomplete="off"
                        required inputmode="numeric" :value="old('id_number', $barber->id_number)"></x-wire-input>

                    <x-wire-input label="Telefono" name="phone" placeholder="Ej. 9999999999" autocomplete="tel"
                        required inputmode="tel" :value="old('phone', $barber->phone)"></x-wire-input>
                </div>

                <x-wire-input name="address" label="Direccion" required :value="old('address', $barber->address)"
                    placeholder="Ej. Calle 123 #432" autocomplete="street-address"></x-wire-input>

                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>Actualizar</x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
