<x-layouts.app>
    <div class="p-6">
        <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Editar medicamento</h1>
                <p class="text-sm text-zinc-600">Actualiza la información del medicamento.</p>
            </div>
            <a href="{{ route('admin.medicamentos.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>

        @if ($errors->any())
            <div class="rounded-base border border-rose-500 bg-rose-50 p-4 text-sm text-rose-800 mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.medicamentos.update', $medicine) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-4">
                <flux:select name="user_id" label="Usuario" required>
                    @forelse($users as $user)
                        <flux:select.option value="{{ $user->id }}" @selected($medicine->user_id === $user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </flux:select.option>
                    @empty
                        <flux:select.option disabled>No hay usuarios disponibles</flux:select.option>
                    @endforelse
                </flux:select>

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
                Guardar cambios
            </flux:button>
        </form>
    </div>
</x-layouts.app>
