    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nueva Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded relative mb-6 shadow-sm" role="alert">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <span class="block font-semibold text-green-800">{{ session('success') }}</span>
                            </div>
                            @if(session('whatsapp_url'))
                                <div>
                                    <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.458L0 24zm5.835-3.3c1.673.993 3.328 1.503 4.887 1.503 5.485 0 9.948-4.414 9.951-9.84.002-2.628-1.02-5.1-2.877-6.958C16.002 3.55 13.541 2.529 10.93 2.528 5.446 2.528 1.054 6.945 1.05 12.37c-.001 1.745.474 3.447 1.378 4.969L1.45 22.062l4.442-1.362zM18.175 14.9c-.33-.165-1.951-.963-2.25-1.072-.3-.11-.519-.165-.738.165-.219.33-.847 1.072-1.039 1.29-.192.219-.384.246-.714.081-.33-.165-1.393-.513-2.653-1.637-1.033-.92-1.73-2.057-1.933-2.404-.203-.347-.022-.534.143-.699.148-.148.33-.384.495-.577.165-.192.22-.33.33-.549.11-.219.055-.411-.027-.577-.082-.165-.738-1.782-1.011-2.44-.267-.643-.538-.553-.738-.563-.19-.01-.41-.01-.629-.01-.219 0-.575.082-.876.411-.3.33-1.15 1.124-1.15 2.741 0 1.617 1.178 3.181 1.339 3.4.162.22 2.316 3.537 5.611 4.96.783.338 1.395.54 1.872.693.787.25 1.5.215 2.065.13.629-.094 1.951-.797 2.226-1.566.275-.769.275-1.428.192-1.566-.083-.138-.302-.22-.632-.385z"/>
                                        </svg>
                                        Enviar WhatsApp
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('citas.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nombre_cliente" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Cliente:</label>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Ej. Juan Pérez">
                        </div>

                        <div>
                            <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono (WhatsApp - 10 dígitos):</label>
                            <input type="text" name="telefono" id="telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Ej: 6671234567">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico (Para recibir ticket PDF):</label>
                        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: cliente@correo.com">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Fecha de la Cita:</label>
                            <input type="text" name="fecha" id="fecha" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" required placeholder="Selecciona una fecha">
                        </div>

                        <div>
                            <label for="hora" class="block text-gray-700 text-sm font-bold mb-2">Hora de la Cita:</label>
                            <select name="hora" id="hora" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white disabled:bg-gray-100" required disabled>
                                <option value="">Seleccione una fecha primero</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Guardar Cita y Enviar Notificaciones
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('fecha');
            const timeSelect = document.getElementById('hora');

            // Inicializar Flatpickr en español
            flatpickr(dateInput, {
                locale: 'es',
                dateFormat: 'Y-m-d',
                minDate: 'today',
                disable: [
                    function(date) {
                        // Deshabilitar los Domingos (0 es Domingo)
                        return (date.getDay() === 0);
                    }
                ],
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) {
                        // Limpiar y deshabilitar temporalmente el select
                        timeSelect.innerHTML = '<option value="">Cargando horas...</option>';
                        timeSelect.disabled = true;

                        // Hacer petición AJAX para obtener horas disponibles
                        fetch(`/citas/horas-disponibles?fecha=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                timeSelect.innerHTML = '';
                                if (data.length > 0) {
                                    timeSelect.disabled = false;
                                    // Agregar opción inicial
                                    const placeholderOpt = document.createElement('option');
                                    placeholderOpt.value = '';
                                    placeholderOpt.textContent = 'Seleccione una hora';
                                    timeSelect.appendChild(placeholderOpt);

                                    // Llenar select con las horas devueltas
                                    data.forEach(hora => {
                                        const option = document.createElement('option');
                                        option.value = hora;
                                        // Formatear hora de 24h a 12h para mostrarla bonita
                                        const [h, m] = hora.split(':');
                                        const hourNum = parseInt(h);
                                        const ampm = hourNum >= 12 ? 'PM' : 'AM';
                                        const displayHour = hourNum % 12 || 12;
                                        option.textContent = `${displayHour}:${m} ${ampm}`;
                                        timeSelect.appendChild(option);
                                    });
                                } else {
                                    timeSelect.innerHTML = '<option value="">No hay horas disponibles para este día</option>';
                                    timeSelect.disabled = true;
                                }
                            })
                            .catch(error => {
                                console.error('Error cargando horas:', error);
                                timeSelect.innerHTML = '<option value="">Error al cargar horas</option>';
                                timeSelect.disabled = true;
                            });
                    } else {
                        timeSelect.innerHTML = '<option value="">Seleccione una fecha primero</option>';
                        timeSelect.disabled = true;
                    }
                }
            });
        });
    </script>
</x-app-layout>
