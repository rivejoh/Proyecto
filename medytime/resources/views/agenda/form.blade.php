<x-layouts.app>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Agendar Medicamento</h2>

    <form action="{{ route('agenda.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Medicamento</label>

            <input
                type="text"
                value="{{ $medicamento->name }}"
                class="w-full border rounded p-2 bg-gray-100"
                readonly
            >

            <input
                type="hidden"
                name="medicamento_id"
                value="{{ $medicamento->id }}"
            >
        </div>

        <div class="mb-4">
            <label class="block font-medium">Fecha</label>
            <input
                type="date"
                name="fecha"
                class="w-full border rounded p-2"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block font-medium">Hora</label>
            <input
                type="time"
                name="hora"
                value="{{ $medicamento->schedule_time?->format('H:i') }}"
                class="w-full border rounded p-2"
            >
        </div>

        <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded"
        >
            Guardar Agenda
        </button>

    </form>
</div>

</x-layouts.app>
