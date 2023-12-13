@props(['edit' => true, 'index'])

@php
    $colourClasses = 'bg-gradient-to-r from-pink-500 to-purple-500';

    if (isset($index)) {
        switch ($index % 5) {
            case 0:
            case 'blue':
                $colourClasses = 'bg-gradient-to-r from-cyan-400 to-indigo-500';
                break;
                case 1:
            case 'green':
                $colourClasses = 'bg-gradient-to-r from-lime-400 to-teal-500';
                break;
                case 2:
            case 'pink':
                $colourClasses = 'bg-gradient-to-r from-fuchsia-400 to-rose-500';
                break;
                case 3:
            case 'purple':
                $colourClasses = 'bg-gradient-to-r from-indigo-400 to-purple-500';
                break;
                case 4:
            case 'yellow':
                $colourClasses = 'bg-gradient-to-r from-orange-400 to-yellow-400';
                break;
        }
    }
@endphp

@if ($edit)
    <a {{ $attributes->merge(['class' => 'text-3xl font-bold inline-block text-transparent bg-clip-text ' . $colourClasses])}}>
        {{ $slot }}
    </a>
@else
    <span {{ $attributes->merge(['class' => 'text-3xl font-bold inline-block text-transparent bg-clip-text ' . $colourClasses])}}>
        {{ $slot }}
    </span>
@endif
