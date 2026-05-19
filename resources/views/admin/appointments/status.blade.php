<form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="inline">
    @csrf
    @method('PUT')
    <select name="status" onchange="this.form.submit()" class="text-sm rounded border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        <option value="pending" @selected($appointment->status == 'pending')>Pendiente</option>
        <option value="confirmed" @selected($appointment->status == 'confirmed')>Confirmada</option>
        <option value="completed" @selected($appointment->status == 'completed')>Completada</option>
        <option value="cancelled" @selected($appointment->status == 'cancelled')>Cancelada</option>
    </select>
</form>
