<div>
    {{-- <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading><br>
        <flux:subheading size="lg" class="mb-6">
            {{ __('Manage your users') }}</flux:subheading>
            <flux-separator varient="subtle" />
    </div> --}}

    <div >
        @session('success')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-3 rounded relative" role="alert">
                <strong class="font-bold">✔</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endsession


        <a href="{{ route('users.create') }}" class="cursor-pointer px-3 py-2 ml-5 text-xs font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Create User
        </a>

        <div class="overflow-x-auto mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-black-500 dark:text-black-400">
                <thead class="text-xs text-black-700 uppercase bg-gray-50  dark:text-black-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ( $users as $user ) 
                <tr class="odd:bg-white  even:bg-gray-50 border-b dark:border-gray-700 border-gray-200 ml-10">
                    <td class="px-6 py-2 font-medium text-black dark:text-black">{{ $user->id }}</td>
                    <td class="px-6 py-2 text-black-600 dark:text-black-300">{{$user->name}}</td>
                    <td class="px-6 py-2 text-black-600 dark:text-black-300">{{$user->email}}</td>
                    <td class="px-6 py-2">
                        <a href="{{ route('users.show', $user->id) }}" class=" mr-1 cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800">
                            Show
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </a>
                        <button wire:click="delete({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ml-1">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
