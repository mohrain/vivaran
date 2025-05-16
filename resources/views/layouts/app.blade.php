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

    {{-- <x-application-logo :office="$office" class="h-10 w-auto" /> --}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased ">
    <div class="fixed min-h-screen  ">
        @include('layouts.sidebar')
    </div>
    <!-- Page Heading -->
    {{-- @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
    </div>
    </header>
    @endisset --}}

    <div class="ml-[255px]  bg-gray-100  ">
        <div class="fixed ml-[1px] bg-gray-100 w-[1025px] ">
            @include('layouts.navigation')
        </div>


        <div class=" bg-gray-100 min-h-screen pt-[100px] ">
            <main>
                {{ $slot }}
            </main>
        </div>

    </div>
    @livewireScripts
</body>

@stack('scripts')
{{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

</html>