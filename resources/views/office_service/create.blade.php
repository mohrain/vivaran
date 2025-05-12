<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Office Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('office_service.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (isset($officeServices))
                            @method('PUT')
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <!-- Office select -->
                            <div class="mb-4">
                                <label for="office_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    कार्यालय (Office):
                                </label>
                                <select id="office_id" name="office_id" required
                                    class="block w-full text-sm border rounded-lg bg-gray-50 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}"
                                                {{ old('office_id', $officeService->office_id ?? '') == $office->id ? 'selected' : '' }}>
                                                {{ $office->office_name }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('office_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Service Type -->
                            <div class="mb-4">
                                <label for="service_type" class="block text-gray-700 text-sm font-bold mb-2">
                                    सेवाको प्रकार (Service Type):
                                </label>
                                <select id="service_type" name="service_type" required
                                    class="block w-full text-sm border rounded-lg bg-gray-50 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    @foreach ($ServiceTypes as $serviceType)
                                        <option value="{{ $serviceType->name }}"
                                            {{ old('service_type', $officeService->service_type ?? '') == $serviceType ? 'selected' : '' }}>
                                            {{ $serviceType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="office_email" class="block text-gray-700 text-sm font-bold mb-2">
                                    इमेल (Service Email):
                                </label>
                                <input type="text" id="office_email" name="office_email"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 transition-all duration-200">
                                @error('office_email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Provider Contact -->
                            <div class="mb-4">
                                <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">
                                    सम्पर्क नम्बर (Contact Number):
                                </label>
                                <input type="text" id="contact" name="contact" maxlength="10" minlength="10"
                                    {{-- value="{{ old('provider_contact', $officeService->provider_contact ?? '') }}" --}}
                                    class="block w-full text-sm border rounded-lg bg-gray-50 px-3 py-2">
                                @error('contact')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                                    स्थिति (Status):
                                </label>
                                <select id="status" name="status" required
                                    class="block w-full text-sm border rounded-lg bg-gray-50 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                </select>
                                @error('status')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <!-- Remark -->
                            <div class="mb-4">
                                <label for="remark" class="block text-gray-700 text-sm font-bold mb-2">
                                    कैफियत (Remark):
                                </label>
                                <textarea id="remark" name="remark" class="block w-full text-sm border rounded-lg bg-gray-50 px-3 py-2"></textarea>
                                @error('remark')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg">
                            {{ isset($officeServices) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
