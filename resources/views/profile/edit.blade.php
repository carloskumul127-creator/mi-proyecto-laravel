@extends('layouts.app')

@section('title', 'Mi perfil | SIRA')

@section('content')
    @php
        $user = $profileUser ?? auth()->user();
        $previewOnly = $previewOnly ?? false;
        $avatarUrl = $user->avatar_path
            ? \Illuminate\Support\Facades\Storage::url($user->avatar_path)
            : asset('images/default-avatar.png');
    @endphp

    <div class="min-h-screen bg-background lg:grid lg:grid-cols-[15rem_minmax(0,1fr)]">
        <x-app-sidebar />

        <div class="min-w-0">
            <header class="flex h-16 items-center justify-between border-b border-outline-variant bg-surface-container-lowest px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 text-body-sm text-on-surface-variant"><span class="font-display text-label-lg text-primary-container lg:hidden">SIRA</span><span class="hidden sm:inline">Configuración</span><span aria-hidden="true">/</span><span class="text-label-md text-on-surface">Mi perfil</span></div>
                <div class="flex items-center gap-3"><button type="button" class="rounded-md p-2 text-on-surface-variant hover:bg-surface-container-low" aria-label="Notificaciones"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg></button><img src="{{ $avatarUrl }}" alt="" class="h-8 w-8 rounded-full border border-outline-variant object-cover"><span class="hidden max-w-36 truncate text-label-md text-on-surface sm:inline">{{ $user->name }}</span></div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div><p class="text-label-sm text-primary-container">CONFIGURACIÓN DE CUENTA</p><h1 class="mt-1 font-display text-headline-lg text-on-surface sm:text-display-lg-mobile">Mi Perfil y Configuración Personal</h1><p class="mt-2 text-body-md text-on-surface-variant">Administra tu información personal, seguridad y preferencias.</p></div>
                    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary-fixed px-3 py-1.5 text-label-sm text-on-primary-fixed-variant"><span class="h-2 w-2 rounded-full bg-primary-container"></span>Cuenta verificada</span>
                </div>

                @if ($previewOnly)
                    <div class="mb-5 rounded-md border border-secondary-fixed-dim bg-secondary-fixed px-4 py-3 text-body-md text-on-secondary-fixed-variant" role="status">
                        Vista previa local con datos de muestra. Los cambios no se guardan.
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-5 rounded-md border border-primary-fixed-dim bg-primary-fixed px-4 py-3 text-body-md text-on-primary-fixed-variant" role="status">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-5 rounded-md border border-error-container bg-error-container px-4 py-3 text-body-md text-on-error-container" role="alert">Revisa los campos señalados antes de guardar.</div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <section class="flex flex-col justify-between gap-5 rounded-lg border border-outline-variant bg-surface-container-lowest p-5 shadow-sm sm:flex-row sm:items-center sm:p-6" aria-labelledby="profile-summary-title">
                        <div class="flex min-w-0 flex-col gap-4 sm:flex-row sm:items-center">
                            <x-avatar-upload :src="$avatarUrl" :name="$user->name" :disabled="$previewOnly" />
                            <div class="min-w-0"><h2 id="profile-summary-title" class="truncate font-display text-headline-md text-on-surface">{{ $user->name }}</h2><p class="mt-1 truncate text-body-md text-on-surface-variant">{{ $user->email }}</p><div class="mt-2 flex flex-wrap items-center gap-2"><span class="rounded-sm bg-primary-container/10 px-2 py-1 text-label-sm text-primary-container">Administrador de cuenta</span><span class="text-body-sm text-on-surface-variant">ID de usuario #{{ $user->id }}</span></div></div>
                        </div>
                        <div class="border-t border-outline-variant pt-4 text-body-sm text-on-surface-variant sm:border-l sm:border-t-0 sm:pl-6 sm:pt-0"><p class="text-label-sm">MIEMBRO DESDE</p><p class="mt-1 text-label-md text-on-surface">{{ optional($user->created_at)->format('d M Y') ?? 'Cuenta activa' }}</p></div>
                    </section>

                    <div class="grid gap-5 xl:grid-cols-2">
                        <section class="rounded-lg border border-outline-variant bg-surface-container-lowest p-5 shadow-sm sm:p-6" aria-labelledby="personal-data-title">
                            <div class="mb-5"><h2 id="personal-data-title" class="font-display text-headline-sm text-on-surface">Datos personales</h2><p class="mt-1 text-body-sm text-on-surface-variant">Información asociada a tu acceso SIRA.</p></div>
                            <div class="space-y-5">
                                <x-form-input name="name" label="Nombre completo" :value="old('name', $user->name)" autocomplete="name" required :disabled="$previewOnly">
                                    <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="8" r="3.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0 1 14 0"/></svg></x-slot:leading>
                                </x-form-input>
                                <x-form-input name="email" label="Correo electrónico" type="email" :value="old('email', $user->email)" autocomplete="email" required :disabled="$previewOnly">
                                    <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7 7.5 5.5L19.5 7"/></svg></x-slot:leading>
                                </x-form-input>
                            </div>
                        </section>

                        <section class="rounded-lg border border-outline-variant bg-surface-container-lowest p-5 shadow-sm sm:p-6" aria-labelledby="security-title">
                            <div class="mb-5"><h2 id="security-title" class="font-display text-headline-sm text-on-surface">Seguridad y control de acceso</h2><p class="mt-1 text-body-sm text-on-surface-variant">Estado de protección de tu cuenta.</p></div>
                            <div class="divide-y divide-outline-variant">
                                <div class="flex items-center justify-between gap-4 py-4 first:pt-0"><div><p class="text-label-md text-on-surface">Contraseña</p><p class="mt-1 text-body-sm text-on-surface-variant">Actualiza periódicamente tus credenciales.</p></div><span class="shrink-0 rounded-full bg-surface-container px-2.5 py-1 text-label-sm text-on-surface-variant">••••••••</span></div>
                                <div class="flex items-center justify-between gap-4 py-4"><div><p class="text-label-md text-on-surface">Verificación en dos pasos</p><p class="mt-1 text-body-sm text-on-surface-variant">Añade una capa adicional de seguridad.</p></div><span class="shrink-0 rounded-full bg-secondary-fixed px-2.5 py-1 text-label-sm text-on-secondary-fixed-variant">No configurada</span></div>
                                <div class="flex items-center justify-between gap-4 py-4 last:pb-0"><div><p class="text-label-md text-on-surface">Sesiones activas</p><p class="mt-1 text-body-sm text-on-surface-variant">Este dispositivo · Sesión actual</p></div><span class="inline-flex shrink-0 items-center gap-1.5 text-label-sm text-primary-container"><span class="h-2 w-2 rounded-full bg-primary-container"></span>Activa</span></div>
                            </div>
                        </section>
                    </div>

                    <section class="rounded-lg border border-outline-variant bg-surface-container-lowest p-5 shadow-sm sm:p-6" aria-labelledby="notifications-title">
                        <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center"><div><h2 id="notifications-title" class="font-display text-headline-sm text-on-surface">Preferencias de notificaciones operativas</h2><p class="mt-1 text-body-sm text-on-surface-variant">Canales informativos asociados a tu cuenta.</p></div><span class="text-label-sm text-on-surface-variant">PREFERENCIAS ACTUALES</span></div>
                        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                            @foreach ([['Manifiestos', 'Actualizaciones de estado', true], ['Alertas regulatorias', 'Cambios normativos', true], ['Reportes mensuales', 'Resumen de actividad', false], ['Seguridad de cuenta', 'Accesos y cambios', true]] as [$title, $description, $enabled])
                                <label class="flex items-start justify-between gap-3 rounded-md border border-outline-variant bg-surface-container-lowest p-4"><span><span class="block text-label-md text-on-surface">{{ $title }}</span><span class="mt-1 block text-body-sm text-on-surface-variant">{{ $description }}</span></span><input type="checkbox" @checked($enabled) disabled class="mt-0.5 h-4 w-4 rounded border-outline text-primary focus:ring-primary"></label>
                            @endforeach
                        </div>
                    </section>

                    <section class="overflow-hidden rounded-lg border border-outline-variant bg-surface-container-lowest shadow-sm" aria-labelledby="activity-title">
                        <div class="flex flex-col justify-between gap-2 border-b border-outline-variant p-5 sm:flex-row sm:items-center sm:px-6"><div><h2 id="activity-title" class="font-display text-headline-sm text-on-surface">Registro de actividad reciente</h2><p class="mt-1 text-body-sm text-on-surface-variant">Accesos recientes a tu perfil.</p></div><span class="text-label-sm text-on-surface-variant">ÚLTIMOS 30 DÍAS</span></div>
                        <div class="overflow-x-auto"><table class="w-full min-w-[38rem] text-left"><thead class="bg-surface-container-low text-label-sm text-on-surface-variant"><tr><th class="px-5 py-3 font-medium sm:px-6">Actividad</th><th class="px-5 py-3 font-medium">Dispositivo</th><th class="px-5 py-3 font-medium">Ubicación</th><th class="px-5 py-3 font-medium">Estado</th></tr></thead><tbody class="divide-y divide-outline-variant text-body-sm"><tr><td class="px-5 py-4 sm:px-6"><span class="block text-label-md text-on-surface">Inicio de sesión</span><span class="mt-1 block text-on-surface-variant">Sesión actual</span></td><td class="px-5 py-4 text-on-surface-variant">Navegador web</td><td class="px-5 py-4 text-on-surface-variant">Dispositivo actual</td><td class="px-5 py-4"><span class="rounded-full bg-primary-fixed px-2.5 py-1 text-label-sm text-on-primary-fixed-variant">Correcto</span></td></tr><tr><td class="px-5 py-4 sm:px-6"><span class="block text-label-md text-on-surface">Actualización de perfil</span><span class="mt-1 block text-on-surface-variant">Actividad de ejemplo</span></td><td class="px-5 py-4 text-on-surface-variant">Navegador web</td><td class="px-5 py-4 text-on-surface-variant">Sesión anterior</td><td class="px-5 py-4"><span class="rounded-full bg-primary-fixed px-2.5 py-1 text-label-sm text-on-primary-fixed-variant">Correcto</span></td></tr></tbody></table></div>
                    </section>

                    <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
                        <x-action-button variant="secondary" type="reset">Descartar cambios</x-action-button>
                        <x-action-button type="submit" :disabled="$previewOnly"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>Guardar cambios</x-action-button>
                    </div>
                </form>
            </main>
        </div>
    </div>
@endsection