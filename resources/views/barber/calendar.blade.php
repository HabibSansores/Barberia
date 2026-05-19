<x-barber-layout title="Calendario" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('barber.dashboard')],
    ['name' => 'Calendario']
]">
    <x-wire-card>
        <div id='calendar' class="bg-white p-4 rounded-lg"></div>
    </x-wire-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'es',
                slotMinTime: '08:00:00',
                slotMaxTime: '22:00:00',
                allDaySlot: false,
                events: '{{ route('barber.calendar.events') }}',
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault(); // don't let the browser navigate
                    }
                }
            });
            calendar.render();
        });
    </script>
</x-barber-layout>
