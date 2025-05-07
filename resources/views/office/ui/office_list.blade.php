<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Office_show') }}
        </h2>
    </x-slot>
    <a
        href="office.index"class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">+
        नयाँ थप्नुहोस्</a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div id="flash-message"
                            class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                        {{-- Flash Error Message --}}
                        @if (session('error'))
                            <div id="flash-error"
                                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <script>
                            setTimeout(function() {
                                var successMessage = document.getElementById('flash-message');
                                var errorMessage = document.getElementById('flash-error');

                                if (successMessage) {
                                    successMessage.style.display = 'none';
                                }
                                if (errorMessage) {
                                    errorMessage.style.display = 'none';
                                }
                            }, 4000);
                        </script>
                    @endif
                    <div class="overflow-x-auto rounded-lg ">
                        <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                            <thead class="bg-gray-100 text-gray-700 font-semibold">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">क्र.स </th>
                                    <th class="px-4 py-3 whitespace-nowrap">लोगो </th>
                                    <th class="px-4 py-3 whitespace-nowrap">नाम </th>
                                    <th class="px-4 py-3 whitespace-nowrap">इमेल </th>
                                    <th class="px-4 py-3 whitespace-nowrap">फोन </th>
                                    <th class="px-4 py-3 whitespace-nowrap">कार्यालय प्रकार </th>
                                    <th class="px-4 py-3 whitespace-nowrap">ठेगाना </th>
                                    <th class="px-4 py-3 whitespace-nowrap">कार्यालय कोड </th>
                                    <th class="px-4 py-3 whitespace-nowrap">कार्यहरू </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($offices as $office)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $loop->iteration }}
                                        <td class="px-4 py-2">
                                            @if ($office->office_logo)
                                                <img src="{{ asset('storage/' . $office->office_logo) }}" alt="Logo"
                                                    class="w-10 h-10 rounded object-cover">
                                            @else
                                                <span class="text-gray-400 italic">No Logo</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $office->office_name }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $office->office_name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $office->office_email }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $office->office_email }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 min-w-[150px]">{{ $office->office_phone }}</td>
                                        <td class="px-4 py-2 max-w-[200px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $office->category->office_type ?? 'N/A' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 w-max max-w-xs">
                                                {{ $office->category->office_type ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-2 max-w-[200px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $office->office_address }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 w-max max-w-xs">
                                                {{ $office->office_address }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 min-w-[150px]">{{ $office->office_code }}</td>


                                        <!-- Actions column -->
                                        <td class="px-4 py-2  min-w-[200px]">
                                            <a href="" class="text-blue-500 hover:text-blue-700">View</a> |
                                            <a href="{{ route('office.edit', $office->id) }}"
                                                class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                            <form action="{{ route('office.destroy', $office->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this office?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
