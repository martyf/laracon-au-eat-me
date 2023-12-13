<?php

use App\Models\Donut;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'donuts' => Donut::with('user')
                ->orderBy('name')
                ->paginate(6)
                ->onEachSide(1)
        ];
    }
}; ?>

<x-slot name="title">Donuts</x-slot>

<x-slot name="header">
    <h2>{{ __('Browse Donuts') }}</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-xl">
            <div>
                @if($donuts->count() === 0)
                    <x-empty>
                        <h3 class="mt-2 text-lg font-semibold text-gray-900">You're all out of donuts</h3>
                        <p class="mt-1 text-gray-500">Get started by adding a new donut.</p>

                        <x-slot name="actions">
                            <x-buttons.link :href="route('my-donuts.add')" wire:navigate>Add Donut</x-buttons.link>
                        </x-slot>
                    </x-empty>
                @else

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:gap-12">
                        @foreach($donuts as $index => $donut)
                            <x-donuts.card wire:key="{{ $donut->id }}" :donut="$donut" :index="$index" :edit="false"/>
                        @endforeach
                    </div>
                    <div class="mt-8 flex justify-center">
                        {{ $donuts->links()  }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
