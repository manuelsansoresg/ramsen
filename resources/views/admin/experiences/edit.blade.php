@extends('layouts.app')

@section('title', 'Editar experiencia | Panel Maestro Ramcen')

@section('content')
<main class="min-h-screen bg-ink px-5 py-24 text-warm lg:px-8">
    <section class="mx-auto max-w-5xl">
        <p class="eyebrow">Experiencias</p>
        <h1 class="mt-4 font-display text-5xl uppercase leading-tight">Editar experiencia</h1>

        <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" enctype="multipart/form-data" class="mt-10">
            @csrf
            @method('PUT')
            @include('admin.experiences.form')
        </form>
    </section>
</main>
@endsection
