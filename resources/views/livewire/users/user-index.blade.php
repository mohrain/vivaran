{{-- filepath: resources/views/livewire/users/user-index.blade.php --}}
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div id="flash-message" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">✔</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @hasanyrole('super-admin|admin')
    <a href="{{ route('users.create') }}" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 ml-[50px] px-10 rounded-lg focus:outline-none focus:shadow-outline">
        + नयाँ थप्नुहोस्
    </a>
    @endhasanyrole

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                            <thead class="bg-gray-100 text-gray-700 font-semibold bg-blue-200">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">क्र.स.</th>
                                    <th class="px-4 py-3 whitespace-nowrap">नाम</th>
                                    <th class="px-4 py-3 whitespace-nowrap">इमेल</th>
                                    <th class="px-4 py-3 whitespace-nowrap">कार्यालय</th>
                                    <th class="px-4 py-3 whitespace-nowrap">भूमिका</th>
                                    <th class="px-4 py-3 whitespace-nowrap">कार्यहरू</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">{{ $user->name }}</span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-1 min-w-[180px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">{{ $user->email }}</span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-1 min-w-[150px] relative group">
                                            <span class="truncate block overflow-hidden whitespace-nowrap">
                                                {{ $user->office_id ?? 'N/A' }}
                                            </span>
                                            <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 mb-1 w-max max-w-xs">
                                                {{ $user->office_id ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-1 min-w-[120px]">
                                            @foreach ($user->getRoleNames() as $role)
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                                    {{ $role }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-2 min-w-[200px]">
                                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:text-blue-700">Show</a>
                                            @hasanyrole('super-admin|admin')
                                            | <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                            | <button wire:click="delete({{ $user->id }})" onclick="return confirm('Are you sure you want to delete this user?')" class="text-red-500 hover:text-red-700">Delete</button>
                                            @endhasanyrole
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">कुनै डाटा फेला परेन (No data found)</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination (if using) --}}
                        {{-- <div class="mt-4">{{ $users->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
