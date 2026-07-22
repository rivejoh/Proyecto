<x-layouts.app>
    <div class="grid gap-6 xl:grid-cols-[360px_minmax(0,1fr)]">
        <style>
            .grid > *:not(:last-child) {
                margin-bottom: 1.5rem;
            }.grid{
                display: flex; /*utilizar flexbox para organizar las tarjetas*/
                /* justify-content: center; centrar las tarjetas horizontalmente */
                gap: 50px; /*espacio entre las tarjetas*/
                flex-wrap: wrap; /*permitir que las tarjetas se ajusten a la siguiente línea si no caben en una sola fila*/
                
            }
        </style>
        <div class="space-y-6 self-start" style="width: 600px; height: 200px;">
            @include('admin.partials.menu')

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-1">
                <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
                    <p class="text-base text-zinc-500">Usuarios registrados</p>
                    <p class="mt-2 text-4xl font-semibold">{{ $totalUsers }}</p>
                </div>
                <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
                    <p class="text-base text-zinc-500">Medicamentos totales</p>
                    <p class="mt-2 text-4xl font-semibold">{{ $totalMedicamentos }}</p>
                </div>
                <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
                    <p class="text-base text-zinc-500">Medicamentos activos</p>
                    <p class="mt-2 text-4xl font-semibold">{{ $activeMedicamentos }}</p>
                </div>
            </div>
        </div>
        
        <section class="rounded-xl border border-default bg-white p-6 shadow-sm" style="width: 600px; height: 300px;">
            <div class="mb-6" >
                <h2 class="text-xl font-semibold">Usuarios</h2>
                <p class="text-sm text-zinc-500">Revisa a los usuarios registrados y su número de medicamentos.</p>
            </div>

            @if ($users->isEmpty())
                <div class="rounded-xl border border-default p-6 text-sm text-zinc-700">
                    No hay usuarios registrados todavía.
                </div>
            @else
                <div class="overflow-hidden rounded-xl border border-default">
                    <table class="min-w-full divide-y divide-zinc-200 text-left text-sm">
                        <thead class="bg-zinc-50 text-zinc-600">
                            <tr>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Correo</th>
                                <th class="px-4 py-3">Medicamentos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 bg-white">
                            @foreach ($users as $user)
                                <tr class="hover:bg-zinc-50">
                                    <td class="px-4 py-4 font-medium text-zinc-900">{{ $user->name }}</td>
                                    <td class="px-4 py-4 text-zinc-600">{{ $user->email }}</td>
                                    <td class="px-4 py-4 text-zinc-600">{{ $user->medicamentos_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</x-layouts.app>

