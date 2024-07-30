@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#dc9a35] text-sm leading-5 text-[#dc9a35]'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-[#b9c9b8] hover:text-[#dc9a35] hover:border-[#dc9a35] focus:outline-none focus:text-[#dc9a35] focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
