<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <x-head.tinymce-config/>
    </head>
    <body class="font-sans antialiased" style="background-color: #4158D0; background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
        <div class="min-h-screen">
            <div class="max-w-7xl mx-auto py-4">
                <ul class="flex gap-4 justify-end">
                    <li><a class="hover:underline" href="{{ route('dashboard') }}">Projekte</a></li>
                    <li><a class="hover:underline" href="{{ route('profile.edit') }}">Profil</a></li>
                </ul>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
