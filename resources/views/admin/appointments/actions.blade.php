<div class="flex items-center gap-2">
    <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
            <i class="fa-solid fa-trash"></i>
        </x-wire-button>
    </form>
</div>
