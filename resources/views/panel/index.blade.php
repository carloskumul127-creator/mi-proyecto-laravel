@extends('layouts.app')

@section('title', 'Panel de control | SIRA')

@section('content')
    @php
        $metricas = [
            ['title' => 'Manifiestos activos', 'value' => '142', 'change' => '+12.4% respecto al mes anterior', 'tone' => 'success', 'icon' => 'document'],
            ['title' => 'Trazabilidad completa', 'value' => '98.4%', 'change' => '+2.1% respecto al mes anterior', 'tone' => 'success', 'icon' => 'check'],
            ['title' => 'Alertas ambientales abiertas', 'value' => '3', 'change' => '1 requiere atención inmediata', 'tone' => 'error', 'icon' => 'alert'],
            ['title' => 'Valor de residuos gestionados', 'value' => '$84,500', 'change' => 'MXN · últimos 30 días', 'tone' => 'info', 'icon' => 'currency'],
        ];

        $alertas_recientes = [
            ['severity' => 'error', 'title' => 'Manifiesto con plazo vencido', 'description' => 'La confirmación de recepción excedió el tiempo establecido.', 'reference' => 'MAN-2026-00138', 'company' => 'Industrias del Norte', 'time' => 'Hace 12 min'],
            ['severity' => 'warning', 'title' => 'Manifiesto próximo a vencer', 'description' => 'La fecha límite de recepción vence dentro de 48 horas.', 'reference' => 'MAN-2026-00142', 'company' => 'Química del Bajío', 'time' => 'Hace 38 min'],
            ['severity' => 'info', 'title' => 'Nueva actualización de trazabilidad', 'description' => 'El transportista registró un nuevo punto de control.', 'reference' => 'MAN-2026-00145', 'company' => 'EcoTratamientos MX', 'time' => 'Hace 1 h'],
            ['severity' => 'success', 'title' => 'Recepción confirmada', 'description' => 'El destino final validó el tratamiento del residuo.', 'reference' => 'MAN-2026-00131', 'company' => 'Reciclados del Centro', 'time' => 'Hace 2 h'],
        ];

        $manifiestos_recientes = [
            ['id' => 'MAN-2026-00145', 'empresa' => 'EcoTratamientos MX', 'residuo' => 'Solventes orgánicos', 'destino' => 'Planta de tratamiento Norte', 'estado' => 'En tránsito', 'nivel' => 'info', 'fecha' => 'Hoy, 10:42'],
            ['id' => 'MAN-2026-00142', 'empresa' => 'Química del Bajío', 'residuo' => 'Lodos industriales', 'destino' => 'Centro de confinamiento 04', 'estado' => 'Pendiente', 'nivel' => 'warning', 'fecha' => 'Hoy, 09:18'],
            ['id' => 'MAN-2026-00138', 'empresa' => 'Industrias del Norte', 'residuo' => 'Aceites contaminados', 'destino' => 'Gestora Ambiental MX', 'estado' => 'Vencido', 'nivel' => 'error', 'fecha' => 'Ayer, 16:35'],
            ['id' => 'MAN-2026-00131', 'empresa' => 'Reciclados del Centro', 'residuo' => 'Envases contaminados', 'destino' => 'Recuperadora Central', 'estado' => 'Completado', 'nivel' => 'success', 'fecha' => 'Ayer, 14:07'],
        ];

        $estadoClasses = [
            'error' => 'bg-error-container text-on-error-container',
            'warning' => 'bg-secondary-fixed text-on-secondary-fixed-variant',
            'success' => 'bg-primary-fixed text-on-primary-fixed-variant',
            'info' => 'bg-surface-variant text-on-surface-variant',
        ];
    @endphp

    <div class="min-h-screen bg-background lg:grid lg:grid-cols-[15rem_minmax(0,1fr)]">
        <x-app-sidebar />

        <div class="min-w-0">
            <header class="flex h-16 items-center justify-between gap-4 border-b border-outline-variant bg-surface-container-lowest px-4 sm:px-6 lg:px-8">
                <div class="flex min-w-0 flex-1 items-center gap-3">
                    <span class="font-display text-label-lg text-primary-container lg:hidden">SIRA</span>
                    <label class="relative hidden max-w-xl flex-1 md:block">
                        <span class="sr-only">Buscar manifiestos</span>
                        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-on-surface-variant" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path stroke-linecap="round" d="m16 16 4.5 4.5"/></svg>
                        <input type="search" placeholder="Buscar manifiestos, empresas o residuos..." class="h-10 w-full rounded-md border border-outline-variant bg-surface-container-low py-2 pl-10 pr-3 text-body-sm text-on-surface placeholder:text-on-surface-variant focus:border-primary-container focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary-container/15">
                    </label>
                </div>
                <div class="flex shrink-0 items-center gap-2 sm:gap-4">
                    <button type="button" class="relative rounded-md p-2 text-on-surface-variant hover:bg-surface-container-low" aria-label="Notificaciones"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg><span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-error"></span></button>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-fixed text-label-md text-on-primary-fixed-variant">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                    <span class="hidden max-w-36 truncate text-label-md text-on-surface sm:inline">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <main class="mx-auto max-w-[1600px] space-y-5 px-4 py-5 sm:px-6 lg:px-8 lg:py-7">
                <div class="flex flex-col justify-between gap-4 xl:flex-row xl:items-end">
                    <div><p class="text-label-sm text-primary-container">SIRA / OPERACIONES</p><h1 class="mt-1 font-display text-headline-lg text-on-surface sm:text-display-lg-mobile">Panel de Control y Trazabilidad Operativa</h1><p class="mt-2 text-body-md text-on-surface-variant">Monitoreo de manifiestos, cumplimiento y actividad ambiental.</p></div>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-action-button variant="secondary" type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path stroke-linecap="round" d="M7.5 3v4m9-4v4M3.5 9h17"/></svg>Este mes</x-action-button>
                        <x-action-button type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M12 5v14m-7-7h14"/></svg>Nuevo manifiesto</x-action-button>
                    </div>
                </div>

                <section class="overflow-hidden rounded-lg border border-secondary-fixed-dim bg-secondary-fixed/50 shadow-sm" aria-label="Alerta prioritaria">
                    <div class="flex flex-col gap-3 border-l-4 border-l-secondary px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-5">
                        <div class="flex items-start gap-3"><span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-secondary-fixed text-on-secondary-fixed-variant"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.8 19h18.4L12 3Z"/><path stroke-linecap="round" d="M12 9v4m0 3h.01"/></svg></span><div><p class="text-label-md text-on-secondary-fixed-variant">3 manifiestos requieren atención próxima</p><p class="mt-1 text-body-sm text-on-surface-variant">Hay fechas límite y confirmaciones pendientes en los próximos 15 días.</p></div></div>
                        <a href="#alertas" class="inline-flex shrink-0 items-center gap-2 text-label-md text-on-secondary-fixed-variant hover:underline">Revisar alertas<svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                    </div>
                </section>

                <section class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4" aria-label="Indicadores principales">
                    @foreach ($metricas as $metrica)
                        <x-metric-card :title="$metrica['title']" :value="$metrica['value']" :change="$metrica['change']" :tone="$metrica['tone']" :icon="$metrica['icon']" />
                    @endforeach
                </section>

                <section class="grid gap-5 xl:grid-cols-[minmax(0,1.55fr)_minmax(19rem,0.85fr)]">
                    <section class="min-w-0 overflow-hidden rounded-lg border border-outline-variant bg-surface-container-lowest shadow-sm" aria-labelledby="manifestos-title">
                        <div class="flex flex-col justify-between gap-3 border-b border-outline-variant p-4 sm:flex-row sm:items-center sm:px-5">
                            <div><h2 id="manifestos-title" class="font-display text-headline-sm text-on-surface">Manifiestos recientes</h2><p class="mt-1 text-body-sm text-on-surface-variant">Seguimiento de los últimos movimientos registrados.</p></div>
                            <a href="#manifiestos" class="text-label-md text-primary-container hover:underline">Ver todos</a>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 border-b border-outline-variant px-4 py-3 sm:px-5">
                            <label class="relative min-w-52 flex-1"><span class="sr-only">Filtrar manifiestos</span><svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-on-surface-variant" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path stroke-linecap="round" d="m16 16 4.5 4.5"/></svg><input type="search" placeholder="Filtrar por empresa o residuo" class="h-9 w-full rounded-md border border-outline-variant bg-surface-container-low px-3 pl-9 text-body-sm text-on-surface placeholder:text-on-surface-variant focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-primary-container/15"></label>
                            <button type="button" class="inline-flex h-9 items-center gap-2 rounded-md border border-outline-variant px-3 text-label-md text-on-surface-variant hover:bg-surface-container-low"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M7 12h10m-7 6h4"/></svg>Filtros</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[720px] text-left">
                                <thead class="bg-surface-container-low text-label-sm text-on-surface-variant"><tr><th class="px-4 py-3 font-medium sm:px-5">Manifiesto</th><th class="px-4 py-3 font-medium">Residuo / destino</th><th class="px-4 py-3 font-medium">Estado</th><th class="px-4 py-3 font-medium">Actualización</th><th class="px-4 py-3"><span class="sr-only">Acciones</span></th></tr></thead>
                                <tbody class="divide-y divide-outline-variant text-body-sm">
                                    @foreach ($manifiestos_recientes as $manifiesto)
                                        <tr class="hover:bg-surface-container-low/60">
                                            <td class="px-4 py-3.5 sm:px-5"><a href="#{{ $manifiesto['id'] }}" class="text-label-md text-primary-container hover:underline">{{ $manifiesto['id'] }}</a><span class="mt-1 block text-on-surface-variant">{{ $manifiesto['empresa'] }}</span></td>
                                            <td class="px-4 py-3.5"><span class="block text-label-md text-on-surface">{{ $manifiesto['residuo'] }}</span><span class="mt-1 block max-w-48 truncate text-on-surface-variant">{{ $manifiesto['destino'] }}</span></td>
                                            <td class="px-4 py-3.5"><span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-label-sm {{ $estadoClasses[$manifiesto['nivel']] }}">{{ $manifiesto['estado'] }}</span></td>
                                            <td class="whitespace-nowrap px-4 py-3.5 text-on-surface-variant">{{ $manifiesto['fecha'] }}</td>
                                            <td class="px-4 py-3.5"><button type="button" class="rounded-md p-1.5 text-on-surface-variant hover:bg-surface-container" aria-label="Más opciones para {{ $manifiesto['id'] }}"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col justify-between gap-2 border-t border-outline-variant px-4 py-3 text-body-sm text-on-surface-variant sm:flex-row sm:items-center sm:px-5"><span>Mostrando 4 de 142 manifiestos activos</span><a href="#manifiestos" class="text-label-md text-primary-container hover:underline">Ver listado completo</a></div>
                    </section>

                    <section id="alertas" class="min-w-0 rounded-lg border border-outline-variant bg-surface-container-lowest shadow-sm" aria-labelledby="alerts-title">
                        <div class="flex items-center justify-between gap-3 border-b border-outline-variant p-4 sm:px-5"><div><h2 id="alerts-title" class="font-display text-headline-sm text-on-surface">Alertas recientes</h2><p class="mt-1 text-body-sm text-on-surface-variant">Eventos que pueden requerir seguimiento.</p></div><span class="rounded-full bg-error-container px-2.5 py-1 text-label-sm text-on-error-container">3 abiertas</span></div>
                        <div class="divide-y divide-outline-variant">
                            @foreach ($alertas_recientes as $alerta)
                                <x-alert-item :severity="$alerta['severity']" :title="$alerta['title']" :description="$alerta['description']" :reference="$alerta['reference']" :company="$alerta['company']" :time="$alerta['time']" />
                            @endforeach
                        </div>
                        <div class="border-t border-outline-variant p-4 text-center"><a href="#alertas" class="text-label-md text-primary-container hover:underline">Ver centro de alertas</a></div>
                    </section>
                </section>
            </main>
        </div>
    </div>
@endsection