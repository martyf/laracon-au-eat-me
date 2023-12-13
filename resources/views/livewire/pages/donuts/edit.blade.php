<?php

use App\Enums\AustralianState;
use App\Enums\Type;
use App\Models\Donut;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\LaravelOptions\Options;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

new #[Layout('layouts.app')] class extends Component {

    use WithFileUploads;

    public ?Donut $donut = null;

    public ?string $name;

    public ?string $location;

    public AustralianState $state;
    public ?Type $type;

    public ?string $details;

    public ?string $rating_size;
    public ?string $rating_appearance;
    public ?string $rating_value;

    public $photo;

    public function rules()
    {
        return [
            'photo' => [$this->donut ? 'nullable' : null, 'image', 'mimes:jpg,webp', 'max:6048'],
            'name' => ['required'],
            'location' => ['required'],
            'state' => ['required', new Enum(AustralianState::class)],
            'type' => ['required', new Enum(Type::class)],
            'details' => ['required'],
            'rating_size' => ['required', 'decimal:0,2', 'min:0', 'max:5'],
            'rating_appearance' => ['required', 'decimal:0,2', 'min:0', 'max:5'],
            'rating_value' => ['required', 'decimal:0,2', 'min:0', 'max:5']
        ];
    }

    public function save()
    {
        $this->validate();

        $payload = $this->only([
            'name',
            'location',
            'state',
            'type',
            'details',
            'rating_size',
            'rating_appearance',
            'rating_value'
        ]);

        if ($this->donut) {
            $this->donut->update($payload);
        } else {
            $this->donut = Auth::user()->donuts()->create($payload);
        }

        if ($this->photo) {
            $this->donut->updatePhoto($this->photo);
        }

        session()->flash('status', 'Post successfully updated.');

        $this->dispatch('saved');
    }
    
    public function mount()
    {
        if (!$this->donut) {
            $this->donut = new Donut();
        }

        $this->name = $this->donut->name;
        $this->details = $this->donut->details;
        $this->location = $this->donut->location;
        $this->state = is_string($this->donut->state) ? AustralianState::tryFrom($this->donut->state) : $this->donut->state;
        $this->type = is_string($this->donut->type) ? Type::tryFrom($this->donut->type) : $this->donut->type;
        $this->details = $this->donut->details;
        $this->rating_size = $this->donut->rating_size;
        $this->rating_appearance = $this->donut->rating_appearance;
        $this->rating_value = $this->donut->rating_value;
    }
}; ?>

<x-slot name="title">{{ $this->donut->id ? __('Edit Donut') : __('Create Donut') }}</x-slot>

<x-slot name="header">
    <h2>{{ $this->donut->id ? __('Edit Donut') : __('Create Donut') }}</h2>
</x-slot>

<x-slot name="back">
    <x-nav.back :href="route('my-donuts')" wire:navigate>Back to My Donuts</x-nav.back>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-xl">
            <div>
                <form wire:submit="save" class="space-y-6">

                    <div class="grid grid-cols-3">
                        <div>
                            <x-title>About your donut</x-title>
                        </div>
                        <div class="col-span-2 space-y-6">
                            <div>
                                <x-form.input-label for="name" :value="__('Name')"/>

                                <x-form.text-input wire:model="name"
                                                   id="name"
                                                   name="name"
                                                   type="text"
                                                   class="mt-1 block w-full"/>
                                <x-form.input-error class="mt-2" :messages="$errors->get('name')"/>

                            </div>

                            <div>
                                <x-form.input-label for="type" :value="__('Type')"/>
                                <x-form.select wire:model="type"
                                               id="type"
                                               name="type"
                                               type="text"
                                               class="mt-1 block">
                                    @if (!$this->donut->type)
                                        <option>Select a type...</option>
                                    @endif
                                    @foreach(Options::forEnum(Type::class) as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                    @endforeach
                                </x-form.select>
                                <x-form.input-error class="mt-2" :messages="$errors->get('type')"/>
                            </div>

                            <div>
                                <x-form.input-label for="details" :value="__('Details')"/>

                                <x-form.textarea wire:model="details"
                                                 id="details"
                                                 name="details"
                                                 rows="4"
                                                 class="mt-1 block w-full"/>
                                <x-form.input-error class="mt-2" :messages="$errors->get('details')"/>
                            </div>

                            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                                <!-- Photo File Input -->
                                <input type="file" id="photo" class="hidden"
                                       wire:model.live="photo"
                                       x-ref="photo"
                                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

                                <x-form.input-label for="photo" value="{{ __('Photo') }}"/>

                                <!-- Current Photo -->
                                <div class="mt-2" x-show="! photoPreview">
                                    <img src="{{ $this->donut->photo_url }}" alt="{{ $this->donut->name }}"
                                         class="rounded-full h-32 w-32 object-cover">
                                </div>

                                <!-- New Photo Preview -->
                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                    <span class="block rounded-full w-32 h-32 bg-cover bg-no-repeat bg-center"
                                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>

                                <div>
                                    <x-buttons.secondary class="mt-2 mr-2" type="button"
                                                         x-on:click.prevent="$refs.photo.click()">
                                        {{ __('Browse...') }}
                                    </x-buttons.secondary>
                                </div>

                                <x-form.input-error :messages="$errors->get('photo')" class="mt-2"/>
                            </div>


                        </div>
                    </div>

                    <x-divider/>

                    <div class="grid grid-cols-3">
                        <div>
                            <x-title colour="blue">Where can you find it?</x-title>
                        </div>
                        <div class="col-span-2 space-y-6">
                            <div>
                                <x-form.input-label for="name" :value="__('Location')"/>
                                <div class="md:grid md:grid-cols-6">
                                    <div class="md:col-span-4">
                                        <x-form.text-input wire:model="location"
                                                           id="location"
                                                           name="location"
                                                           type="text"
                                                           class="mt-1 block w-full"/>
                                        <x-form.input-error class="mt-2" :messages="$errors->get('location')"/>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-form.input-label for="state" :value="__('State')"/>
                                <x-form.select wire:model="state"
                                               id="state"
                                               name="state"
                                               type="text"
                                               class="mt-1 block">
                                    @if (!$this->donut)
                                        <option>Select a state...</option>
                                    @endif
                                    @foreach(Options::forEnum(AustralianState::class) as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                    @endforeach
                                </x-form.select>
                                <x-form.input-error class="mt-2" :messages="$errors->get('state')"/>
                            </div>
                        </div>
                    </div>

                    <x-divider/>

                    <div class="md:grid grid-cols-3">
                        <div class="mb-10 md:mb-0">
                            <x-title colour="yellow">How do you rate it?</x-title>
                        </div>
                        <div class="col-span-2 space-y-6">
                            <div>
                                <div class="flex items-center">
                                    <x-form.input-label class="w-28" for="rating_size" :value="__('Size')"/>
                                    <x-form.rating rating="rating_size"></x-form.rating>
                                </div>
                                <x-form.input-error class="mt-2" :messages="$errors->get('rating_size')"/>
                            </div>

                            <div>
                                <div class="flex items-center">
                                    <x-form.input-label class="w-28" for="rating_appearance" :value="__('Appearance')"/>
                                    <x-form.rating rating="rating_appearance"></x-form.rating>
                                </div>
                                <x-form.input-error class="mt-2" :messages="$errors->get('rating_appearance')"/>
                            </div>

                            <div>
                                <div class="flex items-center">
                                    <x-form.input-label class="w-28" for="rating_value" :value="__('Value')"/>
                                    <x-form.rating rating="rating_value"></x-form.rating>
                                </div>
                                <x-form.input-error class="mt-2" :messages="$errors->get('rating_value')"/>
                            </div>
                        </div>
                    </div>

                    <x-divider/>

                    <div class="md:grid grid-cols-3">
                        <div></div>
                        <div class="col-span-2 space-y-6">
                            <div class="flex items-center gap-4">
                                <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>

                                <x-action-message class="mr-3" on="saved">
                                    {{ __('Saved.') }}
                                </x-action-message>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
