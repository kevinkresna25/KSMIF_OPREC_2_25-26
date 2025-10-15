@props(['type' => 'info'])

@php
$classes = match($type) {
    'success' => 'bg-btn-success/20 border-btn-success/50 text-btn-success',
    'error', 'danger' => 'bg-btn-danger/20 border-btn-danger/50 text-btn-danger',
    'warning' => 'bg-yellow-500/20 border-yellow-500/50 text-yellow-300',
    'info' => 'bg-btn-info/20 border-btn-info/50 text-btn-info',
    default => 'bg-btn-info/20 border-btn-info/50 text-btn-info',
};
@endphp

<div {{ $attributes->merge(['class' => "border-2 rounded-none p-4 font-raleway $classes"]) }}>
    {{ $slot }}
</div>
