<?php

use App\Models\Donut;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public Donut $donut;

}; ?>

<x-slot name="title">{{ $donut->name }}</x-slot>

<x-slot name="header">
    <h2>{{ __('Give me donut') }}</h2>
</x-slot>

<x-slot name="back">
    <x-nav.back :href="route('donuts')" wire:navigate>Browse Donuts</x-nav.back>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-12">
                <div>
                    <x-title class="!text-4xl" colour="yellow">{{ $donut->name }}</x-title>

                    <div class="mt-4 space-y-4">

                        <div class="lg:hidden aspect-video overflow-hidden rounded-2xl shadow-lg">
                            <img src="{{ $donut->photo_url }}" class="object-cover w-full h-full">
                        </div>

                        <div>
                            <div class="mt-1 text-sm font-bold text-gray-500">
                                {{ $donut->location }}, {{ $donut->state }}
                            </div>
                            <div class="text-xs text-gray-500">{{ $donut->user->name }}</div>
                        </div>

                        <div class="grid grid-cols-3">
                            <div title="{{ __('Size') }}: {{$donut->rating_size}} / 5">
                                <div class="text-xxs text-gray-400 font-bold uppercase">
                                    {{ __('Size') }}
                                </div>
                                <div class="flex">
                                    @for($i = 0; $i < $donut->rating_size; $i++)
                                        <x-icons.donut class="!w-4 !h-4"/>
                                    @endfor
                                </div>
                            </div>

                            <div title="{{ __('Appearance') }}: {{$donut->rating_appearance}} / 5">
                                <div class="text-xxs text-gray-400 font-bold uppercase">
                                    {{ __('Appearance') }}
                                </div>
                                <div class="flex">
                                    @for($i = 0; $i < $donut->rating_appearance; $i++)
                                        <x-icons.donut class="!w-4 !h-4"/>
                                    @endfor
                                </div>
                            </div>

                            <div title="{{ __('Value') }}: {{$donut->rating_value}} / 5">
                                <div class="text-xxs text-gray-400 font-bold uppercase">
                                    {{ __('Value') }}
                                </div>
                                <div class="flex">
                                    @for($i = 0; $i < $donut->rating_value; $i++)
                                        <x-icons.donut class="!w-4 !h-4"/>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="flex-grow text-ellipsis">
                            {{ \Illuminate\Support\Str::words($donut->details, 15) }}
                        </div>

                    </div>
                </div>
                <div class="hidden lg:block col-span-2 space-y-6">
                    <div class="aspect-video overflow-hidden rounded-2xl shadow-lg">
                        <img src="{{ $donut->photo_url }}" class="object-cover w-full h-full">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
