@extends('layouts.app')

@section('title', 'Experiencias | Panel Maestro Ramcen')

@section('content')
<main class="min-h-screen bg-ink px-5 py-24 text-warm lg:px-8">
    <section class="mx-auto max-w-7xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="eyebrow">Administración</p>
                <h1 class="mt-4 font-display text-5xl uppercase leading-tight">Experiencias</h1>
                <p class="mt-3 text-warm/60">Gestiona las próximas experiencias visibles en el sitio.</p>
            </div>
            <a href="{{ route('admin.experiences.create') }}" class="premium-button">Nueva experiencia</a>
        </div>

        @if (session('success'))
            <div class="mt-8 rounded-lg border border-gold/25 bg-gold/10 px-5 py-4 text-sm text-warm">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-10 overflow-hidden rounded-lg border border-white/10 bg-white/[0.03]">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead class="border-b border-white/10 text-xs uppercase tracking-[0.18em] text-gold">
                        <tr>
                            <th class="px-5 py-4">Imagen</th>
                            <th class="px-5 py-4">Título</th>
                            <th class="px-5 py-4">Fecha</th>
                            <th class="px-5 py-4">Horario</th>
                            <th class="px-5 py-4">Estado</th>
                            <th class="px-5 py-4">Destacada</th>
                            <th class="px-5 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 text-warm/75">
                        @forelse ($experiences as $experience)
                            <tr>
                                <td class="px-5 py-4">
                                    @if ($experience->image)
                                        <img src="{{ asset($experience->image) }}" alt="{{ $experience->title }}" class="h-14 w-20 rounded-md object-cover">
                                    @else
                                        <div class="flex h-14 w-20 items-center justify-center rounded-md border border-white/10 bg-white/5 text-xs text-warm/40">Sin imagen</div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-warm">{{ $experience->title }}</div>
                                    <div class="mt-1 text-xs text-warm/45">{{ $experience->location ?: 'Sin ubicación' }}</div>
                                </td>
                                <td class="px-5 py-4">{{ $experience->event_date?->format('d/m/Y') ?: 'Sin fecha' }}</td>
                                <td class="px-5 py-4">
                                    @if ($experience->start_time || $experience->end_time)
                                        {{ $experience->start_time ? substr($experience->start_time, 0, 5) : '--:--' }}
                                        -
                                        {{ $experience->end_time ? substr($experience->end_time, 0, 5) : '--:--' }}
                                    @else
                                        Sin horario
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full border border-gold/25 px-3 py-1 text-xs uppercase tracking-[0.14em] text-gold">{{ $experience->status }}</span>
                                </td>
                                <td class="px-5 py-4">{{ $experience->is_featured ? 'Sí' : 'No' }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.experiences.edit', $experience) }}" class="secondary-button min-h-0 px-4 py-2 text-xs">Editar</a>
                                        <form method="POST" action="{{ route('admin.experiences.destroy', $experience) }}" onsubmit="return confirm('¿Eliminar esta experiencia?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full border border-red-300/30 px-4 py-2 text-xs font-bold uppercase tracking-[0.14em] text-red-100 transition hover:bg-red-500/20">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center text-warm/55">No hay experiencias registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $experiences->links() }}
        </div>
    </section>
</main>
@endsection
