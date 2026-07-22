<x-layouts.app>

    <div class="p-6">
        <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Horario</h1>
                <p class="text-sm text-zinc-600">Consulta tus tomas ya finalizadas y los horarios de medicamentos que ya no están activos.</p>
            </div>
        </div>

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
            @endif

            @if(!$turno || $turno === 'tarde')
                <div id="tarde" class="mt-6 rounded-xl border border-dashed border-zinc-300 p-6 text-sm text-zinc-700">
                    <h2 class="text-lg font-semibold">Tarde</h2>
                    <p class="mt-2">Medicamentos programados para la tarde.</p>
                    @if($afternoon->isEmpty())
                        <p class="mt-4 text-zinc-500">No hay medicamentos programados para la tarde.</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($afternoon as $medicine)
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
            @endif

            @if(!$turno || $turno === 'noche')
                <div id="noche" class="mt-6 rounded-xl border border-dashed border-zinc-300 p-6 text-sm text-zinc-700">
                    <h2 class="text-lg font-semibold">Noche</h2>
                    <p class="mt-2">Medicamentos programados para la noche.</p>
                    @if($night->isEmpty())
                        <p class="mt-4 text-zinc-500">No hay medicamentos programados para la noche.</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($night as $medicine)
                                <li class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="font-semibold">{{ $medicine->name }}</p>
                                            <p class="text-sm text-zinc-600">{{ $medicine->dosage }}</p>
                                        </div>
                                        <span class="rounded-full bg-primary/10 px-3 py-1 text-sm font-medium text-primary">{{ $medicine->schedule_time->format('H:i') }}</span>
                                    </div>
                                    <p class="mt-2 text-sm text-zinc-500">{{ $medicine->frequency }} · {{ $medicine->instructions ?? 'Sin instrucciones adicionales' }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
        </div> --}}
    {{-- </div> --}}
</x-layouts.app>
