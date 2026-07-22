<x-layouts.app>
    <div class="p-6">
        <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Horario administrativo</h1>
                <p class="text-sm text-zinc-600">Lista de todos los horarios de medicamentos de los usuarios.</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-default bg-white shadow-sm">
            <table class="min-w-full divide-y divide-zinc-200 text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-600">
                    <tr>
                        <th class="px-4 py-3">Usuario</th>
                        <th class="px-4 py-3">Medicamento</th>
                        <th class="px-4 py-3">Dosis</th>
                        <th class="px-4 py-3">Frecuencia</th>
                        <th class="px-4 py-3">Hora</th>
                        <th class="px-4 py-3">Activo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 bg-white">
                    @forelse ($medicamentos as $medicamento)
                        <tr class="hover:bg-zinc-50">
                            <td class="px-4 py-4 font-medium text-zinc-900">{{ $medicamento->user?->name ?? 'Desconocido' }}</td>
                            <td class="px-4 py-4 text-zinc-600">{{ $medicamento->name }}</td>
                            <td class="px-4 py-4 text-zinc-600">{{ $medicamento->dosage }}</td>
                            <td class="px-4 py-4 text-zinc-600">{{ $medicamento->frequency }}</td>
                            <td class="px-4 py-4 text-zinc-600">{{ optional($medicamento->schedule_time)->format('H:i') }}</td>
                            <td class="px-4 py-4 text-zinc-600">{{ $medicamento->active ? 'Sí' : 'No' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-sm text-zinc-500">No hay horarios disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
