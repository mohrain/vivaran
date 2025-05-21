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
                    {{-- Flash Error Message --}}


                    <div class="grid grid-cols-1 md:grid-cols-2  mb-6">
                        <div class="form">
                            <form
                                action="{{ isset($category) ? route('office.category.update', $category->id) : route('office.office_type.store') }}"
                                method="POST">
                                @csrf
                                @if(isset($category))
                                    @method('PUT')
                                @endif

                                <div class="create w-[300px] ">
                                    <div class="mb-4">
                                        <label for="office_name" class="block text-gray-700 text-sm font-bold mb-2">
                                            कार्यालय प्रकारको नाम:
                                        </label>
                                        <input type="text" id="office_name" name="office_type"
                                            value="{{ old('office_type', $category->office_type ?? '') }}"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                        @error('office_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                                            स्थिति:
                                        </label>
                                        <select id="status" name="office_status"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                            <option value="active" {{ (old('office_status', isset($category) ? $category->office_status : '') == 'active' ? 'selected' : '') }}>
                                                सक्रिय
                                            </option>
                                            <option value="disactive" {{ (old('office_status', isset($category) ? $category->office_status : '') == 'disactive' ? 'selected' : '') }}>
                                                निस्क्रिय
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
                                    <a href="{{ route('office.office_type') }}"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-10 rounded-lg ml-2">
                                        Cancel
                                    </a>
                                @endif


                            </form>
                        </div>

                        <div class="show -ml-[130px]">
                            <div class="overflow-x-auto rounded-lg">
                                <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">
                                    <thead class="bg-blue-200 text-gray-700 font-semibold">
                                        <tr>
                                            <th class="px-4 py-3 whitespace-nowrap">क्र.स </th>
                                            <th class="px-4 py-3 whitespace-nowrap">कार्यालय प्रकार </th>
                                            <th class="px-4 py-3 whitespace-nowrap">स्थिति </th>

                                            <th class="px-4 py-3 whitespace-nowrap">कार्यहरू </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse ($office_categories as $office_category)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-2 min-w-[150px]">{{ $office_category->office_type }}</td>
                                                <td class="px-4 py-2 min-w-[150px]">
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full {{ $office_category->office_status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $office_category->office_status == 'active' ? 'सक्रिय (Active)' : 'निष्क्रिय (Inactive)' }}
                                                    </span>
                                                </td>

                                                <td class="px-4 py-2 min-w-[200px] flex space-x-2">
                                                    <a href="#" class="text-blue-500 hover:text-blue-700">View</a>
                                                    <a href="{{ route('office.category.edit', $office_category->id) }}"
                                                        class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                                    <form
                                                        action="{{ route('office.category.destroy', $office_category->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('के तपाईं यो कार्यालय प्रकार मेटाउन निश्चित हुनुहुन्छ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-500 hover:text-red-700">Delete</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">कुनै डाटा
                                                    फेला परेन</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
