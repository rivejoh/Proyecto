<x-layouts.app>

    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">
            Dashboard
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{ route('user.medicamentos.index') }}">
            Medicamentos
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Agendar medicamento
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

<div class="p-6">

        <div class="mb-6">
            <h2 class="text-2xl font-bold">
                Complete la información.
            </h2>

        </div>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agenda.store') }}" method="POST">
            @csrf

                <flux:input
                    label="Nombre del medicamento"
                    value="{{ $medicamento->name }}"
                    readonly
                />

                <flux:input
                    label="Dosis"
                    value="{{ $medicamento->dosage }}"
                    readonly
                />

                <flux:input
                    label="Frecuencia"
                    value="{{ $medicamento->frequency }}"
                    readonly
                />

                <flux:input
                    name="start_date"
                    label="Fecha de inicio"
                    type="date"
                    value="{{ old('start_date', now()->format('Y-m-d')) }}"
                    required
                />

                <flux:input
                    name="schedule_time"
                    label="Hora de toma"
                    type="time"
                    value="{{ old('schedule_time', $medicamento?->schedule_time?->format('H:i')) }}"
                    required
                />
            <div class="grid gap-2">
                <label class="font-medium text-sm text-body">Instrucciones</label>
                    <textarea
                        name="instructions"
                        rows="4"
                        class="w-full rounded-base border border-default p-3 text-sm text-body focus:border-primary "
                        placeholder="Tomar con agua, después de comer, etc.">
                        {{ old('instructions', $medicamento?->instructions) }}</textarea>
            </div>

                <flux:input
                    label="Estado"
                    value="{{ $medicamento->active ? 'Activo' : 'Inactivo' }}"
                    readonly
                />

                <input
                    type="hidden"
                    name="medicamento_id"
                    value="{{ $medicamento->id }}"
                >

                <div class="mt-6">
                    <flux:button type="submit" variant="primary">
                        Guardar agenda
                    </flux:button>
                </div>

        </form>

    </div>

</x-layouts.app>