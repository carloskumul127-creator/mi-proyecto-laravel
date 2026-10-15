@props([
    'label',
    'used',
    'limit',
    'unit' => '',
    'tone' => 'primary',
    'inverted' => false,
])

@php
    $percentage = $limit > 0 ? min(100, round(($used / $limit) * 100)) : 0;
    $barClasses = [
        'primary' => $inverted ? 'bg-primary-fixed' : 'bg-primary-container',
        'warning' => $inverted ? 'bg-secondary-fixed-dim' : 'bg-secondary-container',
        'error' => 'bg-error',
    ][$tone] ?? 'bg-primary-container';
    $labelClass = $inverted ? 'text-on-primary' : 'text-on-surface';
    $detailClass = $inverted ? 'text-on-primary-container' : 'text-on-surface-variant';
    $trackClass = $inverted ? 'bg-on-primary/20' : 'bg-surface-container';
@endphp

<div {{ $attributes }}>
    <div class="flex flex-wrap items-end justify-between gap-2">
        <p class="text-label-md {{ $labelClass }}">{{ $label }}</p>
        <p class="text-body-sm {{ $detailClass }}"><span class="text-label-md {{ $labelClass }}">{{ number_format($used) }}{{ $unit }}</span> / {{ number_format($limit) }}{{ $unit }}</p>
    </div>
    <div class="mt-2 h-2 overflow-hidden rounded-full {{ $trackClass }}" role="progressbar" aria-label="{{ $label }}" aria-valuemin="0" aria-valuemax="{{ $limit }}" aria-valuenow="{{ $used }}">
        <div class="h-full rounded-full {{ $barClasses }}" style="width: {{ $percentage }}%"></div>
    </div>
    <p class="mt-1.5 text-label-sm {{ $detailClass }}">{{ $percentage }}% del límite mensual utilizado</p>
</div>