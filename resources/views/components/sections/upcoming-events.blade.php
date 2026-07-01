@props([
    'events' => collect(),
    'whatsapp' => '',
])

@php
    use Illuminate\Support\Str;

    $defaultMessage = "Hola Maestro Ramcen.\n\nMe interesa el evento:\n:event.\n\n¿Podría darme información y decirme si aún hay lugares disponibles?";
    $emptyMessage = rawurlencode('Hola Maestro Ramcen. Quiero conocer las próximas fechas de eventos en el santuario.');
@endphp

<section
    id="eventos"
    class="upcoming-events section-ambient py-28 lg:py-40"
    x-data="{ selected: null, open(event) { this.selected = event; this.$nextTick(() => document.body.classList.add('overflow-hidden')) }, close() { this.selected = null; document.body.classList.remove('overflow-hidden') } }"
    x-on:keydown.escape.window="close()"
>
    <div class="mx-auto w-full max-w-[1480px] px-5 lg:px-8">
        <div class="upcoming-events-header mx-auto max-w-5xl text-center">
            <p class="eyebrow upcoming-events-label">Próximos eventos</p>
            <h2 class="section-title upcoming-events-title mx-auto max-w-[900px]" aria-label="Vive la experiencia del santuario.">
                <span>Vive la experiencia</span>
                <span>del santuario.</span>
            </h2>
            <p class="upcoming-events-copy mx-auto mt-7 max-w-2xl text-lg leading-8 text-warm/66">
                Cada encuentro es una experiencia distinta. Consulta las próximas actividades y reserva tu lugar.
            </p>
        </div>

        @if ($events->isNotEmpty())
            <div class="events-scroll mt-16 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($events as $event)
                    @php
                        $date = $event->event_date;
                        $dayName = $date ? Str::upper($date->locale('es')->translatedFormat('l')) : 'FECHA';
                        $dayNumber = $date ? $date->format('d') : '--';
                        $monthName = $date ? Str::upper($date->locale('es')->translatedFormat('M')) : 'PRÓX.';
                        $fullDate = $date ? $date->locale('es')->translatedFormat('d \d\e F \d\e Y') : 'Fecha por confirmar';
                        $startTime = $event->start_time ? Str::of($event->start_time)->substr(0, 5)->toString() : null;
                        $endTime = $event->end_time ? Str::of($event->end_time)->substr(0, 5)->toString() : null;
                        $schedule = $startTime && $endTime ? "{$startTime} - {$endTime}" : ($startTime ?: 'Horario por confirmar');
                        $message = str_replace(':event', $event->title, $defaultMessage);
                        $whatsappUrl = "https://wa.me/{$whatsapp}?text=".rawurlencode($message);
                        $payload = [
                            'title' => $event->title,
                            'image' => $event->image ? asset($event->image) : null,
                            'date' => $fullDate,
                            'schedule' => $schedule,
                            'location' => $event->location ?: 'Santuario Ceam Ramcen',
                            'description' => $event->description ?: ($event->subtitle ?: ''),
                            'price' => $event->price,
                            'whatsappUrl' => $whatsappUrl,
                        ];
                    @endphp

                    <article class="event-card" x-on:click="open(@js($payload))" tabindex="0" role="button" x-on:keydown.enter.prevent="open(@js($payload))">
                        <div class="event-image-wrap">
                            @if ($event->image)
                                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="event-image" loading="lazy">
                            @else
                                <div class="event-image event-image-placeholder" aria-hidden="true"></div>
                            @endif
                            <span class="event-day-badge">{{ $dayName }}</span>
                            <span class="event-date-badge">
                                <strong>{{ $dayNumber }}</strong>
                                <small>{{ $monthName }}</small>
                            </span>
                        </div>

                        <div class="event-body">
                            <div class="event-meta">
                                <span>{{ $fullDate }}</span>
                                <span>{{ $schedule }}</span>
                            </div>
                            <h3>{{ $event->title }}</h3>
                            <p class="event-location">{{ $event->location ?: 'Santuario Ceam Ramcen' }}</p>
                            @if ($event->price)
                                <p class="event-price">Donación sugerida: {{ $event->price }}</p>
                            @endif
                            <p class="event-description">{{ Str::limit($event->description ?: ($event->subtitle ?: ''), 142) }}</p>
                            <a href="{{ $whatsappUrl }}" target="_blank" class="event-button" x-on:click.stop>Reservar por WhatsApp</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="event-empty mx-auto mt-16 max-w-3xl text-center">
                <p class="eyebrow">Agenda en preparación</p>
                <h3>Próximamente nuevas experiencias.</h3>
                <p>Estamos preparando nuevas actividades para el santuario. Síguenos o contáctanos para conocer las próximas fechas.</p>
                <a href="https://wa.me/{{ $whatsapp }}?text={{ $emptyMessage }}" target="_blank" class="premium-button magnetic-button mt-8">Hablar por WhatsApp</a>
            </div>
        @endif
    </div>

    <div
        x-show="selected"
        x-cloak
        x-transition.opacity.duration.300ms
        class="event-modal fixed inset-0 z-[80] grid place-items-center px-5 py-8"
        aria-modal="true"
        role="dialog"
    >
        <button type="button" class="event-modal-backdrop absolute inset-0" x-on:click="close()" aria-label="Cerrar"></button>

        <div
            x-show="selected"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="event-modal-panel relative z-10 w-full max-w-5xl overflow-hidden"
        >
            <div class="event-modal-grid">
                <div class="event-modal-media">
                    <template x-if="selected?.image">
                        <img :src="selected.image" :alt="selected.title" class="event-modal-image">
                    </template>
                    <template x-if="!selected?.image">
                        <div class="event-modal-image event-image-placeholder"></div>
                    </template>
                </div>

                <div class="event-modal-content">
                    <p class="eyebrow">Próximo evento</p>
                    <h3 x-text="selected?.title"></h3>
                    <div class="event-modal-meta">
                        <p><span>Fecha</span><strong x-text="selected?.date"></strong></p>
                        <p><span>Horario</span><strong x-text="selected?.schedule"></strong></p>
                        <p><span>Ubicación</span><strong x-text="selected?.location"></strong></p>
                        <template x-if="selected?.price">
                            <p><span>Donación</span><strong x-text="selected.price"></strong></p>
                        </template>
                    </div>
                    <p class="event-modal-description" x-text="selected?.description"></p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a :href="selected?.whatsappUrl" target="_blank" class="premium-button">Reservar por WhatsApp</a>
                        <button type="button" class="secondary-button" x-on:click="close()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
