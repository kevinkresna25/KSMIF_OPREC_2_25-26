@props(['variant' => 'submit', 'type' => 'button', 'href' => null])

@php
$classes = match($variant) {
    'submit' => 'bg-btn-submit text-white hover:brightness-110',
    'info' => 'bg-btn-info text-white hover:brightness-110',
    'solved' => 'text-white hover:brightness-110 bg-btn-solved/40',
    'danger' => 'bg-btn-danger text-white hover:brightness-110',
    'success' => 'bg-btn-success text-white hover:brightness-110',
    'outlined' => 'bg-transparent text-text-default border-2 border-border-default hover:bg-border-default/20 hover:border-text-default',
    default => 'bg-btn-submit text-white hover:brightness-110',
};

$baseClasses = 'px-6 py-2 font-raleway font-semibold uppercase tracking-widest rounded-none transition-all duration-300 inline-flex items-center justify-center gap-2';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $classes"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses $classes"]) }}>
        {{ $slot }}
    </button>
@endif
