<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>विवरण</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="fixed min-h-screen">
        @include('layouts.sidebar')
    </div>

    <div class="ml-[255px] bg-gray-100">
        <div class="fixed ml-[0px] bg-gray-100 w-full z-50">
            @include('layouts.navigation')
        </div>

        <div class="bg-gray-100 min-h-screen pt-[64px]">

            <main>
                {{-- Alert section --}}
                @if (session('success'))
                    <div id="flash-message" class="mx-auto w-[95%] mt-4 px-4 py-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div id="flash-error" class="mx-auto w-[95%] mt-4 px-4 py-3 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div id="flash-warning" class="mx-auto w-[95%] mt-4 px-4 py-3 bg-yellow-100 text-yellow-800 rounded">
                        {{ session('warning') }}
                    </div>
                @endif
                <script>
                    setTimeout(function() {
                        var successMessage = document.getElementById('flash-message');
                        var errorMessage = document.getElementById('flash-error');
                        var warningMessage = document.getElementById('flash-warning');
                        if (successMessage) successMessage.style.display = 'none';
                        if (errorMessage) errorMessage.style.display = 'none';
                        if (warningMessage) warningMessage.style.display = 'none';
                    }, 4000);
                </script>
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>

@stack('scripts')

</html>
