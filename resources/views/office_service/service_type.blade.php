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

                    <div class="grid grid-cols-1 md:grid-cols-2 mb-6">
                        <div class="form">
                            <form
                                action="{{ isset($editServiceType) ? route('service_type.update', $editServiceType->id) : route('office_service.office_type.store') }}"
                                method="POST">
                                @csrf
                                @if(isset($editServiceType))
                                    @method('PUT')
                                @endif

                                <div class="create w-[300px]">
                                    <div class="mb-4">
                                        <label for="service_name" class="block text-gray-700 text-sm font-bold mb-2">
                                            सेवाको नाम:
                                        </label>
                                        <input type="text" id="service_name" name="service_name"
                                            value="{{ old('service_name', $editServiceType->name ?? '') }}"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                        @error('service_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="service_description"
                                            class="block text-gray-700 text-sm font-bold mb-2">
                                            सेवाको विवरण:
                                        </label>
                                        <input type="text" id="service_description" name="service_description"
                                            value="{{ old('service_description', $editServiceType->description ?? '') }}"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                        @error('service_description')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg focus:outline-none focus:shadow-outline">
                                    {{ isset($editServiceType) ? 'Update' : 'Submit' }}
                                </button>

                                @if(isset($editServiceType))
                                    <a href="{{ route('office_service.office_type') }}"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-10 rounded-lg ml-2">
                                        Cancel
                                    </a>
                                @endif
                            </form>
                        </div>

                        <div class="show -ml-[130px]">
                            <div class="overflow-x-auto rounded-lg">
                                <table class="table-auto min-w-full text-sm text-left text-gray-700 bg-white">


                                    <!-- Table headers remain the same -->
                                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                                        <tr>
                                            <th class="px-4 py-3 whitespace-nowrap">क्र.स</th>
                                            <th class="px-4 py-3 whitespace-nowrap">सेवाको नाम</th>
                                            <th class="px-4 py-3 whitespace-nowrap">विवरण</th>
                                            <th class="px-4 py-3 whitespace-nowrap">कार्यहरू</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse ($serviceTypes as $serviceType)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-2">{{ $serviceType->name }}</td>
                                                <td class="px-4 py-2">{{ $serviceType->description }}</td>
                                                <td class="px-4 py-2 min-w-[200px]">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('office_service.office_type', ['edit' => $serviceType->id]) }}"
                                                            class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                                        <form action="{{ route('service_type.destroy', $serviceType->id) }}"
                                                            method="POST" class="inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this service type?')">
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
                                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                                    कुनै सेवाको प्रकार फेला परेन
                                                </td>
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
