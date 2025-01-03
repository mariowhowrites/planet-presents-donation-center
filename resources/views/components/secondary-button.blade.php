@props(['type' => 'button', 'href' => ''])

@php
$baseClasses = 'inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 tracking-widest shadow-sm hover:shadow-lg hover:bg-gray-50 active:bg-gray-200 active:shadow-none focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:ring-0 disabled:opacity-25 transition ease-in-out duration-150';
@endphp

@if ($type === 'link')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $baseClasses]) }}>
        {{ $slot }}
    </button>
@endif
