@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $variantClasses = $variant === 'secondary'
        ? 'border border-outline-variant bg-surface-container-lowest text-on-surface hover:bg-surface-container-low focus-visible:ring-outline'
        : 'bg-primary-container text-on-primary hover:bg-primary focus-visible:ring-primary';
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'inline-flex min-h-12 items-center justify-center gap-2 rounded-md px-5 py-3 text-label-lg shadow-sm transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 ' . $variantClasses]) }}
>
    {{ $slot }}
</button>