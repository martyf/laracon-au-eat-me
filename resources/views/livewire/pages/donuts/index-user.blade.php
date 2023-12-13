<?php

use App\Models\Donut;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public function deleteDonut(Donut $donut)
    {
        if ($donut->user->id === Auth::user()->id) {
            $donut->delete();
        }

        $this->dispatch('close-modal-'.$donut->id);
    }

    public function with(): array
    {
        return [
            'donuts' => Auth::guard('web')
                ->user()
                ->donuts()
                ->with('user')
                ->orderBy('name')
                ->paginate(3)
                ->onEachSide(1)
        ];
    }
}; ?>

<x-slot name="title">My Donuts</x-slot>

<x-slot name="header">
    <h2>{{ __('My Donuts') }}</h2>
</x-slot>

<x-slot name="actions">
    <div>
        <x-buttons.link :href="route('my-donuts.add')" wire:navigate>Add Donut</x-buttons.link>
    </div>
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
                            <x-donuts.card wire:key="{{ $donut->id }}" :donut="$donut" :index="$index" :edit="true"/>
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
