@props(['rating'])
<div x-data="{ value: @entangle($rating), hover: null }"
     @mouseover.away="hover = null">
    <div class="flex">
        <button @click.prevent="$wire['{{ $rating }}'] = 1"
                @mouseover="hover = 1">
            <x-icons.donut class="transition-all hover:grayscale-0"
                           x-bind:class="{ 'grayscale opacity-50' : value < 1, '!grayscale-0 !opacity-100' : hover >= 1 }"/>
        </button>
        <button @click.prevent="$wire['{{ $rating }}'] = 2"
                @mouseover="hover = 2">
            <x-icons.donut class="transition-all hover:grayscale-0"
                           x-bind:class="{ 'grayscale opacity-50' : value < 2, '!grayscale-0 !opacity-100' : hover >= 2 }"/>
        </button>
        <button @click.prevent="$wire['{{ $rating }}'] = 3"
                @mouseover="hover = 3">
            <x-icons.donut class="transition-all hover:grayscale-0"
                           x-bind:class="{ 'grayscale opacity-50' : value < 3, '!grayscale-0 !opacity-100' : hover >= 3 }"/>
        </button>
        <button @click.prevent="$wire['{{ $rating }}'] = 4"
                @mouseover="hover = 4">
            <x-icons.donut class="transition-all hover:grayscale-0"
                           x-bind:class="{ 'grayscale opacity-50' : value < 4, '!grayscale-0 !opacity-100' : hover >= 4 }"/>
        </button>
        <button @click.prevent="$wire['{{ $rating }}'] = 5"
                @mouseover="hover = 5">
            <x-icons.donut class="transition-all hover:grayscale-0"
                           x-bind:class="{ 'grayscale opacity-50' : value < 5, '!grayscale-0 !opacity-100' : hover >= 5 }"/>
        </button>
    </div>

</div>
