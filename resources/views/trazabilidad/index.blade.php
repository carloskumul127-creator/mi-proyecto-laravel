@extends('layouts.app')

@section('title', 'Trazabilidad End-to-End | SIRA')

@section('content')
    @php
        $eventos = [
            ['title' => 'Residuo generado', 'description' => 'Se clasificó y registró el residuo peligroso en origen.', 'location' => 'Química del Bajío · León, Guanajuato', 'date' => '08 oct 2026', 'time' => '08:35', 'datetime' => '2026-10-08T08:35:00-06:00', 'state' => 'completed'],
            ['title' => 'Recolección confirmada', 'description' => 'El transportista autorizado recibió el manifiesto y la carga.', 'location' => 'Almacén temporal · León, Guanajuato', 'date' => '09 oct 2026', 'time' => '10:12', 'datetime' => '2026-10-09T10:12:00-06:00', 'state' => 'completed'],
            ['title' => 'En tránsito a planta', 'description' => 'Traslado registrado con seguimiento y documentación vigentes.', 'location' => 'Ruta federal 45 · Guanajuato', 'date' => '10 oct 2026', 'time' => '06:48', 'datetime' => '2026-10-10T06:48:00-06:00', 'state' => 'completed'],
            ['title' => 'En planta de tratamiento', 'description' => 'Recepción confirmada; tratamiento y validación documental en proceso.', 'location' => 'Planta Norte · San Luis Potosí', 'date' => '13 oct 2026', 'time' => '11:24', 'datetime' => '2026-10-13T11:24:00-06:00', 'state' => 'active'],
            ['title' => 'Disposición final', 'description' => 'Se registrará el certificado al completar el tratamiento autorizado.', 'location' => 'Destino autorizado · San Luis Potosí', 'date' => 'Estimado: 15 oct 2026', 'time' => 'Pendiente', 'datetime' => '2026-10-15', 'state' => 'pending'],
        ];

        $hitos = [
            ['label' => 'Generado', 'date' => '08 oct', 'state' => 'completed'],
            ['label' => 'Recolectado', 'date' => '09 oct', 'state' => 'completed'],
            ['label' => 'Tratamiento', 'date' => 'En curso', 'state' => 'active'],
            ['label' => 'Disposición', 'date' => 'Pendiente', 'state' => 'pending'],
        ];

        $estadoActual = 'En planta de tratamiento';
    @endphp

    <div class="min-h-screen bg-background lg:grid lg:grid-cols-[15rem_minmax(0,1fr)]">
        <x-app-sidebar />

        <div class="min-w-0">
            <header class="flex h-16 items-center justify-between gap-4 border-b border-outline-variant bg-surface-container-lowest px-4 sm:px-6 lg:px-8">
                <div class="flex min-w-0 flex-1 items-center gap-3"><span class="font-display text-label-lg text-primary-container lg:hidden">SIRA</span><label class="relative hidden max-w-xl flex-1 md:block"><span class="sr-only">Buscar en SIRA</span><svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-on-surface-variant" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path stroke-linecap="round" d="m16 16 4.5 4.5"/></svg><input type="search" placeholder="Buscar manifiesto o punto de control..." class="h-10 w-full rounded-md border border-outline-variant bg-surface-container-low py-2 pl-10 pr-3 text-body-sm text-on-surface placeholder:text-on-surface-variant focus:border-primary-container focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary-container/15"></label></div>
                <div class="flex shrink-0 items-center gap-2 sm:gap-4"><button type="button" class="relative rounded-md p-2 text-on-surface-variant hover:bg-surface-container-low" aria-label="Notificaciones"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg></button><span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-fixed text-label-md text-on-primary-fixed-variant">{{ mb_substr(auth()->user()->name, 0, 1) }}</span><span class="hidden max-w-36 truncate text-label-md text-on-surface sm:inline">{{ auth()->user()->name }}</span></div>
            </header>

            <main class="mx-auto max-w-[1600px] space-y-5 px-4 py-5 sm:px-6 lg:px-8 lg:py-7">
                <div class="flex flex-col justify-between gap-4 xl:flex-row xl:items-end">
                    <div><p class="text-label-sm text-primary-container">SIRA / OPERACIONES / TRAZABILIDAD</p><h1 class="mt-1 font-display text-headline-lg text-on-surface sm:text-display-lg-mobile">Trazabilidad del Residuo End-to-End</h1><p class="mt-2 max-w-3xl text-body-md text-on-surface-variant">Sigue cada etapa del residuo desde su generación hasta la disposición final autorizada.</p></div>
                    <div class="flex flex-wrap items-center gap-2"><x-action-button variant="secondary" type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m-4-4 4 4 4-4M5 16v4h14v-4"/></svg>Exportar reporte</x-action-button><x-action-button type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/></svg>Nuevo seguimiento</x-action-button></div>
                </div>

                <section class="grid gap-3 rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm md:grid-cols-[minmax(15rem,1.2fr)_minmax(12rem,0.8fr)_minmax(12rem,0.8fr)_auto] md:items-end" aria-label="Filtros de trazabilidad">
                    <label class="block"><span class="mb-1.5 block text-label-sm text-on-surface-variant">MANIFIESTO</span><select class="h-10 w-full rounded-md border border-outline-variant bg-surface-container-low px-3 text-body-sm text-on-surface focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-primary-container/15"><option>MAN-2026-00145 · Solventes orgánicos</option><option>MAN-2026-00142 · Lodos industriales</option></select></label>
                    <label class="block"><span class="mb-1.5 block text-label-sm text-on-surface-variant">PERIODO</span><select class="h-10 w-full rounded-md border border-outline-variant bg-surface-container-low px-3 text-body-sm text-on-surface focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-primary-container/15"><option>Últimos 30 días</option><option>Últimos 90 días</option><option>Este año</option></select></label>
                    <label class="block"><span class="mb-1.5 block text-label-sm text-on-surface-variant">ESTADO ACTUAL</span><div class="flex h-10 items-center gap-2 rounded-md border border-outline-variant bg-surface-container-low px-3 text-body-sm text-on-surface"><span class="h-2 w-2 rounded-full bg-primary-container"></span>{{ $estadoActual }}</div></label>
                    <x-action-button variant="secondary" type="button" class="min-h-10 py-2"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M7 12h10m-7 6h4"/></svg>Filtrar</x-action-button>
                </section>

                <section class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm sm:p-5" aria-label="Progreso del ciclo de vida">
                    <div class="mb-4 flex flex-wrap items-center justify-between gap-2"><p class="text-label-md text-on-surface">Ciclo de vida del manifiesto <span class="ml-1 text-primary-container">MAN-2026-00145</span></p><x-status-badge status="En planta de tratamiento" tone="info" /></div>
                    <ol class="grid gap-4 sm:grid-cols-4">
                        @foreach ($hitos as $hito)
                            @php
                                $hitoClasses = [
                                    'completed' => ['bg-primary-container text-on-primary', 'text-primary-container'],
                                    'active' => ['bg-primary-fixed text-on-primary-fixed-variant ring-4 ring-primary-container/10', 'text-primary-container'],
                                    'pending' => ['bg-surface-container text-on-surface-variant', 'text-on-surface-variant'],
                                ][$hito['state']];
                            @endphp
                            <li class="flex items-center gap-3 sm:flex-col sm:items-start sm:gap-2">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $hitoClasses[0] }}" aria-hidden="true">
                                    @if ($hito['state'] === 'completed')
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
                                    @else
                                        <span class="h-2.5 w-2.5 rounded-full bg-current"></span>
                                    @endif
                                </span>
                                <span><span class="block text-label-md {{ $hitoClasses[1] }}">{{ $hito['label'] }}</span><span class="mt-0.5 block text-body-sm text-on-surface-variant">{{ $hito['date'] }}</span></span>
                            </li>
                        @endforeach
                    </ol>
                </section>

                <div class="grid gap-5 xl:grid-cols-[minmax(0,1.08fr)_minmax(25rem,0.92fr)]">
                    <section class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm sm:p-5" aria-labelledby="timeline-title">
                        <div class="mb-5 flex flex-wrap items-start justify-between gap-3"><div><h2 id="timeline-title" class="font-display text-headline-sm text-on-surface">Historial de eventos</h2><p class="mt-1 text-body-sm text-on-surface-variant">Registro cronológico con evidencias de cada etapa.</p></div><span class="text-label-sm text-on-surface-variant">5 ETAPAS</span></div>
                        <ol>
                            @foreach ($eventos as $evento)
                                <x-timeline-item :event="$evento" :last="$loop->last" />
                            @endforeach
                        </ol>
                    </section>

                    <div class="space-y-5">
                        <section class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm sm:p-5" aria-labelledby="manifest-summary-title">
                            <div class="flex items-start justify-between gap-3 border-b border-outline-variant pb-4"><div><p class="text-label-sm text-primary-container">MANIFIESTO DE RESIDUO PELIGROSO</p><h2 id="manifest-summary-title" class="mt-1 font-display text-headline-sm text-on-surface">MAN-2026-00145</h2></div><x-status-badge status="En curso" tone="success" /></div>
                            <dl class="grid gap-x-4 gap-y-4 py-4 sm:grid-cols-2">
                                <div><dt class="text-label-sm text-on-surface-variant">RESIDUO</dt><dd class="mt-1 text-label-md text-on-surface">Solventes orgánicos</dd><dd class="mt-0.5 text-body-sm text-on-surface-variant">CRETIB · Inflamable</dd></div>
                                <div><dt class="text-label-sm text-on-surface-variant">CANTIDAD</dt><dd class="mt-1 text-label-md text-on-surface">4,500 kg</dd></div>
                                <div><dt class="text-label-sm text-on-surface-variant">GENERADOR</dt><dd class="mt-1 text-label-md text-on-surface">Química del Bajío</dd><dd class="mt-0.5 text-body-sm text-on-surface-variant">León, Guanajuato</dd></div>
                                <div><dt class="text-label-sm text-on-surface-variant">TRANSPORTISTA</dt><dd class="mt-1 text-label-md text-on-surface">Logística Ambiental MX</dd><dd class="mt-0.5 text-body-sm text-on-surface-variant">Autorización SEMARNAT vigente</dd></div>
                                <div class="sm:col-span-2"><dt class="text-label-sm text-on-surface-variant">DESTINO AUTORIZADO</dt><dd class="mt-1 text-label-md text-on-surface">Planta Norte · San Luis Potosí</dd></div>
                            </dl>
                            <a href="{{ route('manifests.index') }}" class="inline-flex items-center gap-1.5 border-t border-outline-variant pt-3 text-label-md text-primary-container hover:underline">Ver manifiesto completo<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                        </section>

                        <section class="overflow-hidden rounded-lg border border-outline-variant bg-surface-container-lowest shadow-sm" aria-labelledby="route-title">
                            <div class="flex items-center justify-between gap-3 border-b border-outline-variant p-4 sm:px-5"><div><h2 id="route-title" class="font-display text-headline-sm text-on-surface">Ruta del residuo</h2><p class="mt-1 text-body-sm text-on-surface-variant">Recorrido registrado hasta la planta de tratamiento.</p></div><span class="rounded-full bg-primary-fixed px-2.5 py-1 text-label-sm text-on-primary-fixed-variant">En seguimiento</span></div>
                            <div class="bg-surface-container-low p-4 sm:p-5">
                                <div class="relative overflow-hidden rounded-md border border-outline-variant bg-surface-container-lowest p-4">
                                    <svg class="h-44 w-full" viewBox="0 0 560 190" role="img" aria-label="Esquema de ruta desde León hasta San Luis Potosí">
                                        <path d="M45 145 C105 130 128 61 205 80 S315 149 365 99 S433 40 510 53" fill="none" stroke="var(--color-outline-variant)" stroke-width="8" stroke-linecap="round" stroke-dasharray="2 14" />
                                        <path d="M45 145 C105 130 128 61 205 80 S315 149 365 99" fill="none" stroke="var(--color-primary-container)" stroke-width="5" stroke-linecap="round" />
                                        <circle cx="45" cy="145" r="11" fill="var(--color-primary-container)" stroke="var(--color-surface-container-lowest)" stroke-width="4" />
                                        <circle cx="205" cy="80" r="9" fill="var(--color-primary-container)" stroke="var(--color-surface-container-lowest)" stroke-width="4" />
                                        <circle cx="365" cy="99" r="12" fill="var(--color-secondary-container)" stroke="var(--color-surface-container-lowest)" stroke-width="4" />
                                        <circle cx="510" cy="53" r="10" fill="var(--color-surface-container)" stroke="var(--color-outline)" stroke-width="3" />
                                        <text x="30" y="175" fill="var(--color-on-surface-variant)" font-size="11" font-family="Inter, sans-serif">León</text>
                                        <text x="170" y="54" fill="var(--color-on-surface-variant)" font-size="11" font-family="Inter, sans-serif">Recogido</text>
                                        <text x="334" y="132" fill="var(--color-on-surface-variant)" font-size="11" font-family="Inter, sans-serif">En tratamiento</text>
                                        <text x="476" y="31" fill="var(--color-on-surface-variant)" font-size="11" font-family="Inter, sans-serif">Destino</text>
                                    </svg>
                                </div>
                                <div class="mt-3 flex flex-wrap items-center justify-between gap-2 text-body-sm"><span class="text-on-surface-variant">Distancia total <strong class="text-label-md text-on-surface">186 km</strong></span><span class="inline-flex items-center gap-1.5 text-label-md text-primary-container"><span class="h-2 w-2 rounded-full bg-primary-container"></span>Ubicación actualizada</span></div>
                            </div>
                        </section>

                        <section class="flex items-start gap-3 rounded-lg border border-secondary-fixed-dim bg-secondary-fixed/45 p-4" aria-label="Aviso de cumplimiento">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-on-secondary-fixed-variant" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.8 19h18.4L12 3Z"/><path stroke-linecap="round" d="M12 9v4m0 3h.01"/></svg>
                            <p class="text-body-sm text-on-secondary-fixed-variant"><span class="text-label-md">Próximo hito:</span> el certificado de tratamiento debe registrarse al concluir el proceso en planta.</p>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection