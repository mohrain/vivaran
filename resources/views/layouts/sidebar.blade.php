<div class="w-64 bg-white h-screen shadow-md overflow-y-auto">
    <div class="shrink-0 flex justify-center items-center py-6 border-b border-[#ccc] ">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
        </a>
    </div>
    @php
        use App\Models\Office;

        $sidebarOffices = Office::all();
    @endphp



    <ul class="py-4 space-y-2 ">
        <li>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="w-full text-gray-700 gap-2 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80] font-bold">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </span>
                {{ __('ड्यासबोर्ड ') }}
            </x-nav-link>
        </li>


        {{-- The commented-out Offices Dropdown section has been omitted for brevity,
             but the same principle of adding `@click.stop` to its child links applies. --}}

        <li>
            <x-nav-link :href="route('representatives.index')" :active="request()->routeIs('representatives.index')"
                class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                    </svg>
                </span>
                {{ __('प्रतिनिधिको सूची') }}
            </x-nav-link>
        </li>


        <li>
            <x-nav-link :href="route('employee.index')" :active="request()->routeIs('employee.index')"
                class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1a1 1 0 01-1 1H4a1 1 0 00-1 1v8a2 2 0 002 2h10a2 2 0 002-2v-8a1 1 0 00-1-1h-1a1 1 0 01-1-1V6a4 4 0 00-4-4zm0 2a2 2 0 012 2v1H8V6a2 2 0 012-2zm3.5 9.5A3.5 3.5 0 1013.5 15h-.001z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                {{ __('कर्मचारी') }}
            </x-nav-link>
        </li>


        <li>
            <x-nav-link :href="route('office_service.index')" :active="request()->routeIs('office_service.index')"
                class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M10 6h1v4h-1V6z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M14 6h1v4h-1V6z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M8 6h1v4H8V6z" clip-rule="evenodd" />
                    </svg>
                </span>
                {{ __('कार्यालय सेवा') }}
            </x-nav-link>
        </li>


        <li>
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
                class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                {{ __('प्रयोगकर्ताहरू') }}
            </x-nav-link>
        </li>

        <li x-data="{ open: false }" class="text-sm text-gray-600 list-none">
            {{-- Open the dropdown if any of its child routes are active --}}
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-4 py-3 hover:bg-gray-200 text-gray-700 hover:text-[#6C244C] transition border-b border-[#cccccc80]"
                :class="{ 'text-[#6C244C] bg-gray-100': request()->routeIs('department.index') || request()->routeIs('employee.post_employee') || request()->routeIs('representatives.post_category') || request()->routeIs('office.office_type') || request()->routeIs('office_service.office_type.index') || request()->routeIs('office.ui.office_list') }">
                <div class="flex items-center gap-3">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    {{ __('सेटिङहरू') }}
                </div>
                <svg :class="{ 'rotate-90': open }" class="w-4 h-4 text-red-500 transform transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <ul x-show="open" x-transition class="pl-4 mt-1 space-y-1">

                <li>
                    <x-nav-link :href="route('department.index')" :active="request()->routeIs('department.index')"
                        class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]"
                        @click.stop="open = false"> {{-- Add @click.stop and optionally close dropdown --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ __('विभागहरू') }}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link :href="route('employee.post_employee')" :active="request()->routeIs('employee.post_employee')"
                        class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]"
                        @click.stop="open = false"> {{-- Add @click.stop and optionally close dropdown --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1a1 1 0 01-1 1H4a1 1 0 00-1 1v8a2 2 0 002 2h10a2 2 0 002-2v-8a1 1 0 00-1-1h-1a1 1 0 01-1-1V6a4 4 0 00-4-4zm0 2a2 2 0 012 2v1H8V6a2 2 0 012-2zm3.5 9.5A3.5 3.5 0 1013.5 15h-.001z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ __('कर्मचारी पदको सूची ') }}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link :href="route('representatives.post_category')" :active="request()->routeIs('representatives.post_category')"
                        class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]"
                        @click.stop="open = false"> {{-- Add @click.stop and optionally close dropdown --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ __('प्रतिनिधि पदको सूची ') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('office.office_type')" :active="request()->routeIs('office.office_type')"
                        class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]"
                        @click.stop="open = false"> {{-- Add @click.stop and optionally close dropdown --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ __('कार्यालयहरूको प्रकार ') }}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link :href="route('office_service.office_type.index')" :active="request()->routeIs('office_service.office_type.index')"
                        class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]"
                        @click.stop="open = false"> {{-- Add @click.stop and optionally close dropdown --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ __('सेवाको प्रकार') }}
                    </x-nav-link>
                </li>

                @hasanyrole('super-admin')
                    <li>
                        <x-nav-link href="{{ route('office.ui.office_list') }}" :active="request()->routeIs('office.ui.office_list')"
                            class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]"
                            @click.stop="open = false"> {{-- Add @click.stop and optionally close dropdown --}}
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            {{ __('कार्यालयहरूको सूची') }}
                        </x-nav-link>
                    </li>
                @endhasanyrole

            </ul>
        </li>
    </ul>
</div>
