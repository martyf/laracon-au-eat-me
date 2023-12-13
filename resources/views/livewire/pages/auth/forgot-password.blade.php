<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate();

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div>
            <x-form.input-label for="email" :value="__('Email')"/>
            <x-form.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                               required
                               autofocus/>
            <x-form.input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="mt-8">
            <x-buttons.primary class="w-full !rounded-full py-3 text-lg">
                {{ __('Email Password Reset Link') }}
            </x-buttons.primary>
        </div>

        <div class="mt-2 text-center">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
               href="{{ route('login') }}" wire:navigate>
                {{ __('Wait... I remembered my password...') }}
            </a>
        </div>
    </form>
</div>
