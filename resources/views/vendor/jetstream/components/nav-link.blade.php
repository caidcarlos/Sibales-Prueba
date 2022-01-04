@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 font-bold border-black text-lg font-medium leading-5 text-white focus:outline-none transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 font-bold border-transparent text-lg font-medium leading-5 text-white hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
