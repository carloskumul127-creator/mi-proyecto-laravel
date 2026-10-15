@props([
    'severity' => 'info',
    'title',
    'description',
    'reference',
    'company',
    'time',
])

@php
    $severityClasses = [
        'error' => [
            'border-l-error bg-error-container/40 text-error',
            'bg-error-container text-on-error-container',
            'Crítica',
        ],
        'warning' => [
            'border-l-secondary bg-secondary-fixed/45 text-on-secondary-fixed-variant',
            'bg-secondary-fixed text-on-secondary-fixed-variant',
            'Atención',
        ],
        'success' => [
            'border-l-primary-container bg-primary-fixed/45 text-primary-container',
            'bg-primary-fixed text-on-primary-fixed-variant',
            'Resuelta',
        ],
        'info' => [
            'border-l-outline bg-surface-container text-on-surface-variant',
            'bg-surface-variant text-on-surface-variant',
            'Informativa',
        ],
    ][$severity] ?? [
        'border-l-outline bg-surface-container text-on-surface-variant',
        'bg-surface-variant text-on-surface-variant',
        'Informativa',
    ];
@endphp

<article {{ $attributes->merge(['class' => 'flex gap-3 border-l-2 px-4 py-3 ' . $severityClasses[0]]) }}>
    <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full {{ $severityClasses[1] }}" aria-hidden="true">
        @if ($severity === 'error' || $severity === 'warning')
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.8 19h18.4L12 3Z"/><path stroke-linecap="round" d="M12 9v4m0 3h.01"/></svg>
        @elseif ($severity === 'success')
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
        @else
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 11v5m0-8h.01"/></svg>
        @endif
    </span>
    <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
            <h3 class="text-label-md text-on-surface">{{ $title }}</h3>
            <span class="rounded-sm px-1.5 py-0.5 text-label-sm {{ $severityClasses[1] }}">{{ $severityClasses[2] }}</span>
        </div>
        <p class="mt-1 text-body-sm text-on-surface-variant">{{ $description }}</p>
        <div class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1 text-label-sm text-on-surface-variant">
            <span>{{ $company }}</span>
            <span aria-hidden="true">·</span>
            <span>{{ $reference }}</span>
            <span aria-hidden="true">·</span>
            <time>{{ $time }}</time>
        </div>
    </div>
</article>