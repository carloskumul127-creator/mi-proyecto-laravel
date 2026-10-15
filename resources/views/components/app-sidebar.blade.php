@php
    $navigationGroups = [
        [
            'label' => 'MENÚ PRINCIPAL',
            'items' => [
                ['label' => 'Panel de control', 'route' => 'dashboard.index', 'active' => 'dashboard*', 'icon' => 'dashboard'],
                ['label' => 'Manifiestos', 'route' => 'manifests.index', 'active' => 'manifests.*', 'icon' => 'document'],
                ['label' => 'Trazabilidad', 'route' => 'traceability.index', 'active' => 'traceability.*', 'icon' => 'trace'],
                ['label' => 'Empresas', 'route' => 'companies.index', 'active' => 'companies.*', 'icon' => 'company'],
            ],
        ],
        [
            'label' => 'ADMINISTRACIÓN',
            'items' => [
                ['label' => 'Facturación y lotes', 'route' => 'billing.index', 'active' => 'billing.*', 'icon' => 'billing'],
                ['label' => 'Configuración y plan', 'route' => 'settings.index', 'active' => 'settings.*', 'icon' => 'settings'],
            ],
        ],
        [
            'label' => 'CUENTA',
            'items' => [
                ['label' => 'Mi perfil', 'route' => 'profile.edit', 'active' => 'profile.*', 'icon' => 'profile'],
            ],
        ],
    ];
@endphp

<aside class="hidden border-r border-outline-variant bg-surface-container-lowest lg:flex lg:flex-col">
    <a href="{{ route('dashboard.index') }}" class="flex h-16 items-center gap-3 border-b border-outline-variant px-6" aria-label="SIRA, panel de control">
        <span class="flex h-9 w-9 items-center justify-center rounded-md bg-primary-container text-on-primary" aria-hidden="true">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.5-2.6-7-6.3-7-10.5V5l7-2 7 2v5.5c0 4.2-2.5 7.9-7 10.5Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.5 12.5c2.5 0 4.5-1.8 5-4.5 2.4 1.6 3.2 4 2.2 6.1-1.3 2.5-4.3 3.2-7.2 2.1"/></svg>
        </span>
        <span class="font-display text-headline-sm text-on-surface">SIRA</span>
    </a>

    <nav class="flex-1 space-y-5 px-3 py-5 text-body-md" aria-label="Navegación principal">
        @foreach ($navigationGroups as $group)
            <section aria-label="{{ $group['label'] }}">
                <p class="px-3 pb-2 text-label-sm text-on-surface-variant">{{ $group['label'] }}</p>
                <div class="space-y-1">
                    @foreach ($group['items'] as $item)
                        @php($isActive = request()->routeIs($item['active']))
                        <a href="{{ route($item['route']) }}" @class([
                            'flex items-center gap-3 rounded-md px-3 py-2.5 text-label-lg transition',
                            'bg-primary-container text-on-primary' => $isActive,
                            'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' => ! $isActive,
                        ]) @if ($isActive) aria-current="page" @endif>
                            <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                @if ($item['icon'] === 'dashboard')
                                    <rect x="3.5" y="3.5" width="7" height="7" rx="1"/><rect x="13.5" y="3.5" width="7" height="7" rx="1"/><rect x="3.5" y="13.5" width="7" height="7" rx="1"/><rect x="13.5" y="13.5" width="7" height="7" rx="1"/>
                                @elseif ($item['icon'] === 'document')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l4 4v13H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5v5h5M9 13h6m-6 3.5h6"/>
                                @elseif ($item['icon'] === 'trace')
                                    <circle cx="6" cy="7" r="2.5"/><circle cx="18" cy="17" r="2.5"/><path stroke-linecap="round" d="M8.5 7H13a3 3 0 0 1 3 3v4.5M15.5 17H11a3 3 0 0 1-3-3v-4.5"/>
                                @elseif ($item['icon'] === 'company')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 20.5h16M6 20V5.5l6-2 6 2V20M9 8h.01M15 8h.01M9 12h.01M15 12h.01M10 20v-4h4v4"/>
                                @elseif ($item['icon'] === 'billing')
                                    <rect x="4" y="3.5" width="16" height="17" rx="2"/><path stroke-linecap="round" d="M8 8h8m-8 4h8m-8 4h4"/>
                                @elseif ($item['icon'] === 'settings')
                                    <circle cx="12" cy="12" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="m19.4 15 .1.1a1.7 1.7 0 1 1-2.4 2.4l-.1-.1a1.7 1.7 0 0 0-2.9 1.2v.2a1.7 1.7 0 1 1-3.4 0v-.2A1.7 1.7 0 0 0 7.8 17l-.1.1a1.7 1.7 0 1 1-2.4-2.4l.1-.1a1.7 1.7 0 0 0-1.2-2.9H4a1.7 1.7 0 1 1 0-3.4h.2A1.7 1.7 0 0 0 5.4 6.8l-.1-.1a1.7 1.7 0 1 1 2.4-2.4l.1.1a1.7 1.7 0 0 0 2.9-1.2V3a1.7 1.7 0 1 1 3.4 0v.2A1.7 1.7 0 0 0 17 4.4l.1-.1a1.7 1.7 0 1 1 2.4 2.4l-.1.1a1.7 1.7 0 0 0 1.2 2.9h.2a1.7 1.7 0 1 1 0 3.4h-.2a1.7 1.7 0 0 0-1.2 1.9Z"/>
                                @else
                                    <circle cx="12" cy="8" r="3.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0 1 14 0"/>
                                @endif
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </nav>

    <div class="m-3 rounded-md border border-outline-variant bg-surface-container-low p-3">
        <p class="text-label-md text-on-surface">¿Necesitas ayuda?</p>
        <p class="mt-1 text-body-sm text-on-surface-variant">Contacta a la mesa de soporte SIRA.</p>
    </div>
</aside>