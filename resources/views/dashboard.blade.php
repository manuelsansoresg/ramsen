@extends('layouts.app')

@section('title', 'Panel | Maestro Ramcen')

@section('content')
<main class="min-h-screen bg-ink px-5 py-24 text-warm lg:px-8">
    <section class="mx-auto max-w-5xl">
        <p class="eyebrow">Panel privado</p>
        <h1 class="mt-5 font-display text-5xl uppercase leading-tight">Bienvenido al panel.</h1>
        <p class="mt-5 max-w-2xl text-warm/65">Sesión iniciada correctamente.</p>

        <div class="mt-10 flex flex-col gap-4 sm:flex-row">
            <a href="{{ route('admin.experiences.index') }}" class="premium-button">Gestionar experiencias</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="secondary-button">Cerrar sesión</button>
            </form>
        </div>
    </section>
</main>
@endsection
