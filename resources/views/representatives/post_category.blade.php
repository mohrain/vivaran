<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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

                    <div class="grid grid-cols-1 md:grid-cols-2  mb-6">
                        <div class="form">
                            <form
                                action="{{ isset($category) ? route('representative.post_category.update', $category->id) : route('representative.post_category.store') }}"
                                method="POST">
                                @csrf
                                @if(isset($category))
                                    @method('PUT')
                                @endif

                                <div class="create w-[300px] ">

                                    <!-- Change the office select to department select -->
                                    <div class="mb-4">
                                        <label for="department_id" class="block text-gray-700 text-sm font-bold mb-2">
                                            Department name:
                                        </label>
                                        <select id="department_id" name="department_id"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ (old('department_id', isset($category) ? $category->department_id : '') == $department->id ? 'selected' : '') }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="post_category" class="block text-gray-700 text-sm font-bold mb-2">
                                            पदको नाम:
                                        </label>
                                        <input type="text" id="post_category" name="post_category"
                                            value="{{ old('post_category', $category->post_category ?? '') }}"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                        @error('post_category')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="representative_status" class="block text-gray-700 text-sm font-bold mb-2">
                                            स्थिति:
                                        </label>
                                        <select id="status" name="representative_status"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                            <option value="active" {{ (old('representative_status', isset($category) ? $category->representative_status : '') == 'active' ? 'selected' : '') }}>
                                                सक्रिय (Active)
                                            </option>
                                            <option value="disactive" {{ (old('representative_status', isset($category) ? $category->representative_status : '') == 'disactive' ? 'selected' : '') }}>
                                                निस्क्रिय (Disactive)
                                            </option>
                                        </select>

                                        @error('status')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg focus:outline-none focus:shadow-outline">
                                    {{ isset($category) ? 'Update' : 'Submit'}}</button>
                                @if(isset($category))
                                    <a href="{{ route('representatives.post_category') }}"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-10 rounded-lg ml-2">
                                        Cancel
                                    </a>
                                @endif


                            </form>
                        </div>

                        <div class="show -ml-[130px]">
                            <div class="overflow-x-auto rounded-lg">
                                <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                                        <tr>
                                            <th class="px-4 py-3 whitespace-nowrap">क्र.स</th>
                                            <th class="px-4 py-3 whitespace-nowrap">विभाग</th>
                                            <th class="px-4 py-3 whitespace-nowrap">पद प्रकार</th>
                                            <th class="px-4 py-3 whitespace-nowrap">स्थिति</th>
                                            <th class="px-4 py-3 whitespace-nowrap">कार्यहरू</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse ($post_categories as $post_category)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $loop->iteration }}</td>

                                                <td class="px-4 py-2 max-w-[200px] relative group">
                                                    <span class="truncate block overflow-hidden whitespace-nowrap">
                                                        {{ $post_category->department->name ?? 'N/A' }}
                                                    </span>
                                                    <div class="absolute z-10 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 w-max max-w-xs">
                                                        {{ $post_category->department->name ?? 'N/A' }}
                                                    </div>
                                                </td>

                                                <td class="px-4 py-2 min-w-[150px]">{{ $post_category->post_category }}</td>
                                                <td class="px-4 py-2 min-w-[150px]">
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full {{ $post_category->representative_status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $post_category->representative_status == 'active' ? 'सक्रिय (Active)' : 'निष्क्रिय (Inactive)' }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 min-w-[200px]">
                                                    <div class="flex space-x-2">
                                                        <a href="#" class="text-blue-500 hover:text-blue-700">View</a> |
                                                        <a href="{{ route('representative.post_category.edit', $post_category->id) }}"
                                                            class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                                        <form
                                                            action="{{ route('representative.post_category.destroy', $post_category->id) }}"
                                                            method="POST" class="inline"
                                                            onsubmit="return confirm('के तपाईं यो कार्यालय प्रकार मेटाउन निश्चित हुनुहुन्छ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">कुनै डाटा फेला
                                                    परेन (No data found)</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
</x-app-layout>