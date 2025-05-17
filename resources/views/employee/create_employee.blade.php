<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($employee) ? __('Edit Employee') : __('Add New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form
                        action="{{ isset($employee) ? route('employee.update', $employee->id) : route('employee.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($employee))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">


                            <!-- Department select -->
                            <div class="mb-4">
                                <label for="department_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    विभागको नाम:
                                </label>
                                <select id="department_id" name="department_id" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>
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
                                <label for="employee_name" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको नाम:
                                </label>
                                <input type="text" id="employee_name" name="employee_name"
                                    value="{{ old('employee_name', $employee->employee_name ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('employee_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Email -->
                            <div class="mb-4">
                                <label for="employee_email" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको इमेल:
                                </label>
                                <input type="text" id="employee_email" name="employee_email"
                                    value="{{ old('employee_email', $employee->employee_email ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('employee_email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Employee Post (dynamic) -->
                            <div class="mb-4">
                                <label for="post_employee_id" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको पद:
                                </label>
                                <select id="post_employee_id" name="post_employee_id" required
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                    <option value="">-- चयन गर्नुहोस् --</option>
                                </select>
                                @error('post_employee_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label for="employee_phone" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको फोन:
                                </label>
                                <input type="text" id="employee_phone" name="employee_phone" maxlength="10"
                                    minlength="10" value="{{ old('employee_phone', $employee->employee_phone ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('employee_phone')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-4">
                                <label for="employee_address" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको ठेगाना:
                                </label>
                                <input type="text" id="employee_address" name="employee_address"
                                    value="{{ old('employee_address', $employee->employee_address ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('employee_address')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <label for="employee_image" class="block text-gray-700 text-sm font-bold mb-2">
                                    कर्मचारीको फोटो:
                                </label>
                                <input type="file" id="employee_image" name="employee_image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('employee_image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remark -->
                            <div class="mb-4">
                                <label for="remark" class="block text-gray-700 text-sm font-bold mb-2">
                                    कैफियत:
                                </label>
                                <input type="text" id="remark" name="remark"
                                    value="{{ old('remark', $employee->remark ?? '') }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                                @error('remark')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-lg">
                            {{ isset($employee) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const departmentSelect = document.getElementById('department_id');
                    const postEmployeeSelect = document.getElementById('post_employee_id');
                    const selectedPostEmployeeId = "{{ old('post_employee_id', $employee->post_employee_id ?? '') }}";

                    function loadPostEmployees(departmentId, preselectId = null) {
                        postEmployeeSelect.innerHTML = '<option value="">-- चयन गर्नुहोस् --</option>';

                        if (departmentId) {
                            fetch(`/departments/${departmentId}/post-employees`)
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
                                        option.textContent = 'No post employees found';
                                        postEmployeeSelect.appendChild(option);
                                        return;
                                    }

                                    data.forEach(employee => {
                                        const option = document.createElement('option');
                                        option.value = employee.id;
                                        option.textContent = employee.post_employee;
                                        if (preselectId && preselectId == employee.id) {
                                            option.selected = true;
                                        }
                                        postEmployeeSelect.appendChild(option);
                                    });
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.textContent = 'Error loading post employees';
                                    postEmployeeSelect.appendChild(option);
                                });
                        }
                    }

                    departmentSelect.addEventListener('change', function() {
                        loadPostEmployees(this.value);
                    });

                    // Load initial post employees if department is already selected
                    if (departmentSelect.value) {
                        loadPostEmployees(departmentSelect.value, selectedPostEmployeeId);
                    }
                });
            </script>
        @endpush

    </div>

</x-app-layout>
