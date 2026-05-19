<div class="flex items-center gap-2">
    <x-wire-button href="{{ route('admin.barbers.edit', $barber) }}" blue xs>
        <i class="fa-solid fa-pen-to-square"></i>
    </x-wire-button>

    <form action="{{ route('admin.barbers.destroy', $barber) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
            <i class="fa-solid fa-trash"></i>
        </x-wire-button>
    </form>
</div>
