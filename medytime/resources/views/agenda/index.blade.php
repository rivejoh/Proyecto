<x-layouts.app>

    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item>
            Dashboard
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{ route('agenda.index') }}">
            Agenda
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Calendario de medicamentos
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
 <div class="p-6">

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-300 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow border border-zinc-200 p-6">

            <h1 class="text-2xl font-bold text-zinc-800 mb-4">
                Agenda de Medicamentos
            </h1>

            <div id="calendar"
                 class="min-h-[650px] rounded-xl border border-zinc-200 bg-white">
            </div>

        </div>

    </div>


    <!-- TARJETA DEL MEDICAMENTO -->
    <div id="medicineNote"
         class="hidden fixed top-8 right-8 w-96 bg-white rounded-xl shadow-2xl border border-blue-300 p-5 z-50 transition-all">

        <div class="flex justify-between items-center mb-4">

            <h2 class="text-xl font-bold text-blue-700">
                💊 Información del medicamento
            </h2>

            <button onclick="cerrarNota()"
                    class="text-gray-500 hover:text-red-600 text-xl font-bold">

                ✕

            </button>

        </div>

        <div class="space-y-3">

            <div>
                <p class="font-semibold text-gray-700">
                    Medicamento
                </p>

                <div id="noteTitle"
                     class="rounded-lg bg-blue-50 p-2 border">
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-700">
                    Dosis
                </p>

                <div id="noteDosage"
                     class="rounded-lg bg-blue-50 p-2 border">
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-700">
                    Frecuencia
                </p>

                <div id="noteFrequency"
                     class="rounded-lg bg-blue-50 p-2 border">
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-700">
                    Instrucciones
                </p>

                <div id="noteInstructions"
                     class="rounded-lg bg-blue-50 p-3 border min-h-[70px]">
                </div>
            </div>

        </div>

    </div>


    <!-- FullCalendar -->

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',

                locale: 'es',

                height: "auto",

                events: @json($events),

                eventColor: '#2563eb',

                eventTextColor: '#ffffff',

                eventClick: function(info) {
                    console.log(info.event);

                    const note = document.getElementById('medicineNote');
                    const title = document.getElementById('noteTitle');
                    const dosage = document.getElementById('noteDosage');
                    const frequency = document.getElementById('noteFrequency');
                    const instructions = document.getElementById('noteInstructions');

                    if (!note || !title || !dosage || !frequency || !instructions) {
                        return;
                    }

                    note.style.display = 'block';
                    note.classList.remove('hidden');

                    title.textContent = info.event.title || 'Sin título';
                    dosage.textContent = info.event.extendedProps.dosage || 'No especificado';
                    frequency.textContent = info.event.extendedProps.frequency || 'No especificado';
                    instructions.textContent = info.event.extendedProps.instructions || 'Sin instrucciones';
                }

            });

            calendar.render();

        });


        function cerrarNota(){

            document.getElementById('medicineNote')
                .classList.add('hidden');

        }

    </script>

</x-layouts.app>
