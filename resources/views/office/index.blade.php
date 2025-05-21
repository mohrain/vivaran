<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            कार्यालय:
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Flash Messages --}}


                    <form action="{{ isset($office) ? route('office.update', $office->id) : route('office.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($office))
                            @method('PUT')
                        @endif

                        {{-- Address Selection --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block font-semibold mb-1">प्रदेश <span
                                        class="text-red-500">*</span></label>
                                <select name="province_id" id="province"
                                    class="form-control w-full border-gray-300 rounded" required
                                    data-selected="{{ old('province_id', $office->address->province ?? '') }}">
                                    <option value="">प्रदेश छान्नुहोस्</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->province }}"
                                            {{ old('province_id', $office->address->province ?? '') == $province->province ? 'selected' : '' }}>
                                            {{ $province->province }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">जिल्ला <span
                                        class="text-red-500">*</span></label>
                                <select name="district_id" id="district"
                                    class="form-control w-full border-gray-300 rounded" required
                                    data-selected="{{ old('district_id', $office->address->district ?? '') }}">
                                    <option value="">जिल्ला छान्नुहोस्</option>
                                    {{-- Districts will be dynamically loaded via JS --}}
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">पालिका <span
                                        class="text-red-500">*</span></label>
                                <select name="address_id" id="municipality"
                                    class="form-control w-full border-gray-300 rounded" required
                                    data-selected="{{ old('address_id', $office->address->id ?? '') }}">
                                    <option value="">पालिका छान्नुहोस्</option>
                                    {{-- Municipalities will be dynamically loaded via JS --}}
                                </select>
                            </div>

                        </div>

                        {{-- Office Name --}}
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">कार्यालयको नाम:</label>
                            <input type="text" name="office_name"
                                value="{{ old('office_name', $office->office_name ?? '') }}"
                                class="w-full border-gray-300 rounded px-3 py-2">
                            @error('office_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Office Email --}}
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">कार्यालयको इमेल:</label>
                            <input type="email" name="office_email"
                                value="{{ old('office_email', $office->office_email ?? '') }}"
                                class="w-full border-gray-300 rounded px-3 py-2">
                            @error('office_email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Office Phone --}}
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">कार्यालयको फोन:</label>
                            <input type="text" name="office_phone" maxlength="10" minlength="10"
                                value="{{ old('office_phone', $office->office_phone ?? '') }}"
                                class="w-full border-gray-300 rounded px-3 py-2"
                                title="कृपया १० अङ्कको नेपाली मोबाइल नम्बर दिनुहोस्">
                            @error('office_phone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Office Type --}}
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">कार्यालयको प्रकार:</label>
                            <select name="office_category_id" class="w-full border-gray-300 rounded px-3 py-2">
                                <option value="">-- चयन गर्नुहोस् --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('office_category_id', $office->office_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->office_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('office_category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Office Address --}}
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">कार्यालयको स्थान:</label>
                            <input type="text" name="office_address"
                                value="{{ old('office_address', $office->office_address ?? '') }}"
                                class="w-full border-gray-300 rounded px-3 py-2">
                            @error('office_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Office Code --}}
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">कार्यालयको कोड:</label>
                            <input type="text" name="office_code"
                                value="{{ old('office_code', $office->office_code ?? '') }}"
                                class="w-full border-gray-300 rounded px-3 py-2">
                            @error('office_code')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                                {{ isset($office) ? 'अपडेट गर्नुहोस्' : 'सेभ गर्नुहोस्' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Province-District-Municipality Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const provinceDropdown = document.getElementById("province");
            const districtDropdown = document.getElementById("district");
            const municipalityDropdown = document.getElementById("municipality");

            const selectedProvince = provinceDropdown.dataset.selected;
            const selectedDistrict = districtDropdown.dataset.selected;
            const selectedMunicipality = municipalityDropdown.dataset.selected;

            function createOption(value, text, selectedValue) {
                return `<option value="${value}" ${value == selectedValue ? 'selected' : ''}>${text}</option>`;
            }

            provinceDropdown.addEventListener("change", function() {
                const provinceId = this.value;

                fetch(`/get/district/${provinceId}`)
                    .then(res => res.json())
                    .then(data => {
                        districtDropdown.innerHTML = '<option value="">जिल्ला छान्नुहोस्</option>';
                        data.forEach(district => {
                            districtDropdown.innerHTML += createOption(district.district,
                                district.district, selectedDistrict);
                        });

                        // Trigger change if we’re editing
                        if (selectedDistrict) {
                            districtDropdown.dispatchEvent(new Event("change"));
                        }
                    });

                municipalityDropdown.innerHTML = '<option value="">पालिका छान्नुहोस्</option>';
            });

            districtDropdown.addEventListener("change", function() {
                const districtId = String(this.value);

                fetch(`/get/municipalities/${districtId}`)
                    .then(res => res.json())
                    .then(data => {
                        municipalityDropdown.innerHTML = '<option value="">पालिका छान्नुहोस्</option>';
                        data.forEach(mun => {
                            municipalityDropdown.innerHTML += createOption(mun.id, mun
                                .municipality, selectedMunicipality);
                        });
                    });
            });

            // On edit load
            if (selectedProvince) {
                provinceDropdown.value = selectedProvince;
                provinceDropdown.dispatchEvent(new Event("change"));
            }
        });
    </script>

</x-app-layout>
