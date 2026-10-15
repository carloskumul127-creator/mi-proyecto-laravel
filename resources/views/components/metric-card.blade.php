@props([
    'title',
    'value',
    'change',
    'tone' => 'info',
    'icon' => 'document',
])

@php
    $toneClasses = [
        'error' => 'bg-error-container text-on-error-container',
        'warning' => 'bg-secondary-fixed text-on-secondary-fixed-variant',
        'success' => 'bg-primary-fixed text-on-primary-fixed-variant',
        'info' => 'bg-surface-container text-on-surface-variant',
    ][$tone] ?? 'bg-surface-container text-on-surface-variant';

    $changeClasses = [
        'error' => 'text-error',
        'warning' => 'text-on-secondary-fixed-variant',
        'success' => 'text-primary-container',
        'info' => 'text-on-surface-variant',
    ][$tone] ?? 'text-on-surface-variant';
@endphp

<article {{ $attributes->merge(['class' => 'min-w-0 rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm sm:p-5']) }}>
    <div class="flex items-start justify-between gap-3">
        <p class="text-label-md text-on-surface-variant">{{ $title }}</p>
        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md {{ $toneClasses }}" aria-hidden="true">
            @if ($icon === 'check')
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
            @elseif ($icon === 'alert')
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.8 19h18.4L12 3Z"/><path stroke-linecap="round" d="M12 9v4m0 3h.01"/></svg>
            @elseif ($icon === 'currency')
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m4-14H9.5a3 3 0 0 0 0 6h5a3 3 0 0 1 0 6H7"/></svg>
            @else
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l4 4v13H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5v5h5M9 13h6m-6 3.5h6"/></svg>
            @endif
        </span>
    </div>
    <p class="mt-4 font-display text-headline-lg text-on-surface">{{ $value }}</p>
    <p class="mt-2 flex items-center gap-1.5 text-body-sm {{ $changeClasses }}">
        @if ($tone === 'success')
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m6 14 6-6 6 6"/></svg>
        @elseif ($tone === 'error')
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m6 10 6 6 6-6"/></svg>
        @endif
        {{ $change }}
    </p>
</article>