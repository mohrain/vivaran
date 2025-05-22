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
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        @hasanyrole('super-admin|admin')
                        <a href="{{ route('users.index') }}"
                            class="block bg-blue-100 hover:bg-blue-200 text-blue-800 font-bold py-4 px-6 rounded-lg text-center shadow">
                            प्रयोगकर्ताहरू
                            <div class="text-3xl mb-2">{{ $officeUserCount }}</div>
                        </a>
                        @endhasanyrole

                        @hasanyrole('super-admin')
                        <a href="{{ route('office.ui.office_list') }}"
                            class="block bg-green-100 hover:bg-green-200 text-green-800 font-bold py-4 px-6 rounded-lg text-center shadow">
                            कार्यालयहरू
                            <div class="text-3xl mb-2">{{ $officeCount }}</div>
                        </a>
                        @endhasanyrole
                        <a href="{{ route('department.index') }}"
                            class="block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-bold py-4 px-6 rounded-lg text-center shadow">
                            विभागहरू
                            <div class="text-3xl mb-2">{{ $officeDepartmentCount }}</div>
                        </a>
                        <a href="{{ route('employee.index') }}"
                            class="block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-bold py-4 px-6 rounded-lg text-center shadow">
                            कर्मचारीहरू
                            <div class="text-3xl mb-2">{{ $employeeCount }}</div>
                        </a>
                        <a href="{{ route('representatives.index') }}"
                            class="block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-bold py-4 px-6 rounded-lg text-center shadow">
                            प्रतिनिधिको सूची
                            <div class="text-3xl mb-2">{{ $officeRepresentativeCount }}</div>
                        </a>
                        <a href="{{ route('office_service.index') }}"
                            class="block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-bold py-4 px-6 rounded-lg text-center shadow">
                            कार्यालय सेवा
                            <div class="text-3xl mb-2">{{ $officeServiceCount }}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
