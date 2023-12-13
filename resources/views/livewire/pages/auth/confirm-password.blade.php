<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    #[Rule(['required', 'string'])]
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate();

        if (!auth()->guard('web')->validate([
            'email' => auth()->user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form wire:submit="confirmPassword">
        <!-- Password -->
        <div>
            <x-form.input-label for="password" :value="__('Password')"/>

            <x-form.text-input wire:model="password"
                               id="password"
                               class="block mt-1 w-full"
                               type="password"
                               name="password"
                               required autocomplete="current-password"/>

            <x-form.input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="mt-8 mb-2">
            <x-buttons.primary class="w-full !rounded-full py-3 text-lg">
                {{ __('Confirm') }}
            </x-buttons.primary>
        </div>
    </form>
</div>
