@props([
    'metaTitle' => null
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/favicon.png">

        <title>{{ ($metaTitle ? $metaTitle . ' | ' : '') . config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">

        <script src="{{ asset('assets/dropzone-5.9.3/dropzone.min.js?ver=5.9.3') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/dropzone-5.9.3/dropzone.min.css?ver=5.9.3') }}" type="text/css"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <x-head.tinymce-config/>
    </head>
    <body class="font-sans antialiased" style="background-color: #4158D0; background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
        @if (session('error'))
            <div class="dismissable-notification w-full bg-red-700 px-2 py-3 text-white text-center relative">
                {{ session('error') }}
                <div class="border-bottom-animation"></div>
            </div>
        @endif
        @if (session('success'))
            <div class="dismissable-notification w-full bg-green-700 px-2 py-3 text-white text-center relative">
                {{ session('success') }}
                <div class="border-bottom-animation"></div>
            </div>
        @endif

        <div class="min-h-screen">
            <div class="max-w-7xl mx-auto py-4">
                <ul class="flex gap-4 justify-between items-center text-white">
                    <li>
                            <a class="hover:underline" href="{{ route('dashboard') }}">
                            <x-icons.app width="200px"/>
                        </a>
                    </li>
                    <li class="flex-grow"></li>
                    <li>
                        <a class="hover:text-gray-700 transition ease-in-out duration-150" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-700 transition ease-in-out duration-150" href="{{ route('projects.create') }}">{{ __('projects.create') }}</a>
                    </li>
                    <li>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @can('access-admin')
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        {{ __('auth.admin') }}
                                    </x-dropdown-link>
                                @endcan

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('profile.title') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('auth.logout') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </li>
                </ul>


                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>

                <p class="text-white text-sm text-center">{{ config('app.name') . ' ' . getAppVersion() }}</p>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
