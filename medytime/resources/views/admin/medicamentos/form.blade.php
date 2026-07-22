@props(['medicine' => null, 'action', 'method' => 'POST'])

<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="grid gap-4">
        <flux:input
            name="name"
            label="Nombre del medicamento"
            type="text"
            value="{{ old('name', $medicine?->name) }}"
            placeholder="Nombre del medicamento"
            required
        />

        <flux:input
            name="dosage"
            label="Dosis"
            type="text"
            value="{{ old('dosage', $medicine?->dosage) }}"
            placeholder="Ej. 2 pastillas"
            required
        />

        <flux:input
            name="frequency"
            label="Frecuencia"
            type="text"
            value="{{ old('frequency', $medicine?->frequency) }}"
            placeholder="Ej. Cada 8 horas"
            required
        />

        <flux:input
            name="schedule_time"
            label="Hora de toma"
            type="time"
            value="{{ old('schedule_time', $medicine?->schedule_time?->format('H:i')) }}"
            required
        />

        <div class="grid gap-2">
            <label class="font-medium text-sm text-body">Instrucciones</label>
            <textarea
                name="instructions"
                rows="4"
                class="w-full rounded-base border border-default p-3 text-sm text-body focus:border-primary focus:outline-none"
                placeholder="Tomar con agua, después de comer, etc.">
{{ old('instructions', $medicine?->instructions) }}</textarea>
        </div>

        <div class="flex items-center gap-3">
            <input
                id="active"
                name="active"
                type="checkbox"
                class="h-4 w-4 rounded border-default text-primary focus:ring-primary"
                {{ old('active', $medicine?->active ?? true) ? 'checked' : '' }}
            />
            <label for="active" class="text-sm text-body">Medicamento activo</label>
        </div>
    </div>

    <flux:button type="submit" variant="primary" class="w-full">
        {{ $method === 'PUT' ? 'Guardar cambios' : 'Guardar medicamento' }}
    </flux:button>
</form>
