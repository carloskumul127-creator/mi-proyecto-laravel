@props(['status'])

@php
    $statusClasses = [
        'Pagado' => 'bg-primary-fixed text-on-primary-fixed-variant',
        'Pendiente' => 'bg-secondary-fixed text-on-secondary-fixed-variant',
        'Vencido' => 'bg-error-container text-on-error-container',
        'En proceso' => 'bg-surface-container text-on-surface-variant',
    ][$status] ?? 'bg-surface-container text-on-surface-variant';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-label-sm ' . $statusClasses]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current" aria-hidden="true"></span>
    {{ $status }}
</span>