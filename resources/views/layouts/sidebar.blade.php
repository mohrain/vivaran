<div class=" w-64 bg-white h-screen shadow-md ">
    <!-- Logo -->
    <div class="shrink-0 flex justify-center items-center py-6 border-b border-[#ccc]">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
        </a>
    </div>


    {{-- -------------- --}}
     @php
    use App\Models\Office;
    $sidebarOffices = Office::all();
@endphp



    <!---- Side links --->
    <ul class="py-4 space-y-2">
        <li>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="w-full text-gray-700 gap-2 hover:text-[#6C244C]  hover:bg-gray-200  transition border-b border-[#cccccc80]">
                <!-- Dashboard Icon -->
                <span><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                        stroke-linejoin="round" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                        <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                        <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                        <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                    </svg></span>
                {{ __('ड्यासबोर्ड ') }}
            </x-nav-link>
        </li>



        <li x-data="{ open: false }" class="text-sm mt-5 text-gray-600 ml-5  font-bold list-none">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 text-gray-700">
                {{ __('कार्यालयहरू') }}
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        
            <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                @foreach ($sidebarOffices as $office)
                    <li>
                        <x-nav-link :href="route('office.show', $office->id)"
                            class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]">
                            {{ $office->office_name }}
                        </x-nav-link>
                    </li>
                @endforeach
            </ul>
        </li>
        


        <li>
            <x-nav-link href="{{ route('office.ui.office_list') }}" 
                class="flex items-center gap-2 w-full text-gray-700 hover:text-[#6C244C] hover:bg-gray-200 transition border-b border-[#cccccc80]">
                <span>
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round" height="16" width="16"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </span>
                {{ __('कार्यालयहरूको सूची') }}
            </x-nav-link>
        </li>
        

        <li>
            <x-nav-link :href="route('office.office_type')" 
                class="flex items-center gap-2 w-full  text-gray-700 hover:text-[#6C244C] hover:bg-gray-200  transition border-b border-[#cccccc80]">
                        <!-- Office List Icon -->
                        <span>
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" height="16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </span>
                        

                {{ __('कार्यालयहरूको प्रकार ') }}
            </x-nav-link> 
        </li>

        <li>
            <x-nav-link :href="route('representatives.index')" 
                class="flex items-center gap-2 w-full  text-gray-700 hover:text-[#6C244C] hover:bg-gray-200  transition border-b border-[#cccccc80]">
                        <!-- Office List Icon -->
                        <span>
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" height="16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </span>
                {{ __('प्रतिनिधिको सूची') }}
            </x-nav-link> 
        </li>
       
        <li>
            <x-nav-link :href="route('representatives.post_category')" 
                class="flex items-center gap-2 w-full  text-gray-700 hover:text-[#6C244C] hover:bg-gray-200  transition border-b border-[#cccccc80]">
                        <!-- Office List Icon -->
                        <span>
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" height="16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </span>
                {{ __('प्रतिनिधि पदको सूची ') }}
            </x-nav-link> 
        </li>

    </ul>
</div>
