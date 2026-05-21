<form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="inline">
    @csrf
    @method('PUT')
    <select name="estado" onchange="this.form.submit()"
            class="text-sm rounded border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        <option value="Pendiente"   @selected($appointment->estado == 'Pendiente')>Pendiente</option>
        <option value="Confirmada"  @selected($appointment->estado == 'Confirmada')>Confirmada</option>
        <option value="completada"  @selected($appointment->estado == 'completada')>Completada</option>
        <option value="Cancelada"   @selected($appointment->estado == 'Cancelada')>Cancelada</option>
    </select>
</form>
