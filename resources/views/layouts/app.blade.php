<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($title) ? $title . ' - ' : '') . config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen flex flex-col bg-gradient-to-r from-sky-100 to-purple-100">
    <livewire:layout.navigation/>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="pt-32 text-sky-900 font-semibold">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
                <div class="text-3xl ">
                    {{ $header }}
                </div>

                @if (isset($actions))
                    <div class="mt-4 flex items-center space-x-4">
                        {{ $actions }}
                    </div>
                @endif

                @if (isset($back))
                    <div class="absolute -top-7 text-xs font-normal">
                        {{ $back }}
                    </div>
                @endif
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="flex-grow">
        @if (isset($template_content))
            {!! $template_content !!}
        @else
            {{ $slot }}
        @endif
    </main>

    <x-layout.footer></x-layout.footer>
</div>
</body>
</html>
