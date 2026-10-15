@extends('layouts.app')

@section('title', 'Iniciar sesión | SIRA')

@section('content')
    <main class="flex min-h-screen flex-col items-center justify-center px-4 py-8 sm:px-6 sm:py-10">
        <div class="w-full max-w-[480px]">
            <section class="rounded-lg border border-[#e7e9ef] bg-white px-6 py-8 shadow-[0_18px_48px_rgba(32,48,40,0.08)] sm:px-10 sm:py-9">
                <header class="text-center">
                    <img
                        src="{{ asset('images/sira-logo.svg') }}"
                        alt="Logo SIRA"
                        class="mx-auto mb-5 h-16 w-16 object-contain"
                    >
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#6d7b73]">
                        Sistema Integral de Residuos Ambientales
                    </p>
                    <h1 class="mt-2 text-xl font-semibold text-[#1b2922] sm:text-2xl">
                        Iniciar Sesión en el Portal
                    </h1>
                    <p class="mx-auto mt-2 max-w-sm text-sm leading-5 text-[#707b76]">
                        Acceso para Empresas, Acopiadores y Transportistas Autorizados
                    </p>
                </header>

                <div class="mt-6 flex items-center gap-2.5 rounded-md border border-[#e6e9f4] bg-[#f2f4fb] px-3.5 py-3 text-xs text-[#48564f]" role="note">
                    <svg class="h-4 w-4 shrink-0 text-[#527660]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75 19.5 7v5.1c0 4.2-3.1 7.25-7.5 9.15-4.4-1.9-7.5-4.95-7.5-9.15V7L12 3.75Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4" />
                    </svg>
                    <span><span class="font-semibold">Plataforma Federal</span> · NOM-052-SEMARNAT-2005</span>
                </div>

                <form class="mt-6 space-y-5" action="{{ route('login') }}" method="POST">
                    @csrf

                    <x-form-input
                        id="email"
                        name="email"
                        label="Correo Electrónico Corporativo"
                        type="email"
                        :value="old('email')"
                        placeholder="nombre@empresa.com.mx"
                        autocomplete="username"
                        required
                    >
                        <x-slot:leading>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="3.5" y="5.5" width="17" height="13" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7 7.5 5.5L19.5 7" />
                            </svg>
                        </x-slot:leading>
                    </x-form-input>

                    <x-form-input
                        id="password"
                        name="password"
                        label="Contraseña"
                        type="password"
                        placeholder="Ingresa tu contraseña"
                        autocomplete="current-password"
                        required
                    >
                        <x-slot:leading>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="5" y="10" width="14" height="10" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 0 1 8 0v3m-4 4v2" />
                            </svg>
                        </x-slot:leading>
                        <x-slot:trailing>
                            <button
                                type="button"
                                data-password-toggle="password"
                                aria-label="Mostrar contraseña"
                                class="rounded p-1 text-[#718079] transition hover:text-[#26372d] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#0f5132]"
                            >
                                <svg data-eye-open class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>
                                <svg data-eye-closed class="hidden h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 6.2A10.3 10.3 0 0 1 12 6c6.1 0 9.5 6 9.5 6a16 16 0 0 1-3.1 3.6M6.2 6.3C3.8 8 2.5 12 2.5 12s3.4 6 9.5 6c1.4 0 2.6-.3 3.7-.8" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                                </svg>
                            </button>
                        </x-slot:trailing>
                    </x-form-input>

                    <div class="flex flex-wrap items-center justify-between gap-3 text-xs">
                        <label for="remember" class="inline-flex cursor-pointer items-center gap-2 text-[#59665f]">
                            <input id="remember" name="remember" type="checkbox" value="1" class="h-4 w-4 rounded border-[#cbd2cd] text-[#075638] focus:ring-[#075638]">
                            <span>Recordar 30 días</span>
                        </label>
                        <a href="#recuperar-contrasena" class="font-medium text-[#075638] underline-offset-4 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <x-action-button type="submit" class="w-full">
                        <span>Iniciar Sesión</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </x-action-button>
                </form>

                <div class="my-6 flex items-center gap-3 text-[10px] font-medium uppercase tracking-[0.1em] text-[#88918d]">
                    <span class="h-px flex-1 bg-[#e8ebe9]"></span>
                    <span>O continuar con</span>
                    <span class="h-px flex-1 bg-[#e8ebe9]"></span>
                </div>

                <x-action-button variant="secondary" type="button" class="w-full">
                    <svg class="h-4 w-4" viewBox="0 0 48 48" aria-hidden="true">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5Z" />
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.75 7.18l7.28 5.65c4.25-3.93 7.51-9.74 7.51-17.3Z" />
                        <path fill="#FBBC05" d="M10.53 28.59A14.4 14.4 0 0 1 9.75 24c0-1.59.27-3.13.78-4.59l-7.98-6.19A23.9 23.9 0 0 0 0 24c0 3.87.93 7.52 2.56 10.78l7.97-6.19Z" />
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.91-5.8l-7.28-5.65c-2.02 1.36-4.6 2.17-8.63 2.17-6.26 0-11.57-4.22-13.46-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48Z" />
                    </svg>
                    <span>Acceder con Google</span>
                </x-action-button>

                <p class="mt-5 rounded-md bg-[#f2f4fb] px-3 py-3 text-center text-xs text-[#5f6b65]">
                    ¿No tienes cuenta?
                    <a href="#solicitar-acceso" class="font-semibold text-[#075638] underline-offset-4 hover:underline">Solicitar acceso institucional</a>
                </p>

                <div class="mt-5 flex items-start justify-center gap-2 border-t border-[#edf0ee] pt-4 text-center text-[10px] leading-4 text-[#78837d]">
                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-[#527660]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <rect x="5" y="10" width="14" height="10" rx="2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 0 1 8 0v3" />
                    </svg>
                    <span>Conexión cifrada SSL 256-bit · Cumplimiento normativo SEMARNAT</span>
                </div>
            </section>

            <footer class="mt-5 text-center text-[10px] leading-5 text-[#858e89]">
                <p>© 2025 SIRA · Powered by Grupo Tuxpan · Versión 2.1</p>
                <nav aria-label="Enlaces legales" class="flex flex-wrap justify-center gap-x-3">
                    <a href="#terminos" class="hover:text-[#075638]">Términos de Servicio</a>
                    <span aria-hidden="true">·</span>
                    <a href="#privacidad" class="hover:text-[#075638]">Aviso de Privacidad</a>
                    <span aria-hidden="true">·</span>
                    <a href="#soporte" class="hover:text-[#075638]">Mesa de Soporte</a>
                </nav>
            </footer>
        </div>
    </main>
@endsection