@extends('layouts.app')

@section('title', 'Empresas | SIRA')

@section('content')
    <div class="min-h-screen bg-background lg:grid lg:grid-cols-[15rem_minmax(0,1fr)]">
        <x-app-sidebar />
        <main class="min-w-0 px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-label-sm text-primary-container">SIRA / OPERACIONES</p>
            <h1 class="mt-1 font-display text-headline-lg text-on-surface sm:text-display-lg-mobile">Empresas</h1>
            <p class="mt-2 text-body-md text-on-surface-variant">Directorio de generadores, transportistas y gestores autorizados.</p>
            <section class="mt-6 rounded-lg border border-outline-variant bg-surface-container-lowest p-8 text-center" aria-label="Directorio de empresas vacío">
                <p class="text-label-md text-on-surface">Aún no hay empresas registradas</p>
                <p class="mt-1 text-body-sm text-on-surface-variant">Las empresas se mostrarán aquí cuando se creen sus registros.</p>
            </section>
        </main>
    </div>
@endsection