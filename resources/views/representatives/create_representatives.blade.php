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

                    <form
                        action="{{ isset($representative) ? route('representatives.update', $representative->id) : route('representatives.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($representative))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">


                            <!-- Department select -->
                            <div class="mb-4">
                                <label for="department_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    विभागको नाम (Department Name):
                                </label>
                                <select id="department_id" name="department_id" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $representative->department_id ?? '') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Name -->
                            <div class="mb-4">
                                <label for="representative_name" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको नाम (Representative Name):
                                </label>
                                <input type="text" id="representative_name" name="representative_name"
                                    value="{{ old('representative_name', $representative->representative_name ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('representative_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                             <!-- Employee Name -->
                             <div class="mb-4">
                                <label for="representative_ward" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको वार्ड (Representative Ward):
                                </label>
                                <input type="text" id="representative_ward" name="representative_ward"
                                    value="{{ old('representative_ward', $representative->representative_ward ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('representative_ward')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Email -->
                            <div class="mb-4">
                                <label for="representative_email" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको इमेल (Representative Email):
                                </label>
                                <input type="text" id="representative_email" name="representative_email"
                                    value="{{ old('representative_email', $representative->representative_email ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('representative_email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Post (dynamic) -->
                            <div class="mb-4">
                                <label for="post_category_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको पद (Representative Post):
                                </label>
                                <select id="post_category_id" name="post_category_id" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    <!-- Options will be dynamically populated -->
                                </select>
                                @error('post_category_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label for="representative_phone" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको फोन (Representative Phone):
                                </label>
                                <input type="text" id="representative_phone" name="representative_phone" maxlength="10"
                                    minlength="10"
                                    value="{{ old('representative_phone', $representative->representative_phone ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('representative_phone')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-4">
                                <label for="representative_address" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको ठेगाना (Representative address):
                                </label>
                                <input type="text" id="representative_address" name="representative_address"
                                    value="{{ old('representative_address', $representative->representative_address ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('representative_address')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <label for="representative_image" class="block text-gray-700 text-sm font-bold mb-2">
                                    प्रतिनिधिको फोटो (Representative Image):
                                </label>
                                <input type="file" id="representative_image" name="representative_image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('representative_image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remark -->
                            <div class="mb-4">
                                <label for="remark" class="block text-gray-700 text-sm font-bold mb-2">
                                    कैफियत (Remark):
                                </label>
                                <input type="text" id="remark" name="remark"
                                    value="{{ old('remark', $representative->remark ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('remark')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg">
                            {{ isset($representative) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
               
                document.addEventListener('DOMContentLoaded', function () {
                    const departmentSelect = document.getElementById('department_id');
                    const postCategorySelect = document.getElementById('post_category_id');
                    const selectedPostCategoryId = "{{ old('post_category_id', $representative->post_category_id ?? '') }}";

                    function loadPostCategories(departmentId, preselectId = null) {
                        postCategorySelect.innerHTML = '<option value="">-- चयन गर्नुहोस् --</option>';

                        if (departmentId) {
                            fetch(`/departments/${departmentId}/post-categories`)
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.length === 0) {
                                        const option = document.createElement('option');
                                        option.value = '';
                                        option.textContent = 'No post categories found';
                                        postCategorySelect.appendChild(option);
                                        return;
                                    }

                                    data.forEach(category => {
                                        const option = document.createElement('option');
                                        option.value = category.id;
                                        option.textContent = category.post_category;
                                        if (preselectId && preselectId == category.id) {
                                            option.selected = true;
                                        }
                                        postCategorySelect.appendChild(option);
                                    });
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.textContent = 'Error loading post categories';
                                    postCategorySelect.appendChild(option);
                                });
                        }
                    }

                    departmentSelect.addEventListener('change', function () {
                        loadPostCategories(this.value);
                    });

                    // Load initial categories if department is already selected
                    if (departmentSelect.value) {
                        loadPostCategories(departmentSelect.value, selectedPostCategoryId);
                    }
                });
            </script>
        @endpush
    </div>

</x-app-layout>