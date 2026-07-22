<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $redirectRoute = $user->is_admin ? route('admin.dashboard', absolute: false) : route('dashboard', absolute: false);

        $this->redirect($redirectRoute, navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header title="Crea una cuenta" description="Registra tus datos para gestionar tus recordatorios" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <div class="grid gap-2">
            <flux:input wire:model="name" id="name" label="Nombre" type="text" name="name" required autofocus autocomplete="name" placeholder="Nombre completo" />
        </div>

        <div class="grid gap-2">
            <flux:input wire:model="email" id="email" label="Correo electrónico" type="email" name="email" required autocomplete="email" placeholder="correo@ejemplo.com" />
        </div>

        <div class="grid gap-2">
            <flux:input
                wire:model="password"
                id="password"
                label="Contraseña"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Contraseña"
            />
        </div>

        <div class="grid gap-2">
            <flux:input
                wire:model="password_confirmation"
                id="password_confirmation"
                label="Confirmar contraseña"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirmar contraseña"
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">Crear cuenta</flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        ¿Ya tienes una cuenta?
        <x-text-link href="{{ route('login') }}">Inicia sesión</x-text-link>
    </div>
</div>
