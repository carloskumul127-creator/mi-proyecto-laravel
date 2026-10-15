@props([
    'id' => null,
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'autocomplete' => null,
])

@php
    $inputId = $id ?? $name;
    $inputClasses = 'block w-full rounded-md border border-transparent bg-surface-container-low py-3 pl-11 pr-11 text-body-md text-on-surface placeholder:text-on-surface-variant transition focus:border-primary-container focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary-container/15';

    if ($errors->has($name)) {
        $inputClasses .= ' border-error focus:border-error focus:ring-error/15';
    }
@endphp

<div>
    <label for="{{ $inputId }}" class="block text-label-lg text-on-surface">
        {{ $label }}
    </label>
    <div class="relative mt-2">
        @isset($leading)
            <span class="pointer-events-none absolute inset-y-0 left-0 flex w-11 items-center justify-center text-on-surface-variant" aria-hidden="true">
                {{ $leading }}
            </span>
        @endisset
        <input
            id="{{ $inputId }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if ($errors->has($name)) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
            {{ $attributes->merge(['class' => $inputClasses]) }}
        >
        @isset($trailing)
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                {{ $trailing }}
            </span>
        @endisset
    </div>
    @error($name)
        <p id="{{ $inputId }}-error" class="mt-1.5 text-label-sm text-error">{{ $message }}</p>
    @enderror
</div>