@props(['label' => null, 'name', 'type' => 'text', 'required' => false, 'error' => null])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-raleway text-text-default uppercase tracking-wider">
            &gt; {{ $label }}
            @if($required)
                <span class="text-btn-danger">*</span>
            @endif
        </label>
    @endif
    
    <input 
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-gray-200 text-gray-500 border-0 rounded-none px-4 py-3 font-lato transition-all focus:bg-transparent focus:text-text-default focus:outline-none ' . ($error ? 'invalid' : '')]) }}
        style="{{ $error ? 'box-shadow: 0 0 0 0.1rem #d46767;' : '' }}"
    >
    
    @if($error)
        <p class="text-sm text-btn-danger font-raleway">{{ $error }}</p>
    @endif
</div>

