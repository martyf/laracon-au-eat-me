<?php

use Livewire\Volt\Component;

new class extends Component {
    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="fixed z-50 inset-x-0 top-0 bg-white">
    <!-- Zig Zag -->
    <div class="zig-zag absolute z-10 drop-shadow-md -bottom-4 inset-x-0 h-8"></div>

    <!-- Primary Navigation Menu -->
    <div class="bg-white relative z-20">
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" wire:navigate>
                            <x-marks.application-logo class="block h-8 w-auto fill-current text-gray-800"/>
                        </a>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">

                    <!-- Navigation Links -->
                    <div class="hidden h-16 space-x-4 sm:-my-px sm:mr-6 sm:flex">
                        @foreach(Statamic::tag('nav:main') as $navItem)
                            @if ((isset($navItem['requires_auth']) && $navItem['requires_auth'] && auth()->guard('web')->user()) || (isset($navItem['requires_auth']) && $navItem['requires_auth'] == '') || !isset($navItem['requires_auth']))
                                @if ($navItem['route_name'] != '')
                                    <x-nav.link :href="route('' . $navItem['route_name'])"
                                                highlight="{{ $navItem['colour'] }}"
                                                :active="request()->routeIs(''.$navItem['route_name'])" wire:navigate>
                                        {{ $navItem['title'] }}
                                    </x-nav.link>
                                @else
                                    <x-nav.link :href="$navItem['url']"
                                                highlight="{{ $navItem['colour'] }}"
                                                :active="$navItem['is_current']"
                                                wire:navigate>
                                        {{ $navItem['title'] }}
                                    </x-nav.link>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    @if (auth()->guard('web')->user())
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="block p-1 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-pink-500 focus:outline-none transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 12 12">
                                        <g fill="none" stroke="currentColor" stroke-miterlimit="10">
                                            <rect width="11" height="11" x=".5" y=".5" stroke-width=".9" rx="2.69"
                                                  ry="2.69"/>
                                            <circle cx="6" cy="4.47" r="2" stroke-width=".8"/>
                                            <path stroke-width=".8"
                                                  d="M10.28 11.06C9.8 9.07 8.07 7.59 6 7.59s-3.9 1.56-4.32 3.65"/>
                                        </g>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-left">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div class="space-x-2">
                            <x-buttons.link class="text-sm"
                                            colour="yellow"
                                            href="{{ route('register') }}">{{ __('Register') }}</x-buttons.link>
                            <x-buttons.link class="text-sm"
                                            href="{{ route('login') }}">{{ __('Log in') }}</x-buttons.link>
                        </div>
                    @endif
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @foreach(Statamic::tag('nav:main') as $navItem)
                    @if ($navItem['route_name'] != '')
                        <x-nav.responsive-link
                            :href="route('' . $navItem['route_name'])"
                            highlight="{{ $navItem['colour'] }}"
                            :active="request()->routeIs(''.$navItem['route_name'])" wire:navigate>
                            {{ $navItem['title'] }}
                        </x-nav.responsive-link>
                    @else
                        <x-nav.responsive-link
                            :href="$navItem['url']"
                            highlight="{{ $navItem['colour'] }}"
                            :active="$navItem['is_current']"
                            wire:navigate>
                            {{ $navItem['title'] }}
                        </x-nav.responsive-link>
                    @endif
                @endforeach
            </div>

            @if (auth()->guard('web')->user())
                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-4 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800"
                             x-data="{ name: '{{ auth()->guard('web')->user()->name }}' }"
                             x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-nav.responsive-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-nav.responsive-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-left">
                            <x-nav.responsive-link>
                                {{ __('Log Out') }}
                            </x-nav.responsive-link>
                        </button>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-4 border-t border-gray-200">
                    <div class="px-4 space-y-2">
                        <x-buttons.link class="w-full"
                                        href="{{ route('login') }}">{{ __('Log in') }}</x-buttons.link>
                        <x-buttons.link class="w-full"
                                        href="{{ route('register') }}">{{ __('Register') }}</x-buttons.link>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
