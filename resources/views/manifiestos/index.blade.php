@extends('layouts.app')

@section('title', 'Gestión de Manifiestos | SIRA')

@section('content')
    @php
        $manifiestos = [
            ['folio' => 'MAN-2026-00145', 'empresa' => 'EcoTratamientos MX', 'residuo' => 'Solventes orgánicos', 'clasificacion' => 'CRETIB · Inflamable', 'generador' => 'Química del Bajío', 'destino' => 'Planta Norte', 'estado' => 'En tránsito', 'tone' => 'info', 'actualizado' => 'Hoy, 10:42'],
            ['folio' => 'MAN-2026-00142', 'empresa' => 'Química del Bajío', 'residuo' => 'Lodos industriales', 'clasificacion' => 'CRETIB · Tóxico', 'generador' => 'Química del Bajío', 'destino' => 'Centro de confinamiento 04', 'estado' => 'Pendiente', 'tone' => 'warning', 'actualizado' => 'Hoy, 09:18'],
            ['folio' => 'MAN-2026-00138', 'empresa' => 'Industrias del Norte', 'residuo' => 'Aceites contaminados', 'clasificacion' => 'CRETIB · Inflamable', 'generador' => 'Industrias del Norte', 'destino' => 'Gestora Ambiental MX', 'estado' => 'Vencido', 'tone' => 'error', 'actualizado' => 'Ayer, 16:35'],
            ['folio' => 'MAN-2026-00131', 'empresa' => 'Reciclados del Centro', 'residuo' => 'Envases contaminados', 'clasificacion' => 'Manejo especial', 'generador' => 'Autopartes del Centro', 'destino' => 'Recuperadora Central', 'estado' => 'Completado', 'tone' => 'success', 'actualizado' => 'Ayer, 14:07'],
            ['folio' => 'MAN-2026-00127', 'empresa' => 'BioProcesos del Sur', 'residuo' => 'Residuos biológico-infecciosos', 'clasificacion' => 'CRETIB · Biológico', 'generador' => 'Clínica San Gabriel', 'destino' => 'Tratamientos Bioseguros', 'estado' => 'En revisión', 'tone' => 'warning', 'actualizado' => '12 oct, 11:26'],
            ['folio' => 'MAN-2026-00119', 'empresa' => 'Metales y Fundición SA', 'residuo' => 'Escoria de fundición', 'clasificacion' => 'CRETIB · Reactivo', 'generador' => 'Metales y Fundición SA', 'destino' => 'Confinamiento Regional', 'estado' => 'Recibido', 'tone' => 'success', 'actualizado' => '11 oct, 17:50'],
        ];

        $headers = ['Folio / empresa', 'Residuo / clasificación', 'Generador', 'Destino autorizado', 'Estado', 'Última actualización', ''];
        $totalManifiestos = 142;
        $paginaActual = 1;
        $paginas = 12;
    @endphp

    <div class="min-h-screen bg-background lg:grid lg:grid-cols-[15rem_minmax(0,1fr)]">
        <x-app-sidebar />

        <div class="min-w-0">
            <header class="flex h-16 items-center justify-between gap-4 border-b border-outline-variant bg-surface-container-lowest px-4 sm:px-6 lg:px-8">
                <div class="flex min-w-0 flex-1 items-center gap-3"><span class="font-display text-label-lg text-primary-container lg:hidden">SIRA</span><label class="relative hidden max-w-xl flex-1 md:block"><span class="sr-only">Buscar en SIRA</span><svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-on-surface-variant" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path stroke-linecap="round" d="m16 16 4.5 4.5"/></svg><input type="search" placeholder="Buscar manifiestos, empresas o residuos..." class="h-10 w-full rounded-md border border-outline-variant bg-surface-container-low py-2 pl-10 pr-3 text-body-sm text-on-surface placeholder:text-on-surface-variant focus:border-primary-container focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary-container/15"></label></div>
                <div class="flex shrink-0 items-center gap-2 sm:gap-4"><button type="button" class="relative rounded-md p-2 text-on-surface-variant hover:bg-surface-container-low" aria-label="Notificaciones"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg><span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-error"></span></button><span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-fixed text-label-md text-on-primary-fixed-variant">{{ mb_substr(auth()->user()->name, 0, 1) }}</span><span class="hidden max-w-36 truncate text-label-md text-on-surface sm:inline">{{ auth()->user()->name }}</span></div>
            </header>

            <main class="mx-auto max-w-[1600px] space-y-5 px-4 py-5 sm:px-6 lg:px-8 lg:py-7">
                <div class="flex flex-col justify-between gap-4 xl:flex-row xl:items-end">
                    <div><p class="text-label-sm text-primary-container">SIRA / OPERACIONES</p><h1 class="mt-1 font-display text-headline-lg text-on-surface sm:text-display-lg-mobile">Gestión de Manifiestos de Entrada y Salida</h1><p class="mt-2 max-w-3xl text-body-md text-on-surface-variant">Control integral de manifiestos de residuos peligrosos y de manejo especial, desde su generación hasta la disposición final.</p></div>
                    <x-action-button type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/></svg>Generar manifiesto</x-action-button>
                </div>

                <div class="flex flex-col gap-3 border-b border-outline-variant sm:flex-row sm:items-center sm:justify-between">
                    <nav class="flex gap-5 overflow-x-auto" aria-label="Tipo de manifiesto">
                        <a href="#entrada" aria-current="page" class="inline-flex shrink-0 items-center gap-2 border-b-2 border-primary-container px-1 pb-3 text-label-md text-primary-container"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-6 6 6-6 6 6"/></svg>Manifiestos de Entrada <span class="rounded-full bg-primary-fixed px-2 py-0.5 text-label-sm text-on-primary-fixed-variant">86</span></a>
                        <a href="#salida" class="inline-flex shrink-0 items-center gap-2 border-b-2 border-transparent px-1 pb-3 text-label-md text-on-surface-variant hover:border-outline hover:text-on-surface"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-6-6 6 6 6-6"/></svg>Manifiestos de Salida <span class="rounded-full bg-surface-container px-2 py-0.5 text-label-sm text-on-surface-variant">56</span></a>
                    </nav>
                    <span class="pb-3 text-body-sm text-on-surface-variant">Actualizado hoy, 10:42</span>
                </div>

                <section class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4" aria-label="Resumen de manifiestos">
                    <article class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm"><p class="text-label-md text-on-surface-variant">Total de manifiestos</p><p class="mt-2 font-display text-headline-lg text-on-surface">{{ $totalManifiestos }}</p><p class="mt-1 text-body-sm text-on-surface-variant">En el periodo actual</p></article>
                    <article class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm"><p class="text-label-md text-on-surface-variant">En tránsito</p><p class="mt-2 font-display text-headline-lg text-on-surface">24</p><p class="mt-1 text-body-sm text-on-surface-variant">Seguimiento activo</p></article>
                    <article class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm"><p class="text-label-md text-on-surface-variant">Pendientes de revisión</p><p class="mt-2 font-display text-headline-lg text-on-surface">8</p><p class="mt-1 text-body-sm text-on-surface-variant">Requieren validación</p></article>
                    <article class="rounded-lg border border-outline-variant bg-surface-container-lowest p-4 shadow-sm"><p class="text-label-md text-on-surface-variant">Completados</p><p class="mt-2 font-display text-headline-lg text-on-surface">110</p><p class="mt-1 text-body-sm text-on-surface-variant">Recepción confirmada</p></article>
                </section>

                <section class="overflow-hidden rounded-lg border border-outline-variant bg-surface-container-lowest shadow-sm" aria-labelledby="manifests-title">
                    <div class="flex flex-col justify-between gap-4 border-b border-outline-variant p-4 sm:flex-row sm:items-center sm:px-5">
                        <div><h2 id="manifests-title" class="font-display text-headline-sm text-on-surface">Manifiestos registrados</h2><p class="mt-1 text-body-sm text-on-surface-variant">Consulta y filtra los documentos de traslado y recepción.</p></div>
                        <x-action-button variant="secondary" type="button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M7 12h10m-7 6h4"/></svg>Exportar</x-action-button>
                    </div>

                    <form method="GET" action="{{ route('manifests.index') }}" class="flex flex-col gap-3 border-b border-outline-variant p-4 sm:flex-row sm:items-center sm:px-5">
                        <label class="relative min-w-52 flex-1"><span class="sr-only">Buscar por folio, empresa o residuo</span><svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-on-surface-variant" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path stroke-linecap="round" d="m16 16 4.5 4.5"/></svg><input name="search" type="search" value="{{ request('search') }}" placeholder="Buscar por folio, empresa o residuo" class="h-10 w-full rounded-md border border-outline-variant bg-surface-container-low py-2 pl-10 pr-3 text-body-sm text-on-surface placeholder:text-on-surface-variant focus:border-primary-container focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary-container/15"></label>
                        <label class="sr-only" for="status-filter">Filtrar por estado</label><select id="status-filter" name="estado" class="h-10 rounded-md border border-outline-variant bg-surface-container-low px-3 text-body-sm text-on-surface focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-primary-container/15"><option value="">Todos los estados</option><option value="En tránsito">En tránsito</option><option value="Pendiente">Pendiente</option><option value="Completado">Completado</option><option value="Vencido">Vencido</option></select>
                        <label class="sr-only" for="type-filter">Filtrar por tipo</label><select id="type-filter" name="tipo" class="h-10 rounded-md border border-outline-variant bg-surface-container-low px-3 text-body-sm text-on-surface focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-primary-container/15"><option value="">Entrada y salida</option><option value="Entrada">Entrada</option><option value="Salida">Salida</option></select>
                        <x-action-button type="submit" class="min-h-10 py-2">Aplicar filtros</x-action-button>
                    </form>

                    <x-table :headers="$headers">
                        @forelse ($manifiestos as $manifiesto)
                            <x-table-row :manifest="$manifiesto" />
                        @empty
                            <tr><td colspan="7" class="px-5 py-16 text-center"><span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-surface-container text-on-surface-variant"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l4 4v13H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5v5h5M9 13h6"/></svg></span><p class="mt-3 text-label-md text-on-surface">No hay manifiestos registrados</p><p class="mt-1 text-body-sm text-on-surface-variant">Cuando se creen manifiestos, aparecerán en esta lista.</p></td></tr>
                        @endforelse
                    </x-table>

                    <div class="flex flex-col gap-3 border-t border-outline-variant px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-5">
                        <p class="text-body-sm text-on-surface-variant">Mostrando <span class="text-label-md text-on-surface">1-{{ min(count($manifiestos), 10) }}</span> de <span class="text-label-md text-on-surface">{{ $totalManifiestos }}</span> manifiestos</p>
                        <nav class="flex items-center gap-1" aria-label="Paginación de manifiestos">
                            <a href="#anterior" aria-label="Página anterior" class="flex h-9 w-9 items-center justify-center rounded-md border border-outline-variant text-on-surface-variant hover:bg-surface-container-low"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/></svg></a>
                            @foreach ([1, 2, 3, '…', $paginas] as $pagina)
                                @if ($pagina === $paginaActual)
                                    <span aria-current="page" class="flex h-9 min-w-9 items-center justify-center rounded-md bg-primary-container px-2 text-label-md text-on-primary">{{ $pagina }}</span>
                                @elseif ($pagina === '…')
                                    <span class="flex h-9 min-w-9 items-center justify-center px-2 text-body-sm text-on-surface-variant">{{ $pagina }}</span>
                                @else
                                    <a href="#pagina-{{ $pagina }}" class="flex h-9 min-w-9 items-center justify-center rounded-md px-2 text-label-md text-on-surface-variant hover:bg-surface-container-low">{{ $pagina }}</a>
                                @endif
                            @endforeach
                            <a href="#siguiente" aria-label="Página siguiente" class="flex h-9 w-9 items-center justify-center rounded-md border border-outline-variant text-on-surface-variant hover:bg-surface-container-low"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg></a>
                        </nav>
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection