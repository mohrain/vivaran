<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('कर्मचारी सूची') }}
            {{-- Display current department if filtered --}}
            @if (request()->has('department_id') && $currentDepartmentName)
                : {{ $currentDepartmentName }}
            @endif
        </h2>
    </x-slot>

    @isset($office)
        <a href="{{ route('employee.create', ['office_id' => $office->id]) }}"
           class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">+
           नयाँ थप्नुहोस्</a>
    @else
        <a href="{{ route('employee.create') }}"
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
                                @foreach($employees as $employee)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->department?->name ?? 'N/A' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->department?->name ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->employee_name }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->employee_name }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-2">
                                            @if ($employee->employee_image)
                                                <img src="{{ asset('storage/' . $employee->employee_image) }}" alt="image"
                                                     class="w-10 h-10 rounded object-cover">
                                            @else
                                                <span class="text-gray-400 italic">No Image</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->postemployee->post_employee ?? 'N/A' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->postemployee->post_employee ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->employee_phone }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->employee_phone }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->employee_email ?? 'N/A' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->employee_email ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->employee_address ?? 'N/A' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->employee_address ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->remark ?? 'N/A' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->remark ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->updatedBy?->name ?? 'System' }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->updatedBy?->name ?? 'System' }}
                                            </div>
                                        </td>


                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $employee->updated_at->format('Y-m-d H:i') }}
                                            </span>
                                            <div
                                                class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $employee->updated_at->format('Y-m-d H:i') }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-2  min-w-[200px]">

                                            <a href="" class="text-blue-500 hover:text-blue-700">Show</a> |

                                            <a href="{{ route('employee.edit', $employee->id) }}"
                                                class="text-yellow-500 hover:text-yellow-700">Edit</a> |

                                                @hasanyrole('super-admin|admin')
                                                <form action="{{ route('employee.destroy', $employee->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                    class="text-red-500 hover:text-red-700">Delete</button>

                                                    @endhasanyrole
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
