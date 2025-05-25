<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($department) ? __('Edit Department') : __('Add New Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ isset($department) ? route('department.update', $department->id) : route('department.store') }}" method="POST">
                        @csrf
                        @if (isset($department))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="mb-4">
                                <label for="office_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको नाम:
                                </label>
                                <select id="office_id" name="office_id" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                    @hasanyrole('super-admin')
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    @endhasanyrole
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}"
                                            {{ old('office_id', $department->office_id ?? '') == $office->id ? 'selected' : '' }}>
                                            {{ $office->office_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('office_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                                    विभागको नाम:
                                </label>
                                <input type="text" id="name" name="name" {{-- CORRECTED: name="name" --}}
                                    value="{{ old('name', $department->name ?? '') }}" {{-- CORRECTED: old('name', $department->name ?? '') --}}
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('name') {{-- CORRECTED: @error('name') --}}
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                                                        <div class="mb-4">
                                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">
                                    विभागको प्रकार:
                                </label>
                                <select id="type" name="type" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                    <option value="">-- प्रकार चयन गर्नुहोस् --</option>
                                    <option value="employee" {{ old('type', $department->type ?? '') == 'employee' ? 'selected' : '' }}>कर्मचारी विभाग</option>
                                    <option value="representative" {{ old('type', $department->type ?? '') == 'representative' ? 'selected' : '' }}>प्रतिनिधि विभाग</option>
                                    <option value="both" {{ old('type', $department->type ?? '') == 'both' ? 'selected' : '' }}>दुवै</option>
                                </select>
                                @error('type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2"> {{-- CORRECTED: for="description" --}}
                                    विभागको विवरण :
                                </label>
                                <textarea id="description" name="description" {{-- CORRECTED: name="description" --}}
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200"
                                    rows="3">{{ old('description', $department->description ?? '') }}</textarea> {{-- CORRECTED: old('description', $department->description ?? '') --}}
                                @error('description') {{-- CORRECTED: @error('description') --}}
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>





                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg">
                                {{ isset($department) ? 'Update' : 'Submit' }}
                            </button>

                            @if(isset($department))
                                <a href="{{ route('department.index') }}"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-10 rounded-lg">
                                    Cancel
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
