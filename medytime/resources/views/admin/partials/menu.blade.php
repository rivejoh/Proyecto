<div class="sticky top-6 self-start rounded-xl border border-default bg-white p-6 shadow-sm mb-6 w-full">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold">Menú admin</h2>
            <p class="text-base text-zinc-600">Accesos rápidos exclusivos del panel de administrador.</p>
        </div>
    </div>

     <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-stretch sm:gap-4">

        <a href="{{ route('admin.medicamentos.index') }}" class="group flex-1 rounded-2xl border border-zinc-200 !bg-zinc-50 p-4 transition hover:border-zinc-300 hover:!bg-zinc-100 active:!bg-zinc-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-300 {{ request()->routeIs('admin.medicamentos.*') ? 'border-sky-500 !bg-sky-50' : '' }}" style="background-color: #f8fafc;">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-sky-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m2.25-10.5 5.25 5.25M3.75 8.25l5.25-5.25M6 21h12a2 2 0 002-2V9a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold">Medicamentos</p>
                    <p class="text-xs text-zinc-500">Ver, agregar, editar y eliminar</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.horario') }}" class="group flex-1 rounded-2xl border border-zinc-200 !bg-zinc-50 p-4 transition hover:border-zinc-300 hover:!bg-zinc-100 active:!bg-zinc-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-300 {{ request()->routeIs('admin.horario') ? 'border-sky-500 !bg-sky-50' : '' }}" style="background-color: #f8fafc;">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-sky-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold">Horario</p>
                    <p class="text-xs text-zinc-500">Ver todos los horarios de usuarios</p>
                </div>
            </div>
        </a>

    </div>
</div>
