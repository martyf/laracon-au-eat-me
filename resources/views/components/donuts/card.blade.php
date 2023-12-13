<div wire:key="{{ $donut->id }}"
     class="border border-gray-200 shadow rounded-xl overflow-hidden flex flex-col">
    <div class="aspect-square overflow-hidden">
        <img src="{{ $donut->photo_url }}" class="object-cover w-full h-full">
    </div>

    <div class="flex-grow p-4 space-y-2 flex flex-col">
        <div>
            <x-nav.gradient index="{{ $index }}"
                            href="{{ $edit ? route('my-donuts.edit', ['donut' => $donut]) : route('donuts.show', ['donut' => $donut]) }}">
                {{ $donut->name }}
            </x-nav.gradient>

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

        @if ($edit)
            <div class="flex justify-between">
                <x-buttons.link
                    href="{{ route('my-donuts.edit', ['donut' => $donut]) }}"
                    class="!px-3 !rounded-xl"
                    title="{{ __('Edit') }}"
                    wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                    </svg>

                </x-buttons.link>

                <x-buttons.danger
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion-{{ $donut->id }}')"
                    class="!px-3"
                    title="{{ __('Delete') }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                </x-buttons.danger>
            </div>
        @endif
    </div>

    @if ($edit)
        <x-modal name="confirm-deletion-{{ $donut->id }}" maxWidth="lg" focusable>
            <form wire:submit="deleteDonut({{ $donut->id }})" class="p-6">

                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    {{ __('Are you sure you want to delete your donut?') }}
                </h2>

                <div class="space-y-1 text-gray-600">
                    <p>{!! __('If you choose to delete <strong>:name</strong>, it will be removed from all listings.', ['name' => $donut->name]) !!}</p>
                    <p>{{ __('Are you sure you want to do this?') }}</p>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-buttons.secondary x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-buttons.secondary>

                    <x-buttons.danger class="ml-3">
                        {{ __('Delete Donut') }}
                    </x-buttons.danger>
                </div>
            </form>
        </x-modal>
    @endif
</div>
