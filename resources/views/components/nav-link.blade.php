@props(['href', 'active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2 text-[#6C244C] font-medium leading-5 bg-gray-200 dark:bg-gray-700 rounded-lg' // Active state: light gray background, specific text color
            : 'flex items-center px-4 py-2 text-gray-700 hover:text-[#6C244C] hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 rounded-lg'; // Default state: no background, hover background
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} href="{{ $href }}">
    {{ $slot }}
</a>
