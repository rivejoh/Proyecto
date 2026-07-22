<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    @if (class_exists('\Livewire\Livewire'))
        @livewireStyles
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body>
    {{ $slot ?? '' }}

    @if (class_exists('\Livewire\Livewire'))
        @livewireScripts
    @endif

    @fluxScripts
</body>
</html>
