<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div
    class="min-h-screen flex flex-col  pt-6 sm:pt-0  bg-gradient-to-r from-sky-100 to-purple-100">

    <div class="flex-grow flex flex-col sm:justify-center items-center pt-8">
        <div>
            <a href="/" wire:navigate>
                <x-marks.application-mark class="w-20 h-20 fill-current text-gray-500"/>
            </a>
        </div>
        <div class="w-full sm:max-w-md mt-10 drop-shadow relative">
            <!-- Zig Zags -->
            <div class="zig-zag z-20 absolute -bottom-4 inset-x-0 h-4"></div>
            <div class=" zig-zag z-10 rotate-180 absolute -top-4 inset-x-0 h-4"></div>

            <div class="bg-white relative z-20 px-6 pt-10 pb-8 ">
                {{ $slot }}
            </div>
        </div>
    </div>

    <x-layout.footer></x-layout.footer>
</div>
</body>
</html>
