<x-layouts.app>

    <flux:breadcrumbs class="mb-6">
                <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
                    Dashboard
                </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{ route('admin.medicamentos.index') }}">
         Medicamentos
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
          Listado de medicamentos
        </flux:breadcrumbs.item>

    </flux:breadcrumbs>

    <div class="flex justify-end">
        <a href="{{ route('admin.medicamentos.create') }}">
            <flux:button variant="primary" color="emerald" class="cursor-pointer inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Agregar medicamento
            </flux:button>
        </a>
    </div>
    <br>

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
                    <th scope="col" class="px-6 py-3 font-medium">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicamento)
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
                        <td>
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.medicamentos.edit', $medicamento) }}" class="btn btn-blue inline-flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l3 3L21 5.5 18.5 3 9 11z" />
                                        </svg>
                                        Editar
                                    </a>

                                    <form class="delete-form" action="{{ route('admin.medicamentos.destroy', $medicamento) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-red inline-flex items-center gap-2" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>