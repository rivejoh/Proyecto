<x-layouts.app>

    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item>
                    Dashboard
         </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{ route('user.medicamentos.index') }}">
         Medicamentos
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
          Listado de medicamentos
        </flux:breadcrumbs.item>

    </flux:breadcrumbs>
    
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
         <label for="med-search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Buscar</label>
        <div class="relative">
                
                <input type="search" id="med-search" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Buscar medicamento" required />
                <button type="button" id="med-search-button" class="absolute end-1.5 bottom-1.5 text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Search</button>
            </div>
            <datalist id="medicamentos-list">
                @foreach ($medicines as $m)
                    <option value="{{ $m->name }}"></option>
                @endforeach
            </datalist>
        </div>
       
        

{{-- <form class="max-w-md mx-auto">   
    <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
        </div>
        <input type="search" id="search" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Search" required />
        <button type="button" class="absolute end-1.5 bottom-1.5 text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Search</button>
    </div>
</form> --}}


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
                        Acciones
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
                         
                         {{-- <th scope="col" class="px-6 py-3 font-medium">
                                {{$medicamento->options}}
                            <a href="{{ route('user.medicamentos.create', $medicamento) }}" class="btn btn-blue">
                                Agendar Medicamento
                            </a>
                           </th>  --}}
                        <th>
                            <a href="{{ route('user.medicamentos.agenda', $medicamento) }}" class="btn btn-blue">
                                Agendar
                            </a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="flex justify-start mt-4">
        <a href="{{ route('user.medicamentos.create') }}">
            <flux:button variant="primary" color="cyan" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="size-2" textalign="center" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        clip-rule="evenodd" />
                </svg>
                Agendar medicamento
            </flux:button>
        </a>
    </div>
</x-layouts.app>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('med-search');
    const button = document.getElementById('med-search-button');

    if (!input) return;

    const filterRows = function () {
        const query = input.value.trim().toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(function (row) {
            const text = (row.textContent || '').toLowerCase();
            row.style.display = (!query || text.includes(query)) ? '' : 'none';
        });
    };

    filterRows();
    input.addEventListener('input', filterRows);

    if (button) {
        button.addEventListener('click', filterRows);
    }
});
</script>