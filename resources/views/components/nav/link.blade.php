@props(['active', 'highlight'])

@php
    $classes = 'group uppercase text-xs inline-flex items-center px-1 font-semibold leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
    if (!isset($highlight)) {
        $highlight = 'bg-pink-500';
    }

    $highlight = ($active ?? false) ?
        $highlight . ' w-2 h-2 rounded-full mr-2' :
        $highlight . ' w-2 h-2 rounded-full mr-2 opacity-0 transition-opacity group-focus:opacity-100 group-hover:opacity-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="{{ $highlight }}"></span>
    {{ $slot }}
</a>
