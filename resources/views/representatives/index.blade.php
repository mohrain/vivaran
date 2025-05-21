<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Office_show') }}
        </h2>
    </x-slot>
    {{-- <a href="{{ route('representatives.create_representatives', ['office_id' => $office->id]) }}"
        class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">+
        Add New</a> --}}

        @isset($office)
    <a href="{{ route('representatives.create_representatives', ['office_id' => $office->id]) }}"
       class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">+
       नयाँ थप्नुहोस्</a>
@else
    <a href="{{ route('representatives.create_representatives') }}"
       class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">+
       नयाँ थप्नुहोस्</a>
@endisset

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                @foreach($representatives as $representative)
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $loop->iteration }}
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
                                                    <img src="{{ asset('storage/' . $representative->representative_image) }}" alt="image"
                                                        class="w-10 h-10 rounded object-cover">
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

                                        <!-- Actions column -->
                                        <td class="px-4 py-2  min-w-[200px]">
                                            <a href="" class="text-blue-500 hover:text-blue-700">View</a> |
                                            <a href="{{ route('representatives.edit', $representative->id) }}"
                                                class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                            <form action="{{ route('representatives.destroy', $representative->id) }}"
                                                method="POST" class="inline"
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
                    <div class="mt-4">
                        {{ $representatives->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
