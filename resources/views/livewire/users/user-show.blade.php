<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div>
        <a href="{{ route('users.index') }}" class="cursor-pointer px-3 py-2 ml-5 text-xs font-medium text-white bg-green-700 rounded-lg hover:bg-green-800">
            Back
        </a>
        <div class="w-1/2 ml-5">
            <p class="mt-2"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="mt-2"><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>
</div>
