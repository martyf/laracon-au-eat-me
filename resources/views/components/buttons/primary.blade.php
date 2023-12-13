@php
    $attributes = $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2 shadow-md bg-white text-white rounded-full font-semibold
    transition ease-in-out duration-150
    group relative overflow-hidden
    focus:bg-pink-500
    active:bg-pink-500
    focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2']);
@endphp
<button {{ $attributes }}>
    <div class="relative z-20">{{ $slot }}</div>
    <div class="z-10 w-[175%] absolute inset-y-0
                bg-gradient-to-r from-sky-400 via-indigo-400 to-pink-400
                left-0 transition-all ease-in-out duration-300
                group-hover:-left-3/4"></div>
</button>
