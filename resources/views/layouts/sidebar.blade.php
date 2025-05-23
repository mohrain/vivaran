<div class="w-64 bg-white h-screen shadow-md overflow-y-auto">
    <div class="shrink-0 flex justify-center items-center py-6 border-b border-[#ccc] ">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
        </a>
    </div>
    @php
        use App\Models\Office;
        use App\Models\Department;

        $sidebarOffices = Office::all();

        $representativeDepartments = Department::where('type', 'representative')
            ->orWhere('type', 'both')
            ->oldest('name') // Order alphabetically
            ->get();


        $employeeDepartments = Department::where('type', 'employee')
            ->orWhere('type', 'both')
            ->oldest('name') // Order alphabetically
            ->get();
    @endphp

    <ul class="py-4 space-y-2 ">
        {{-- Dashboard Link --}}
        <li>
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg group text-sm font-medium transition duration-150 ease-in-out border-b border-[#cccccc80]
                {{ request()->routeIs('dashboard') ? 'bg-[#6C244C] text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <span
                    class="
                    {{ request()->routeIs('dashboard') ? 'text-white' : 'text-red-500' }}
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </span>
                <span class="ms-3">{{ __('ड्यासबोर्ड') }}</span>
            </a>
        </li>


        {{-- Representative Dropdown --}}
        <li x-data="{ open: {{ request()->routeIs('representatives.*') && !request()->routeIs('representatives.post_category') ? 'true' : 'false' }} }">
            <button @click.prevent="open = !open"
                class="flex items-center justify-between w-full px-4 py-3 rounded-lg group text-sm font-medium transition duration-150 ease-in-out border-b border-[#cccccc80]
                {{ request()->routeIs('representatives.*') && !request()->routeIs('representatives.post_category') ? 'bg-[#6C244C] text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <div class="flex items-center gap-3">
                    <span
                        class="{{ request()->routeIs('representatives.*') && !request()->routeIs('representatives.post_category') ? 'text-white' : 'text-red-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                        </svg>
                    </span>
                    <span class="ms-3">{{ __('प्रतिनिधिको सूची') }}</span>
                </div>
                <svg :class="{ 'rotate-90': open }"
                    class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs('representatives.*') && !request()->routeIs('representatives.post_category') ? 'text-white' : 'text-red-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <ul x-show="open" x-transition class="py-2 space-y-2 pl-4 mt-1">

                <li>
                    <x-nav-link :href="route('representatives.index')" :active="request()->routeIs('representatives.index') && !request()->has('department_id') && !request()->has('representative_ward')">
                        {{ __('सबै प्रतिनिधिहरू') }}
                    </x-nav-link>
                </li>

                @foreach ($representativeDepartments as $department)
                    <li>
                        <x-nav-link :href="route('representatives.index', ['department_id' => $department->id])" :active="request()->routeIs('representatives.index') && request('department_id') == $department->id">
                            {{ $department->name }}
                        </x-nav-link>
                    </li>
                @endforeach
            </ul>
        </li>


        {{-- Employee Dropdown --}}
        <li x-data="{ open: {{ request()->routeIs('employee.*') && !request()->routeIs('employee.post_employee') ? 'true' : 'false' }} }">
            <button @click.prevent="open = !open"
                class="flex items-center justify-between w-full px-4 py-3 rounded-lg group text-sm font-medium transition duration-150 ease-in-out border-b border-[#cccccc80]
                {{ request()->routeIs('employee.*') && !request()->routeIs('employee.post_employee') ? 'bg-[#6C244C] text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <div class="flex items-center gap-3">
                    <span
                        class="{{ request()->routeIs('employee.*') && !request()->routeIs('employee.post_employee') ? 'text-white' : 'text-red-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1a1 1 0 01-1 1H4a1 1 0 00-1 1v8a2 2 0 002 2h10a2 2 0 002-2v-8a1 1 0 00-1-1h-1a1 1 0 01-1-1V6a4 4 0 00-4-4zm0 2a2 2 0 012 2v1H8V6a2 2 0 012-2zm3.5 9.5A3.5 3.5 0 1013.5 15h-.001z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="ms-3">{{ __('कर्मचारी') }}</span>
                </div>
                <svg :class="{ 'rotate-90': open }"
                    class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs('employee.*') && !request()->routeIs('employee.post_employee') ? 'text-white' : 'text-red-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <ul x-show="open" x-transition class="py-2 space-y-2 pl-4 mt-1">
                <li>
                    <x-nav-link :href="route('employee.index')" :active="request()->routeIs('employee.index') && !request()->has('department_id')">
                        {{ __('सबै कर्मचारीहरू') }}
                    </x-nav-link>
                </li>


                @foreach ($employeeDepartments as $department)
                    <li>

                        <x-nav-link :href="route('employee.index', ['department_id' => $department->id])" :active="request()->routeIs('employee.index') && request('department_id') == $department->id">
                            {{ $department->name }}
                        </x-nav-link>
                    </li>
                @endforeach
            </ul>
        </li>


        {{-- Office Service Link --}}
        <li>
            <a href="{{ route('office_service.index') }}"
                class="flex items-center px-4 py-3 rounded-lg group text-sm font-medium transition duration-150 ease-in-out border-b border-[#cccccc80]
                {{ request()->routeIs('office_service.index') ? 'bg-[#6C244C] text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <span
                    class="
                    {{ request()->routeIs('office_service.index') ? 'text-white' : 'text-red-500' }}
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M10 6h1v4h-1V6z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M14 6h1v4h-1V6z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M8 6h1v4H8V6z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="ms-3">{{ __('कार्यालय सेवा') }}</span>
            </a>
        </li>


        {{-- Users Link --}}
        <li>
            <a href="{{ route('users.index') }}"
                class="flex items-center px-4 py-3 rounded-lg group text-sm font-medium transition duration-150 ease-in-out border-b border-[#cccccc80]
                {{ request()->routeIs('users.index') ? 'bg-[#6C244C] text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <span
                    class="
                    {{ request()->routeIs('users.index') ? 'text-white' : 'text-red-500' }}
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="ms-3">{{ __('प्रयोगकर्ताहरू') }}</span>
            </a>
        </li>

        {{-- Settings Dropdown --}}
        <li x-data="{ open: {{ request()->routeIs(['department.*', 'employee.post_employee', 'representatives.post_category', 'office.office_type', 'office_service.office_type.index', 'office.ui.office_list']) ? 'true' : 'false' }} }">
            <button @click.prevent="open = !open"
                class="flex items-center justify-between w-full px-4 py-3 rounded-lg group text-sm font-medium transition duration-150 ease-in-out border-b border-[#cccccc80]
                {{ request()->routeIs(['department.*', 'employee.post_employee', 'representatives.post_category', 'office.office_type', 'office_service.office_type.index', 'office.ui.office_list']) ? 'bg-[#6C244C] text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <div class="flex items-center gap-3">
                    <span
                        class="
                        {{ request()->routeIs(['department.*', 'employee.post_employee', 'representatives.post_category', 'office.office_type', 'office_service.office_type.index', 'office.ui.office_list']) ? 'text-white' : 'text-red-500' }}
                        ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="ms-3">{{ __('सेटिङहरू') }}</span>
                </div>
                <svg :class="{ 'rotate-90': open }"
                    class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs(['department.*', 'employee.post_employee', 'representatives.post_category', 'office.office_type', 'office_service.office_type.index', 'office.ui.office_list']) ? 'text-white' : 'text-red-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <ul x-show="open" x-transition class="pl-4 mt-1 space-y-1">

                <li>
                    <x-nav-link :href="route('department.index')" :active="request()->routeIs('department.index')">
                        {{ __('विभागहरू') }}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link :href="route('employee.post_employee')" :active="request()->routeIs('employee.post_employee')">
                        {{ __('कर्मचारी पदको सूची ') }}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link :href="route('representatives.post_category')" :active="request()->routeIs('representatives.post_category')">
                        {{ __('प्रतिनिधि पदको सूची ') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('office.office_type')" :active="request()->routeIs('office.office_type')">
                        {{ __('कार्यालयहरूको प्रकार ') }}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link :href="route('office_service.office_type.index')" :active="request()->routeIs('office_service.office_type.index')">
                        {{ __('सेवाको प्रकार') }}
                    </x-nav-link>
                </li>

                @hasanyrole('super-admin')
                    <li>
                        <x-nav-link href="{{ route('office.ui.office_list') }}" :active="request()->routeIs('office.ui.office_list')">
                            {{ __('कार्यालयहरूको सूची') }}
                        </x-nav-link>
                    </li>
                @endhasanyrole

            </ul>
        </li>
    </ul>
</div>
