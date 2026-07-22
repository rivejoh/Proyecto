<x-layouts.app>

    <flux:breadcrumbs class="mb-6">
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                    Dashboard
                </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{ route('horario') }}">
         Horario
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Horario de medicamentos - Tarde
        </flux:breadcrumbs.item>

    </flux:breadcrumbs>


<div class="text-2xl font-bold mb-4">
         Medicamentos de la Tarde
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