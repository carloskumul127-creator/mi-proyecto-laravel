@props([
    'plan',
    'activePlan',
])

@php
    $isActive = $plan['name'] === $activePlan;
@endphp

<article @class([
    'relative flex h-full flex-col rounded-lg border bg-surface-container-lowest p-5 shadow-sm transition',
    'border-primary-container ring-2 ring-primary-container/15' => $isActive,
    'border-outline-variant' => ! $isActive,
])>
    @if ($isActive)
        <span class="absolute -top-3 right-4 rounded-full bg-primary-container px-3 py-1 text-label-sm text-on-primary">Plan actual</span>
    @endif

    <div>
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="font-display text-headline-sm text-on-surface">{{ $plan['name'] }}</h3>
                <p class="mt-1 text-body-sm text-on-surface-variant">{{ $plan['description'] }}</p>
            </div>
            @if ($isActive)
                <span class="rounded-md bg-primary-fixed p-2 text-on-primary-fixed-variant" aria-hidden="true">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
                </span>
            @endif
        </div>

        <p class="mt-5 font-display text-headline-lg text-on-surface">${{ number_format($plan['price']) }} <span class="font-sans text-body-sm font-normal text-on-surface-variant">MXN / mes</span></p>
        <ul class="mt-5 flex-1 space-y-3 border-t border-outline-variant pt-4">
            @foreach ($plan['features'] as $feature)
                <li class="flex items-start gap-2 text-body-sm text-on-surface-variant">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-primary-container" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
                    <span>{{ $feature }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    @if ($isActive)
        <x-action-button type="button" variant="secondary" class="mt-6 w-full" disabled>Plan activo</x-action-button>
    @else
        <x-action-button type="button" class="mt-6 w-full">{{ $plan['action'] }}</x-action-button>
    @endif
</article>