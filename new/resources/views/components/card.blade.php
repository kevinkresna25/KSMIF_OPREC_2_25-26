@props(['title' => null, 'challenge' => false, 'solved' => false])

@php
$classes = $challenge 
    ? ($solved 
        ? 'bg-bg-card rounded-none p-6 border border-btn-solved/50 hover:border-btn-solved transition-all' 
        : 'bg-bg-card rounded-none p-6 border border-white/10 hover:border-btn-info/50 transition-all')
    : 'bg-bg-card rounded-none p-6 border border-white/5';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if($title)
        <h3 class="font-pixel text-xs {{ $solved ? 'text-btn-solved' : 'text-text-glow' }} pixel-glow mb-4 uppercase">
            {{ $title }}
        </h3>
    @endif
    
    {{ $slot }}
</div>
