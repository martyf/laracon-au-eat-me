<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\View\View;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-form.input-label for="name" :value="__('Name')"/>
            <x-form.text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                               autofocus autocomplete="name"/>
            <x-form.input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-form.input-label for="email" :value="__('Email')"/>
            <x-form.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                               required
                               autocomplete="username"/>
            <x-form.input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-form.input-label for="password" :value="__('Password')"/>

            <x-form.text-input wire:model="password" id="password" class="block mt-1 w-full"
                               type="password"
                               name="password"
                               required autocomplete="new-password"/>

            <x-form.input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')"/>

            <x-form.text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                               type="password"
                               name="password_confirmation" required autocomplete="new-password"/>

            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="mt-8">
            <x-buttons.primary class="w-full !rounded-full py-3 text-lg">
                {{ __('Register') }}
            </x-buttons.primary>
        </div>

        <div class="mt-2 text-center">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
               href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</div>
