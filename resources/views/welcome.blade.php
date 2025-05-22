<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- <form method="POST" action="{{ route('login') }}"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-md mx-auto">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                {{ __('Email') }}
            </label>
            <input id="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="email" name="email" :value="old('email')" required autofocus />
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                {{ __('Password') }}
            </label>
            <input id="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                {{ __('Log in') }}
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        </div>
    </form> --}}
</head>

<body class="bg-gray-100">
        {{-- <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-4xl font-bold mb-4 mt">Welcome to Vivaran</h1> --}}
        <!-- Login Form -->
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="text-blue-600 underline">Dashboard</a>
            @else
                @include('auth.login')
            @endauth
        @endif
    </div>
</body>

</html>
