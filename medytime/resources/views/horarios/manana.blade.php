<x-layouts.app>

    <flux:breadcrumbs class="mb-6">
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                    Dashboard
                </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{ route('horario') }}">
         Horario
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Horario de medicamentos - Mañana
        </flux:breadcrumbs.item>

    </flux:breadcrumbs>

 {{-- <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
            <p class="text-sm text-zinc-600">Horario de Medicamentos</p>

            @if(!$turno || $turno === 'manana')
                <div id="manana" class="mt-6 rounded-xl border border-dashed border-zinc-300 p-6 text-sm text-zinc-700">
                    <h2 class="text-lg font-semibold">Mañana</h2>
                    <p class="mt-2">Medicamentos programados para la mañana.</p>
                    @if($morning->isEmpty())
                        <p class="mt-4 text-zinc-500">No hay medicamentos programados para la mañana.</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($morning as $medicine)
                                <li class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="font-semibold">{{ $medicine->name }}</p>
                                            <p class="text-sm text-zinc-600">{{ $medicine->dosage }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="rounded-full bg-primary/10 px-3 py-1 text-sm font-medium text-primary">{{ $medicine->schedule_time->format('H:i') }}</span>
                                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $medicine->active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                                {{ $medicine->active ? 'Activo' : 'Finalizado' }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-zinc-500">{{ $medicine->frequency }} · {{ $medicine->instructions ?? 'Sin instrucciones adicionales' }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif --}}


<div class="text-2xl font-bold mb-4">
    🌅 Medicamentos de la Mañana
</div>

   <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Usuario
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Dosis
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Frecuencia
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Hora
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Instrucciones
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Activo
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($medicamentos as $medicamento)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $medicamento->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $medicamento->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicamento->user?->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicamento->dosage }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicamento->frequency }}
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($medicamento->schedule_time)->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicamento->instructions ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicamento->active ? 'Sí' : 'No' }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>





</x-layouts.app>