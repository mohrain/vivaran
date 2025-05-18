<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ambulance Records') }}
        </h2>
    </x-slot>

    <a href="{{ route('office_service.create') }}"
        class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">
        + नयाँ थप्नुहोस्
    </a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg">
                        <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                            <thead class="bg-gray-100 text-gray-700 font-semibold bg-blue-200">
                                <tr>
                                    <th class="px-4 py-3">क्र.सं.</th>
                                    <th class="px-4 py-3">कार्यालय</th>
                                    <th class="px-4 py-3">सेवाको प्रकार</th>
                                    <th class="px-4 py-3">इमेल</th>
                                    <th class="px-4 py-3">सम्पर्क</th>
                                    <th class="px-4 py-3">स्थिति</th>
                                    <th class="px-4 py-3">कैफियत</th>
                                    <th class="px-4 py-3">कार्यहरू</th>
                                </tr>
                            </thead>
                            {{-- <tbody class="divide-y divide-gray-200">
                                @foreach ($ambulances as $ambulance)
                                <tr class="hover:bg-gray-50">
                                     <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $ambulance->office->office_name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $ambulance->ambulance_number }}</td>
                                    <td class="px-4 py-2">{{ $ambulance->driver_name }}</td>
                                    <td class="px-4 py-2">{{ $ambulance->driver_contact }}</td>
                                    <td class="px-4 py-2">{{ $ambulance->type }}</td>
                                    <td class="px-4 py-2">
                                        @if ($ambulance->image)
                                            <img src="{{ asset('storage/' . $ambulance->image) }}" class="w-10 h-10 rounded object-cover" alt="image">
                                        @else
                                            <span class="text-gray-400 italic">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $ambulance->status }}</td>
                                    <td class="px-4 py-2">{{ $ambulance->remark ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('ambulances.show', $ambulance->id) }}" class="text-blue-500 hover:text-blue-700">View</a> |
                                        <a href="{{ route('ambulances.edit', $ambulance->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                        <form action="{{ route('ambulances.destroy', $ambulance->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody> --}}

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($officeServices as $officeService)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $officeService->office->office_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $officeService->serviceType->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $officeService->email ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $officeService->contact ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $officeService->status ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $officeService->remark ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('office_service.show', $officeService->id) }}"
                                                class="text-blue-500 hover:text-blue-700">View</a> |
                                            <a href="{{ route('office_service.edit', $officeService->id) }}"
                                                class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                            <form action="{{ route('office_service.destroy', $officeService->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure?');">
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
                        {{-- You can paginate here if needed
                        {{ $ambulances->links() }} --}}
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
