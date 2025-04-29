<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($representative) ? __('Edit Employee') : __('Add New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (isset($representative))
                        <form action="{{ route('representatives.update', $representative->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('representatives.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                            <!-- Employee Name -->
                            <div class="mb-4">
                                <label for="representative_name" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको नाम (Employee Name):
                                </label>
                                <input type="text" id="representative_name" name="representative_name"
                                    value="{{ old('representative_name', $representative->representative_name ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('representative_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Post -->
                            <div class="mb-4">
                                <label for="post_category_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको पद (Employee Post):
                                </label>
                                <select id="post_category_id" name="post_category_id" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    @foreach ($post_categories as $post_category)
                                        <option value="{{ $post_category->id }}"
                                            {{ (old('post_category_id', $representative->post_category_id ?? '') == $post_category->id) ? 'selected' : '' }}>
                                            {{ $post_category->post_category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('post_category_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Phone -->
                            <div class="mb-4">
                                <label for="representative_phone" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको फोन (Employee Phone):
                                </label>
                                <input type="text" id="representative_phone" name="representative_phone" maxlength="10" minlength="10"
                                    value="{{ old('representative_phone', $representative->representative_phone ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('representative_phone')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remark -->
                            <div class="mb-4">
                                <label for="remark" class="block text-gray-700 text-sm font-bold mb-2">
                                    कैफियत (Remark):
                                </label>
                                <input type="text" id="remark" name="remark"
                                    value="{{ old('remark', $representative->remark ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('remark')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                           
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg focus:outline-none focus:shadow-outline">{{ isset($representative) ? 'Update' : 'Submit' }}</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
