@props([
    'event',
    'last' => false,
])

@php
    $state = $event['state'];
    $stateLabel = [
        'completed' => 'Completado',
        'active' => 'En curso',
        'pending' => 'Pendiente',
    ][$state] ?? 'Pendiente';

    $markerClasses = [
        'completed' => 'border-primary-container bg-primary-container text-on-primary',
        'active' => 'border-primary-container bg-primary-fixed text-on-primary-fixed-variant ring-4 ring-primary-container/10',
        'pending' => 'border-outline-variant bg-surface-container-lowest text-on-surface-variant',
    ][$state] ?? 'border-outline-variant bg-surface-container-lowest text-on-surface-variant';

    $lineClasses = $state === 'completed' ? 'bg-primary-container' : 'bg-outline-variant';
    $labelClasses = $state === 'active' ? 'bg-primary-fixed text-on-primary-fixed-variant' : 'bg-surface-container text-on-surface-variant';
@endphp

<li class="relative flex gap-4 pb-7 last:pb-0">
    @unless ($last)
        <span class="absolute left-[15px] top-8 h-[calc(100%-1rem)] w-px {{ $lineClasses }}" aria-hidden="true"></span>
    @endunless
    <span class="relative z-10 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border {{ $markerClasses }}" aria-hidden="true">
        @if ($state === 'completed')
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
        @elseif ($state === 'active')
            <span class="h-2.5 w-2.5 rounded-full bg-current"></span>
        @else
            <span class="h-2 w-2 rounded-full bg-current"></span>
        @endif
    </span>
    <div class="min-w-0 flex-1 pt-0.5">
        <div class="flex flex-wrap items-start justify-between gap-x-3 gap-y-1">
            <h3 class="text-label-md text-on-surface">{{ $event['title'] }}</h3>
            <span class="rounded-full px-2 py-0.5 text-label-sm {{ $labelClasses }}">{{ $stateLabel }}</span>
        </div>
        <p class="mt-1 text-body-sm text-on-surface-variant">{{ $event['description'] }}</p>
        <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-label-sm text-on-surface-variant">
            <span class="inline-flex items-center gap-1.5"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z"/><circle cx="12" cy="10" r="2"/></svg>{{ $event['location'] }}</span>
            <time datetime="{{ $event['datetime'] }}">{{ $event['date'] }} · {{ $event['time'] }}</time>
        </div>
    </div>
</li>