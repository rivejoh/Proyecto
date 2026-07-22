@php

$groups = [
    'MedyTime' => [],
];

if (auth()->check() && auth()->user()->is_admin) {
    $groups['MedyTime'][] = [
        'name' => 'Admin',
        'icon' => 'folder-git-2',
        'url' => route('admin.dashboard'),
        'current' => request()->routeIs('admin.dashboard'),
    ];
}
if (auth()->check() && !auth()->user()->is_admin) {
    $groups['MedyTime'][] = [
        'name' => 'Inicio',
        'icon' => 'home',
        'url' => route('dashboard'),
        'current' => request()->routeIs('dashboard'),
    ];
}
$groups['MedyTime'] = array_merge($groups['MedyTime'], [
    [
        'name' => 'Medicamentos',
        'icon' => 'pill',
        'url' => auth()->check() && auth()->user()->is_admin
            ? route('admin.medicamentos.index')
            : route('user.medicamentos.index'),
        'current' => request()->routeIs('user.medicamentos.*') || request()->routeIs('admin.medicamentos.*'),
    ],
        [
        'name' => 'Agenda',
        'icon' => 'calendar',
        'url' => route('agenda.index'),
        'current' => request()->routeIs('agenda.index') || request()->routeIs('agenda.index.*'),
    ],
    [
        'name' => 'Horario',
        'icon' => 'clock',
        'url' => route('horario'),
        'current' => request()->routeIs('horario'),
    ],

    [
        'name' => 'Historial',
        'icon' => 'archive',
        'url' => route('historial'),
        'current' => request()->routeIs('historial'),
    ],
    [
        'name' => 'Nosotros',
        'icon' => 'users',
        'url' => route('nosotros'),
        'current' => request()->routeIs('nosotros'),
    ],
]);
@endphp

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 h-screen sticky top-0">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo class="size-8" href="#"></x-app-logo>
            </a>

            <flux:sidebar.nav>
                @foreach ($groups as $group => $links )
             
            <flux:sidebar.group :heading="$group" class="grid">
              @foreach ($links as $link)

                    @if($link['name'] === 'Horario')

                        <div x-data="{ open: localStorage.getItem('horarioMenu') === 'true' }">

                            <button
                               x-on:click="open = !open; localStorage.setItem('horarioMenu', open);"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">

                                <div class="flex items-center gap-2">
                                    <span>⏰</span>
                                    <span>Horario</span>
                                </div>

                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>


                                </span>

                            </button>

                            <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">

                                <flux:sidebar.item
                                    icon="sun"
                                    :href="route('manana', ['turno' => 'manana'])"
                                    wire:navigate>

                                    Mañana

                                </flux:sidebar.item>

                                <flux:sidebar.item
                                    icon="sun"
                                    :href="route('tarde', ['turno' => 'tarde'])"
                                    wire:navigate>

                                    Tarde

                                </flux:sidebar.item>

                                <flux:sidebar.item
                                    icon="moon"
                                    :href="route('noche', ['turno' => 'noche'])"
                                    wire:navigate>

                                    Noche

                                </flux:sidebar.item>

                            </div>

                        </div>

                    @else
                        <flux:sidebar.item
                            :icon="$link['icon']"
                            :href="$link['url']"
                            :current="$link['current']"
                            wire:navigate>

                            {{ $link['name'] }}

                        </flux:sidebar.item>

                    @endif

                @endforeach    
            </flux:sidebar.group>
        
            @endforeach     
            </flux:sidebar.nav>

            <flux:spacer />  <!--espacio es la barra de navegacion -->

        <flux:sidebar.nav>
            <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        

        <x-desktop-user-menu class="hidden lg:block" :name="optional(auth()->user())->name" />
    </flux:sidebar>


       <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="optional(auth()->user())->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ optional(auth()->user())->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ optional(auth()->user())->name }}</span>
                                    <span class="truncate text-xs">{{ optional(auth()->user())->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts


    </body>
</html>