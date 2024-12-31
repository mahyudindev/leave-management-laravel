<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Elibbrary') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center"
         style="background-image: url({{ asset('images/bg.jpeg') }});">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-80"></div>

        <!-- Content -->
        <div class="relative z-10">
            <<img src="{{ asset('images/logo.png') }}" class="h-20 w-auto" {{ $attributes }} />
        </div>

        <div
            class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 dark:bg-gray-700 shadow-md overflow-hidden sm:rounded-lg"
            style="background-color: rgba(90, 90, 90, 0.8);">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
