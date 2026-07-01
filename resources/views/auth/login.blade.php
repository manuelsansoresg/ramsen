@extends('layouts.app')

@section('title', 'Acceso | Maestro Ramcen')
@section('description', 'Acceso privado al panel de Maestro Ramcen.')

@section('content')
<main class="auth-page min-h-screen">
    <div class="auth-bg" aria-hidden="true"></div>
    <section class="relative z-10 mx-auto grid min-h-screen w-full max-w-6xl items-center px-5 py-24 lg:grid-cols-[0.9fr_0.72fr] lg:gap-16 lg:px-8">
        <div class="hidden lg:block">
            <p class="eyebrow">Santuario privado</p>
            <h1 class="mt-5 font-display text-6xl uppercase leading-[1.05] text-warm">Acceso al espacio interior.</h1>
            <p class="mt-7 max-w-lg text-lg leading-8 text-warm/68">Un panel reservado para administrar la presencia digital del Santuario Ceam Ramcen.</p>
        </div>

        <div class="auth-card">
            <a href="{{ url('/') }}" class="font-display text-lg uppercase tracking-[0.22em] text-gold">Ramcen</a>
            <h2 class="mt-10 font-display text-4xl uppercase leading-tight text-warm">Iniciar sesión</h2>
            <p class="mt-3 text-sm leading-6 text-warm/58">Ingresa con tus credenciales para continuar.</p>

            <form method="POST" action="{{ route('login.store') }}" class="mt-9 space-y-5">
                @csrf

                <label class="block">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-gold">Correo</span>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        class="auth-input mt-3"
                    >
                </label>

                <label class="block">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-gold">Contraseña</span>
                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="auth-input mt-3"
                    >
                </label>

                <label class="flex items-center gap-3 text-sm text-warm/68">
                    <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-gold/40 bg-ink text-gold focus:ring-gold">
                    Mantener sesión iniciada
                </label>

                @error('email')
                    <p class="rounded-lg border border-red-300/20 bg-red-500/10 px-4 py-3 text-sm text-red-100">{{ $message }}</p>
                @enderror

                <button type="submit" class="premium-button w-full">Entrar</button>
            </form>
        </div>
    </section>
</main>
@endsection
