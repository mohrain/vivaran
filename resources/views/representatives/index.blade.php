<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('प्रतिनिधि सूची') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 px-4 sm:px-0">
            {{-- Add New Button --}}
            @isset($office)
                <a href="{{ route('representatives.create_representatives', ['office_id' => $office->id]) }}"
                   class="bg-green-700 hover:bg-green-800 text-white font-bold py-1 px-6 rounded-lg focus:outline-none focus:shadow-outline text-sm w-full sm:w-auto text-center mb-4 sm:mb-0">
                   + नयाँ थप्नुहोस्
                </a>
            @else
                <a href="{{ route('representatives.create_representatives') }}"
                   class="bg-green-700 hover:bg-green-800 text-white font-bold py-1 px-6 rounded-lg focus:outline-none focus:shadow-outline text-sm w-full sm:w-auto text-center mb-4 sm:mb-0">
                   + नयाँ थप्नुहोस्
                </a>
            @endisset

            {{-- Filter Form (Consolidated) --}}
            <form action="{{ route('representatives.index') }}" method="GET" class="w-full sm:w-1/2 flex items-center flex-wrap">
                {{-- Basic Search Input --}}
                <div class="relative flex-grow">
                    <input type="text" name="search" placeholder="खोजी गर्नुहोस्..."
                           value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                {{-- Toggle Advanced Filters Button --}}
                <button type="button" id="toggleAdvancedFiltersBtn"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg focus:outline-none focus:shadow-outline flex-shrink-0">
                    <svg class="h-5 w-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01.293.707l-6.414 6.414a1 1 0 00-.293.707V19l-4 2v-3.586a1 1 0 00-.293-.707L3.707 6.293A1 1 0 013 5.586V4z"></path>
                    </svg>
                    फिल्टर
                </button>

                {{-- Advanced Filter Section --}}
                {{-- Move this entire div INSIDE the form --}}
                <div id="advancedFilters" class="w-full mt-4 p-6 bg-white shadow-sm sm:rounded-lg"
                    style="display: {{ $showAdvancedFilters ? 'block' : 'none' }};">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">{{ __('थप फिल्टरहरू') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>
                            <label for="representative_name" class="block text-sm font-medium text-gray-700">नाम</label>
                            <input type="text" id="representative_name" name="representative_name"
                                value="{{ request('representative_name') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="representative_ward" class="block text-sm font-medium text-gray-700">वार्ड</label>
                            <input type="text" id="representative_ward" name="representative_ward"
                            value="{{ request('representative_ward') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="representative_email" class="block text-sm font-medium text-gray-700">इमेल</label>
                            {{-- Corrected typo: represenatative_email -> representative_email --}}
                            <input type="email" id="representative_email" name="representative_email"
                            value="{{ request('representative_email') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="representative_phone" class="block text-sm font-medium text-gray-700">फोन</label>
                            <input type="text" id="representative_phone" name="representative_phone" {{-- Changed type to text for phone numbers --}}
                             value="{{ request('representative_phone') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700">विभाग</label>
                            <select id="department_id" name="department_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">सबै</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}"
                                        {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="post_category_id" class="block text-sm font-medium text-gray-700">पद</label>
                            <select id="post_category_id" name="post_category_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">सबै</option>
                                @foreach ($postCategories as $post)
                                    <option value="{{ $post->id }}"
                                        {{ request('post_category_id') == $post->id ? 'selected' : '' }}>
                                        {{ $post->post_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Add other advanced filter fields as needed --}}
                        {{-- Make sure to include the 'english_name', 'political_party', 'election_system', 'district', 'gender', 'remark' fields if they are supposed to be used in your controller --}}
                        {{-- Example for English Name (from previous context): --}}
                        {{-- <div>
                            <label for="english_name" class="block text-sm font-medium text-gray-700">English Name</label>
                            <input type="text" id="english_name" name="english_name"
                                value="{{ request('english_name') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div> --}}

                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline mr-2">
                            फिल्टर लागू गर्नुहोस्
                        </button>
                        {{-- The clear filters button can remain an <a> tag linking to the base route --}}
                        <a href="{{ route('representatives.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline flex items-center justify-center">
                            फिल्टर खाली गर्नुहोस्
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto rounded-lg ">
                    <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                        <thead class=" text-gray-700 font-semibold bg-blue-200">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">क्र.सं.</th>
                                <th class="px-4 py-3 whitespace-nowrap">विभाग</th>
                                <th class="px-4 py-3 whitespace-nowrap">नाम</th>
                                <th class="px-4 py-3 whitespace-nowrap">वार्ड</th>
                                <th class="px-4 py-3 whitespace-nowrap">फोटो </th>
                                <th class="px-4 py-3 whitespace-nowrap">पद</th>
                                <th class="px-4 py-3 whitespace-nowrap">फोन</th>
                                <th class="px-4 py-3 whitespace-nowrap">इमेल</th>
                                <th class="px-4 py-3 whitespace-nowrap">ठेगाना</th>
                                <th class="px-4 py-3 whitespace-nowrap">कैफियत</th>
                                <th class="px-4 py-3 whitespace-nowrap">अपडेट गर्ने</th>
                                <th class="px-4 py-3 whitespace-nowrap">अपडेट मिति</th>
                                <th class="px-4 py-3 whitespace-nowrap">क्रियाकलापहरू</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($representatives as $representative)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->department->name ?? 'N/A' }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->department->name ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->representative_name }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->representative_name }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->representative_ward }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->representative_ward }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-2">
                                        @if ($representative->representative_image)
                                            <img src="{{ asset('storage/' . $representative->representative_image) }}"
                                                alt="image" class="w-10 h-10 rounded object-cover">
                                        @else
                                            <span class="text-gray-400 italic">No Image</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->postcategory->post_category ?? 'N/A' }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->postcategory->post_category ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->representative_phone }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->representative_phone }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->representative_email ?? 'N/A' }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->representative_email ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->representative_address ?? 'N/A' }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->representative_address ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->remark ?? 'N/A' }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->remark ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->updatedBy->name ?? 'System' }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->updatedBy->name ?? 'System' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-1 min-w-[150px] relative group">
                                        <span class="truncate block overflow-hidden whitespace-nowrap">
                                            {{ $representative->updated_at->format('Y-m-d H:i') }}
                                        </span>
                                        <div
                                            class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                            {{ $representative->updated_at->format('Y-m-d H:i') }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-2  min-w-[200px]">
                                        <a href="" class="text-blue-500 hover:text-blue-700">View</a> |
                                        <a href="{{ route('representatives.edit', $representative->id) }}"
                                            class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                        @hasanyrole('super-admin|admin')
                                            <form action="{{ route('representatives.destroy', $representative->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this representative?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        @endhasanyrole
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-4 py-4 text-center text-gray-500">
                                        कुनै प्रतिनिधि फेला परेनन्।
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $representatives->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for toggling advanced filters --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleAdvancedFiltersBtn');
            const advancedFilters = document.getElementById('advancedFilters');

            if (toggleBtn && advancedFilters) {
                toggleBtn.addEventListener('click', function () {
                    if (advancedFilters.style.display === 'none' || advancedFilters.style.display === '') {
                        advancedFilters.style.display = 'block';
                    } else {
                        advancedFilters.style.display = 'none';
                    }
                });
            }
        });
    </script>
</x-app-layout>
