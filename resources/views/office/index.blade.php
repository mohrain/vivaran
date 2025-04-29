<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            कार्यालय (Office):
        </h2>
    </x-slot>
   
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div id="flash-message"
                            class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Flash Error Message --}}
                    @if (session('error'))
                        <div id="flash-error"
                            class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <script>
                        setTimeout(function () {
                            var successMessage = document.getElementById('flash-message');
                            var errorMessage = document.getElementById('flash-error');

                            if (successMessage) {
                                successMessage.style.display = 'none';
                            }
                            if (errorMessage) {
                                errorMessage.style.display = 'none';
                            }
                        }, 4000);  
                    </script>


                    <form action="{{ isset($office) ? route('office.update', $office->id) : route('office.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($office))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="mb-4">
                                <label for="office_name" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको नाम (Office Name):
                                </label>
                                <input type="text" id="office_name" name="office_name"
                                    value="{{ old('office_name', isset($office) ? $office->office_name : '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('office_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_email" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको इमेल (Office Email):
                                </label>
                                <input type="text" id="office_email" name="office_email"
                                    value="{{ old('office_email', isset($office) ? $office->office_email : '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('office_email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_phone" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको फोन (Office Phone):
                                </label>
                                <input type="text" id="office_phone" name="office_phone" maxlength="10" minlength="10"
                                    value="{{ old('office_phpne', isset($office) ? $office->office_phone : '') }}"
                                    title="कृपया १० अङ्कको नेपाली मोबाइल नम्बर (98xxxxxxxx वा 97xxxxxxxx) दिनुहोस्"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('office_phone')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_category_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको प्रकार (Office Type):
                                </label>
                                <select id="office_category_id" name="office_category_id"
                                    value="{{ old('office_category_id', isset($office) ? $office->office_category_id : '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                    <option value="" disabled selected>-- चयन गर्नुहोस् --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('office_category_id', isset($office) ? $office->office_category_id : '') == $category->id) ? 'selected' : '' }}>
                                            {{ $category->office_type }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('office_category_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_address" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको स्थान (Office Location):
                                </label>
                                <input type="text" id="office_address" name="office_address"
                                    value="{{ old('office_address', isset($office) ? $office->office_address : '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('office_address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_code" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको कोड (Office Code):
                                </label>
                                <input type="text" id="office_code" name="office_code"
                                    value="{{ old('office_code', isset($office) ? $office->office_code : '') }}"
                                    title="कार्यालयको कोड अंग्रेजी अक्षर, अंक र '-' मात्र समावेश गरी ३ देखि १० वर्णको हुनुपर्छ"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('office_code')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="mb-4">
                                <label for="office_logo" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालयको लोगो (Office Logo):
                                </label>
                                @if (isset($office) && $office->office_logo)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $office->office_logo) }}" alt="Current Logo"
                                            class="h-20">
                                    </div>
                                @endif
                                <input type="file" id="office_logo" name="office_logo"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200">
                                @error('office_logo')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_description" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालय विवरण (Office Description):
                                </label>
                                <textarea id="office_description" name="office_description"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200"
                                    rows="3">    {{ old('office_description', isset($office) ? $office->office_description : '') }}</textarea>
                                @error('office_description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <button type="submit"
                           
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg focus:outline-none focus:shadow-outline">{{ isset($office) ? 'Update' : 'Submit' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>