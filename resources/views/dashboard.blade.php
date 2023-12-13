<x-app-layout>

    <div class="pt-32 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-xl">
                <div class="space-y-6">
                    @if (!$featured)
                        <div class="grid grid-cols-3">
                            <div>
                                <x-title>Uh oh, we're sold out</x-title>
                            </div>
                            <div class="col-span-2 space-y-6">
                                <x-empty alignment="left">
                                    <h3 class="mt-2 text-lg font-semibold text-gray-900">There are no donuts</h3>
                                    <p class="mt-1 text-gray-500">Get started by adding a new donut.</p>

                                    <x-slot name="actions">
                                        <x-buttons.link :href="route('my-donuts.add')" wire:navigate>Add Donut
                                        </x-buttons.link>
                                    </x-slot>
                                </x-empty>
                            </div>
                        </div>
                    @else

                        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-12">
                            <div>
                                <x-title class="!text-4xl" colour="yellow">Featured donut</x-title>

                                <div class="mt-4 space-y-4">

                                    <div class="lg:hidden aspect-video overflow-hidden rounded-2xl shadow-lg">
                                        <img src="{{ $featured->photo_url }}" class="object-cover w-full h-full">
                                    </div>

                                    <div>
                                        <a class="font-bold text-3xl"
                                           href="{{ route('donuts.show', ['donut' => $featured]) }}"
                                           wire:navigate>
                                            {{ $featured->name }}
                                        </a>

                                        <div class="mt-1 text-sm font-bold text-gray-500">
                                            {{ $featured->location }}, {{ $featured->state }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $featured->user->name }}</div>
                                    </div>

                                    <div class="grid grid-cols-3">
                                        <div title="{{ __('Size') }}: {{$featured->rating_size}} / 5">
                                            <div class="text-xxs text-gray-400 font-bold uppercase">
                                                {{ __('Size') }}
                                            </div>
                                            <div class="flex">
                                                @for($i = 0; $i < $featured->rating_size; $i++)
                                                    <x-icons.donut class="!w-4 !h-4"/>
                                                @endfor
                                            </div>
                                        </div>

                                        <div title="{{ __('Appearance') }}: {{$featured->rating_appearance}} / 5">
                                            <div class="text-xxs text-gray-400 font-bold uppercase">
                                                {{ __('Appearance') }}
                                            </div>
                                            <div class="flex">
                                                @for($i = 0; $i < $featured->rating_appearance; $i++)
                                                    <x-icons.donut class="!w-4 !h-4"/>
                                                @endfor
                                            </div>
                                        </div>

                                        <div title="{{ __('Value') }}: {{$featured->rating_value}} / 5">
                                            <div class="text-xxs text-gray-400 font-bold uppercase">
                                                {{ __('Value') }}
                                            </div>
                                            <div class="flex">
                                                @for($i = 0; $i < $featured->rating_value; $i++)
                                                    <x-icons.donut class="!w-4 !h-4"/>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-grow text-ellipsis">
                                        {{ \Illuminate\Support\Str::words($featured->details, 15) }}
                                    </div>

                                    <div>
                                        <x-buttons.link href="{{ route('donuts.show', ['donut' => $featured])  }}">
                                            Tell me more...
                                        </x-buttons.link>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden lg:block col-span-2 space-y-6">
                                <div class="aspect-video overflow-hidden rounded-2xl shadow-lg">
                                    <img src="{{ $featured->photo_url }}" class="object-cover w-full h-full">
                                </div>
                            </div>
                        </div>

                        <x-divider></x-divider>

                        <div>
                            <x-title colour="blue">You may also like...</x-title>

                            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:gap-12">
                                @foreach($random as $index => $donut)
                                    <x-donuts.card :donut="$donut"
                                                   :index="$index"
                                                   :edit="false"/>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
