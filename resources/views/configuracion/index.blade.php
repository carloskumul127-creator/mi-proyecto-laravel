@extends('layouts.app')

@section('title', 'Configuración y Plan | SIRA')

@section('content')
    @php
        $plan_actual = 'Pro';
        $manifiestos_usados = 45;
        $limite_manifiestos = 100;
        $fecha_renovacion = '2026-11-01';
        $previewOnly = $previewOnly ?? false;

        $planes = [
            ['name' => 'Básico', 'description' => 'Para operaciones en crecimiento', 'price' => 500, 'action' => 'Elegir Básico', 'features' => ['Hasta 30 manifiestos por mes', 'Trazabilidad esencial', 'Soporte por correo']],
            ['name' => 'Pro', 'description' => 'Control completo para tu operación', 'price' => 900, 'action' => 'Cambiar a Pro', 'features' => ['Hasta 100 manifiestos por mes', 'Trazabilidad End-to-End', 'Reportes y exportación avanzada', 'Soporte prioritario']],
            ['name' => 'Empresarial', 'description' => 'Capacidad y control a escala', 'price' => 1500, 'action' => 'Contactar ventas', 'features' => ['Manifiestos ilimitados', 'Integraciones y acceso API', 'Múltiples centros de operación', 'Atención personalizada']],
        ];

        $preferencias = session('sira_settings', [
            'email_notifications' => '1',
            'sms_alerts' => '0',
            'monthly_digest' => '1',
            'login_alerts' => '1',
        ]);
    @endphp

    <div class="min-h-screen bg-background lg:grid lg:grid-cols-[15rem_minmax(0,1fr)]">
        <x-app-sidebar />

        <div class="min-w-0">
            <header class="flex h-16 items-center justify-between gap-4 border-b border-outline-variant bg-surface-container-lowest px-4 sm:px-6 lg:px-8">
                <div class="flex min-w-0 items-center gap-2 text-body-sm text-on-surface-variant"><span class="font-display text-label-lg text-primary-container lg:hidden">SIRA</span><span class="hidden sm:inline">Administración</span><span class="hidden sm:inline">/</span><span class="text-label-md text-on-surface">Configuración</span></div>
                <div class="flex items-center gap-2 sm:gap-4"><button type="button" class="relative rounded-md p-2 text-on-surface-variant hover:bg-surface-container-low" aria-label="Notificaciones"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg></button><span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-fixed text-label-md text-on-primary-fixed-variant">{{ mb_substr(auth()->user()->name, 0, 1) }}</span><span class="hidden max-w-36 truncate text-label-md text-on-surface sm:inline">{{ auth()->user()->name }}</span></div>
            </header>

            <main class="mx-auto max-w-[1500px] space-y-5 px-4 py-5 sm:px-6 lg:px-8 lg:py-7">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><p class="text-label-sm text-primary-container">SIRA / ADMINISTRACIÓN</p><h1 class="mt-1 font-display text-headline-lg text-on-surface sm:text-display-lg-mobile">Configuración del Sistema y Plan de Suscripción SIRA</h1><p class="mt-2 text-body-md text-on-surface-variant">Administra tu suscripción, consumo y preferencias de operación.</p></div><x-action-button variant="secondary" type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m-4-4 4 4 4-4M5 16v4h14v-4"/></svg>Descargar factura</x-action-button></div>

                @if ($previewOnly)
                    <div class="rounded-md border border-secondary-fixed-dim bg-secondary-fixed px-4 py-3 text-body-sm text-on-secondary-fixed-variant" role="status">Vista previa con datos de muestra; los controles están deshabilitados.</div>
                @endif
                @if (session('status'))
                    <div class="rounded-md border border-primary-fixed-dim bg-primary-fixed px-4 py-3 text-body-sm text-on-primary-fixed-variant" role="status">{{ session('status') }}</div>
                @endif

                <section class="overflow-hidden rounded-lg bg-primary-container p-5 text-on-primary sm:p-6 lg:p-7" aria-label="Plan actual">
                    <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-center">
                        <div><div class="flex flex-wrap items-center gap-2"><span class="rounded-full bg-primary-fixed px-2.5 py-1 text-label-sm text-on-primary-fixed-variant">SUSCRIPCIÓN ACTIVA</span><span class="text-label-sm text-on-primary-container">RENUEVA EL {{ \Illuminate\Support\Carbon::parse($fecha_renovacion)->format('d/m/Y') }}</span></div><p class="mt-3 font-display text-headline-lg text-on-primary sm:text-display-lg-mobile">Plan {{ $plan_actual }} <span class="font-sans text-body-lg font-normal text-on-primary-container">· $900 MXN / mes</span></p><p class="mt-2 max-w-2xl text-body-md text-on-primary-container">Acceso a trazabilidad integral, reportes avanzados y capacidad para administrar hasta {{ $limite_manifiestos }} manifiestos al mes.</p></div>
                        <div class="flex flex-wrap gap-2"><x-action-button variant="secondary" type="button" class="border-on-primary/20 bg-on-primary text-primary-container hover:bg-primary-fixed">Administrar suscripción</x-action-button><a href="#planes" class="inline-flex min-h-12 items-center justify-center rounded-md border border-on-primary/35 px-4 py-3 text-label-md text-on-primary hover:bg-on-primary/10">Ver otros planes</a></div>
                    </div>
                    <div class="mt-6 grid gap-4 border-t border-on-primary/20 pt-5 md:grid-cols-2"><x-progress-bar label="Manifiestos generados este mes" :used="$manifiestos_usados" :limit="$limite_manifiestos" unit="" tone="primary" :inverted="true" class="max-w-xl"/><x-progress-bar label="Almacenamiento de documentos" :used="6.4" :limit="20" unit=" GB" tone="warning" :inverted="true" class="max-w-xl"/></div>
                </section>

                <section id="planes" aria-labelledby="plans-title"><div class="mb-4 flex flex-col justify-between gap-2 sm:flex-row sm:items-end"><div><h2 id="plans-title" class="font-display text-headline-sm text-on-surface">Planes de suscripción</h2><p class="mt-1 text-body-sm text-on-surface-variant">Elige la capacidad que mejor acompaña a tu operación.</p></div><p class="text-label-sm text-on-surface-variant">PRECIOS EN MXN / MES</p></div><div class="grid items-stretch gap-4 lg:grid-cols-3">@foreach ($planes as $plan)<x-plan-card :plan="$plan" :active-plan="$plan_actual" />@endforeach</div></section>

                <section class="overflow-hidden rounded-lg border border-outline-variant bg-surface-container-lowest shadow-sm" aria-labelledby="settings-title">
                    <div class="flex flex-col justify-between gap-3 border-b border-outline-variant p-4 sm:flex-row sm:items-center sm:px-5"><div><h2 id="settings-title" class="font-display text-headline-sm text-on-surface">Configuración del sistema</h2><p class="mt-1 text-body-sm text-on-surface-variant">Define los avisos y medidas de seguridad de tu cuenta.</p></div><span class="rounded-full bg-primary-fixed px-2.5 py-1 text-label-sm text-on-primary-fixed-variant">Preferencias de cuenta</span></div>
                    <form action="{{ route('settings.update') }}" method="POST" class="px-4 sm:px-5">
                        @csrf
                        @method('PUT')
                        <div class="divide-y divide-outline-variant">
                            <x-toggle-switch name="email_notifications" label="Notificaciones por correo" description="Recibe actualizaciones de manifiestos y facturas por correo electrónico." :checked="$preferencias['email_notifications'] === '1'" :disabled="$previewOnly" />
                            <x-toggle-switch name="sms_alerts" label="Alertas SMS prioritarias" description="Recibe avisos urgentes cuando un manifiesto requiera atención." :checked="$preferencias['sms_alerts'] === '1'" :disabled="$previewOnly" />
                            <x-toggle-switch name="monthly_digest" label="Resumen mensual de actividad" description="Recibe un reporte con consumo, lotes y actividad de tu cuenta." :checked="$preferencias['monthly_digest'] === '1'" :disabled="$previewOnly" />
                            <x-toggle-switch name="login_alerts" label="Alertas de inicio de sesión" description="Notifica cuando se detecte un nuevo acceso a la cuenta." :checked="$preferencias['login_alerts'] === '1'" :disabled="$previewOnly" />
                        </div>
                        <div class="flex flex-col-reverse justify-end gap-3 border-t border-outline-variant py-4 sm:flex-row"><x-action-button variant="secondary" type="reset" :disabled="$previewOnly">Restablecer</x-action-button><x-action-button type="submit" :disabled="$previewOnly">Guardar cambios</x-action-button></div>
                    </form>
                </section>
            </main>
        </div>
    </div>
@endsection