
<div>
    <a href="{{ route('users.index') }}"
        class="cursor-pointer px-3 py-2 ml-5 text-xs font-medium text-white bg-green-700 rounded-lg hover:bg-green-800">
        Back
    </a>
    <div class="w-1/2">
        <form class="mt-6 space-y-6 ml-5" wire:submit.prevent="submit">
            <input type="text" class="block w-full border rounded px-3 py-2" placeholder="Name" wire:model="name" />
            <input type="email" class="block w-full border rounded px-3 py-2" placeholder="Email" wire:model="email" />
            <input type="password" class="block w-full border rounded px-3 py-2" placeholder="Password"
                wire:model="password" />
            <input type="password" class="block w-full border rounded px-3 py-2" placeholder="Confirm Password"
                wire:model="confirm_password" />

                @if (Auth::user()->hasRole('super-admin'))
                    <select wire:model="office_id" class="block w-full border rounded px-3 py-2">
                        <option value="">Select Office</option>
                        @foreach ($offices as $office)
                            <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                        @endforeach
                    </select>
                @endif

            <select wire:model="role" class="block w-full border rounded px-3 py-2">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
</div>
