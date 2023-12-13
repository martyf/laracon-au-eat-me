@php

    $colourClasses = 'bg-gradient-to-r from-sky-400 via-indigo-400 to-pink-400';
        if (isset($colour)) {
            switch ($colour) {
                case 'blue':
                    $colourClasses = 'bg-gradient-to-r from-cyan-400 via-blue-400 to-violet-400';
                    break;
                case 'green':
                    $colourClasses = 'bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-400';
                    break;
                case 'pink':
                    $colourClasses = 'bg-gradient-to-r from-sky-400 via-indigo-400 to-pink-400';
                    break;
                case 'purple':
                    $colourClasses = 'bg-gradient-to-r from-indigo-400 via-fuchsia-400 to-red-400';
                    break;
                case 'yellow':
                    $colourClasses = 'bg-gradient-to-r from-orange-400 via-yellow-400 to-emerald-400';
                    break;
            }
        }

        $attributes = $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2 shadow-md bg-white text-white rounded-full font-semibold
            transition ease-in-out duration-150
            group relative overflow-hidden
            focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2']);
@endphp
<a {{ $attributes }}>
    <div class="relative z-20">{{ $slot }}</div>
    <div class="z-10 w-[200%] absolute inset-y-0
                {{ $colourClasses }}
                left-0 transition-all ease-in-out duration-300
                group-hover:-left-full"></div>
</a>
