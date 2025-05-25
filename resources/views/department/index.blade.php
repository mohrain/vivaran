<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department list') }}
        </h2>
    </x-slot>

    <a href="{{ route('department.create') }}"
       class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">+
       नयाँ थप्नुहोस्</a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto rounded-lg">
                        <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                            <thead class=" text-gray-700 font-semibold bg-blue-200">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">क्र.सं.</th>
                                    @hasanyrole('super-admin')
                                    <th class="px-4 py-3 whitespace-nowrap">कार्यालय</th>
                                    @endhasanyrole
                                    <th class="px-4 py-3 whitespace-nowrap">विभागको नाम</th>
                                    <th class="px-4 py-3 whitespace-nowrap">विभागको प्रकार</th>
                                    <th class="px-4 py-3 whitespace-nowrap">विवरण</th>
                                    <th class="px-4 py-3 whitespace-nowrap">अपडेट मिति</th>
                                    <th class="px-4 py-3 whitespace-nowrap">क्रियाकलापहरू</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($departments as $department)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>

                                        @hasanyrole('super-admin')
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $department->office->office_name ?? 'N/A' }}
                                            </span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $department->office->office_name ?? 'N/A' }}
                                            </div>
                                        </td>
                                        @endhasanyrole

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $department->name }}
                                            </span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $department->name }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $department->type }}
                                            </span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $department->type }}
                                            </div>
                                        </td>


                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $department->description ?? 'N/A' }}
                                            </span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $department->description ?? 'N/A' }}
                                            </div>
                                        </td>



                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $department->updated_at->format('Y-m-d H:i') }}
                                            </span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $department->updated_at->format('Y-m-d H:i') }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-2 min-w-[200px]">
                                            <a href="{{ route('department.index', $department->id) }}" class="text-blue-500 hover:text-blue-700">View</a> |
                                            <a href="{{ route('department.edit', $department->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                            <form action="{{ route('department.destroy', $department->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('के तपाइँ पक्कै मेटाउन चाहनुहुन्छ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
