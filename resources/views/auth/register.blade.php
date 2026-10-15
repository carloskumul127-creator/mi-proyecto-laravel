@extends('layouts.app')

@section('title', 'Crear cuenta | SIRA')

@section('content')
    <main class="flex min-h-screen flex-col items-center justify-center bg-background px-4 py-8 sm:px-6 sm:py-10">
        <div class="w-full max-w-[480px]">
            <section class="rounded-lg border border-outline-variant bg-surface-container-lowest px-6 py-8 shadow-[0_18px_48px_rgba(32,48,40,0.08)] sm:px-10 sm:py-9">
                <header class="text-center">
                    <img src="{{ asset('images/sira-logo.svg') }}" alt="Logo SIRA" class="mx-auto mb-5 h-16 w-16 object-contain">
                    <p class="text-label-sm text-primary-container">SISTEMA INTEGRAL DE RESIDUOS AMBIENTALES</p>
                    <h1 class="mt-2 font-display text-headline-lg text-on-surface">Crear cuenta SIRA</h1>
                    <p class="mx-auto mt-2 max-w-sm text-body-sm text-on-surface-variant">Registra tu organización para gestionar manifiestos y dar seguimiento a tus residuos.</p>
                </header>

                <div class="mt-5 flex items-center gap-2.5 rounded-md border border-outline-variant bg-surface-container-low px-3.5 py-3 text-body-sm text-on-surface-variant" role="note">
                    <svg class="h-4 w-4 shrink-0 text-primary-container" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75 19.5 7v5.1c0 4.2-3.1 7.25-7.5 9.15-4.4-1.9-7.5-4.95-7.5-9.15V7L12 3.75Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"/></svg>
                    <span><span class="text-label-md text-on-surface">Acceso empresarial</span> · Registro seguro para usuarios autorizados.</span>
                </div>

                @if ($errors->any())
                    <div class="mt-5 rounded-md border border-error-container bg-error-container px-3.5 py-3 text-body-sm text-on-error-container" role="alert">Revisa los campos señalados para continuar.</div>
                @endif

                <form class="mt-5 space-y-4" action="{{ route('register') }}" method="POST">
                    @csrf

                    <x-form-input id="name" name="name" label="Nombre completo" :value="old('name')" placeholder="Nombre y apellidos" autocomplete="name" required>
                        <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="8" r="3.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0 1 14 0"/></svg></x-slot:leading>
                    </x-form-input>

                    <x-form-input id="company" name="company" label="Empresa (opcional)" :value="old('company')" placeholder="Nombre de tu empresa" autocomplete="organization">
                        <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M4 20.5h16M6 20V5.5l6-2 6 2V20M9 8h.01M15 8h.01M9 12h.01M15 12h.01M10 20v-4h4v4"/></svg></x-slot:leading>
                    </x-form-input>

                    <x-form-input id="email" name="email" label="Correo Electrónico" type="email" :value="old('email')" placeholder="nombre@empresa.com.mx" autocomplete="email" required>
                        <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7 7.5 5.5L19.5 7"/></svg></x-slot:leading>
                    </x-form-input>

                    <x-form-input id="password" name="password" label="Contraseña" type="password" placeholder="Crea una contraseña segura" autocomplete="new-password" required>
                        <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="5" y="10" width="14" height="10" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></x-slot:leading>
                    </x-form-input>

                    <x-form-input id="password_confirmation" name="password_confirmation" label="Confirmación de Contraseña" type="password" placeholder="Vuelve a escribir tu contraseña" autocomplete="new-password" required>
                        <x-slot:leading><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="5" y="10" width="14" height="10" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 0 1 8 0v3m-6 5 1.5 1.5L15 14"/></svg></x-slot:leading>
                    </x-form-input>

                    <x-action-button type="submit" class="w-full !mt-5">
                        <span>Crear cuenta</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </x-action-button>
                </form>

                <p class="mt-5 text-center text-body-sm text-on-surface-variant">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-label-md text-primary-container underline-offset-4 hover:underline">Inicia sesión</a></p>

                <div class="mt-5 flex items-start justify-center gap-2 border-t border-outline-variant pt-4 text-center text-label-sm text-on-surface-variant">
                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-primary-container" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="5" y="10" width="14" height="10" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                    <span>Conexión cifrada SSL · Cumplimiento normativo SEMARNAT</span>
                </div>
            </section>

            <footer class="mt-5 text-center text-label-sm leading-5 text-on-surface-variant">
                <p>© 2026 SIRA · Powered by Grupo Tuxpan</p>
                <nav aria-label="Enlaces legales" class="flex flex-wrap justify-center gap-x-3"><a href="#terminos" class="hover:text-primary-container">Términos de Servicio</a><span aria-hidden="true">·</span><a href="#privacidad" class="hover:text-primary-container">Aviso de Privacidad</a><span aria-hidden="true">·</span><a href="#soporte" class="hover:text-primary-container">Mesa de Soporte</a></nav>
            </footer>
        </div>
    </main>
@endsection