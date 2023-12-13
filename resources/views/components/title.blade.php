@props(['colour'])

@php
    $colourClasses = 'bg-gradient-to-r from-pink-500 to-purple-500';

    if (isset($colour)) {
        switch ($colour) {
            case 'blue':
                $colourClasses = 'bg-gradient-to-r from-cyan-400 to-indigo-500';
                break;
            case 'green':
                $colourClasses = 'bg-gradient-to-r from-lime-400 to-teal-500';
                break;
            case 'pink':
                $colourClasses = 'bg-gradient-to-r from-fuchsia-400 to-rose-500';
                break;
            case 'purple':
                $colourClasses = 'bg-gradient-to-r from-indigo-400 to-purple-500';
                break;
            case 'yellow':
                $colourClasses = 'bg-gradient-to-r from-orange-400 to-yellow-400';
                break;
        }
        }
@endphp

<h3 {{ $attributes->merge(['class' => 'text-3xl font-bold inline-block text-transparent bg-clip-text ' . $colourClasses]) }}>
    {{ $slot }}
</h3>
