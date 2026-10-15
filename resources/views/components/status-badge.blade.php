@props([
    'status',
    'tone' => 'info',
])

@php
    $toneClasses = [
        'success' => 'bg-primary-fixed text-on-primary-fixed-variant',
        'warning' => 'bg-secondary-fixed text-on-secondary-fixed-variant',
        'error' => 'bg-error-container text-on-error-container',
        'info' => 'bg-surface-container text-on-surface-variant',
    ][$tone] ?? 'bg-surface-container text-on-surface-variant';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-label-sm ' . $toneClasses]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current" aria-hidden="true"></span>
    {{ $status }}
</span>