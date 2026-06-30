@extends('layouts.app')

@section('content')
@php
    $waText = rawurlencode('Hola Maestro Ramcen, quiero agendar una experiencia en el santuario.');
    $waUrl = "https://wa.me/{$whatsapp}?text={$waText}";
    $experiences = [
        ['Ceremonia maya', 'Ritual privado de conexión, limpieza energética y sanación profunda.', 'Fuego', 'M12 3.5c2.9 3 4.8 5.9 4.8 8.3A4.8 4.8 0 0 1 8.4 15c0-2.4 1.7-5.2 3.6-7.1Zm0 4.2c-.8 1.3-1.4 2.5-1.4 3.8a1.4 1.4 0 1 0 2.8 0c0-1.3-.6-2.5-1.4-3.8Z'],
        ['Agua y spa holístico', 'Descanso, presencia y bienestar físico en un entorno de naturaleza.', 'Agua', 'M4 14c2 1.7 4 1.7 6 0s4-1.7 6 0 4 1.7 6 0v3c-2 1.7-4 1.7-6 0s-4-1.7-6 0-4 1.7-6 0v-3Zm0-6c2 1.7 4 1.7 6 0s4-1.7 6 0 4 1.7 6 0v3c-2 1.7-4 1.7-6 0s-4-1.7-6 0-4 1.7-6 0V8Z'],
        ['Vapor ceremonial', 'Purificación, desintoxicación y renovación con calor, piedra y respiración.', 'Vapor', 'M8 16h8M6 20h12M9 12c-1.2-1.1-1.2-2.7 0-3.8 1.2-1.1 1.2-2.7 0-3.8m6 7.6c-1.2-1.1-1.2-2.7 0-3.8 1.2-1.1 1.2-2.7 0-3.8'],
        ['Hipnosis y mente', 'Reprogramación mental para transformar patrones y abrir respuestas internas.', 'Mente', 'M12 4a8 8 0 1 0 8 8h-4a4 4 0 1 1-4-4V4Zm0 0v4h4'],
        ['Terapias integrales', 'Acompañamiento corporal y emocional con enfoque profundo y personalizado.', 'Cuerpo', 'M12 21s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.6-7 10-7 10Z'],
        ['Piscina santuario', 'Agua, energía y silencio para regresar al cuerpo desde un estado de paz.', 'Selva', 'M3 18c2.2 0 2.2-1.5 4.4-1.5S9.6 18 11.8 18s2.2-1.5 4.4-1.5S18.4 18 21 18M5 12l4-7 4 7m-8 0h8'],
    ];
    $gallery = [
        ['hero-maya-sanctuary-editorial.jpg', 'Santuario maya entre selva, agua cristalina y niebla al amanecer', 'large'],
        ['sanctuary-stone-vapor-editorial.jpg', 'Piedra húmeda, vapor ceremonial y luz dorada entrando entre árboles', 'tall'],
        ['gallery-jungle-water-editorial.jpg', 'Agua quieta rodeada de vegetación profunda en un retiro espiritual', 'wide'],
        ['experiences-fire-ritual-editorial.jpg', 'Detalle ceremonial de fuego, madera y manos preparando una experiencia maya', 'small'],
    ];
    $faqs = [
        ['¿Necesito experiencia previa?', 'No. Cada proceso se guía según tu momento, intención y apertura personal.'],
        ['¿Cómo reservo?', 'El canal principal es WhatsApp. Ahí se confirma disponibilidad, intención y recomendaciones previas.'],
        ['¿Qué debo llevar?', 'Ropa cómoda, traje de baño si usarás piscina o vapor, agua y disposición para vivir la experiencia.'],
        ['¿Dónde está el santuario?', 'En la zona de Komchén, Yucatán. La ubicación exacta se comparte al confirmar tu visita.'],
    ];
@endphp

<main x-data="{ menuOpen: false }" class="site-shell overflow-hidden">
    <nav class="floating-nav fixed left-1/2 top-4 z-50 w-[calc(100%-1.5rem)] max-w-6xl -translate-x-1/2 transition-all duration-500">
        <div class="nav-inner flex items-center justify-between px-5 py-4 transition-all duration-500 lg:px-6">
            <a href="#inicio" class="font-display text-base uppercase tracking-[0.22em] text-gold">Ramcen</a>
            <div class="hidden items-center gap-8 text-sm text-warm/72 md:flex">
                <a class="nav-link" href="#filosofia">Filosofía</a>
                <a class="nav-link" href="#experiencias">Experiencias</a>
                <a class="nav-link" href="#santuario">Santuario</a>
                <a class="nav-link" href="#contacto">Contacto</a>
            </div>
            <a href="{{ $waUrl }}" target="_blank" class="hidden rounded-full border border-gold/40 px-5 py-2 text-xs font-bold uppercase tracking-[0.18em] text-gold transition hover:bg-gold hover:text-ink md:inline-flex">WhatsApp</a>
            <button class="md:hidden" type="button" x-on:click="menuOpen = !menuOpen" aria-label="Abrir menú">
                <span class="block h-px w-7 bg-gold"></span>
                <span class="mt-2 block h-px w-7 bg-gold"></span>
            </button>
        </div>
        <div x-show="menuOpen" x-transition class="mx-2 rounded-b-2xl border border-white/10 border-t-0 bg-ink/90 px-5 py-5 backdrop-blur-xl md:hidden">
            <div class="grid gap-4 text-warm/80">
                <a href="#filosofia" x-on:click="menuOpen = false">Filosofía</a>
                <a href="#experiencias" x-on:click="menuOpen = false">Experiencias</a>
                <a href="#santuario" x-on:click="menuOpen = false">Santuario</a>
                <a href="#contacto" x-on:click="menuOpen = false">Contacto</a>
            </div>
        </div>
    </nav>

    <section id="inicio" class="hero-scene relative min-h-[100svh]">
        <picture class="hero-photo absolute inset-0 block">
            <source media="(max-width: 767px)" srcset="{{ asset('images/ramcen/hero-movil.png') }}">
            <img src="{{ asset('images/ramcen/hero.png') }}" alt="Santuario maya en la selva con agua, vapor y luz dorada" class="h-full w-full object-cover">
        </picture>
        <div class="hero-depth absolute inset-0"></div>
        <div class="ambient-light absolute inset-0"></div>
        <div class="particle-field absolute inset-0" aria-hidden="true"></div>
        <div class="relative z-10 mx-auto flex min-h-[100svh] max-w-7xl items-end px-5 pb-12 pt-36 lg:px-8 lg:pb-20">
            <div class="hero-copy max-w-[760px]">
                <p class="reveal-line mb-6 text-xs font-bold uppercase tracking-[0.32em] text-gold">Santuario</p>
                <h1 class="hero-title reveal-title font-display text-warm">Vuelve a tu centro.</h1>
                <p class="reveal mt-7 max-w-2xl text-lg leading-8 text-warm/76 md:text-xl md:leading-9">Regálate un espacio para desconectarte del ruido, respirar profundamente y reencontrarte contigo mismo.</p>
                <div class="reveal mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ $waUrl }}" target="_blank" class="premium-button magnetic-button">Iniciar mi experiencia</a>
                    <a href="#filosofia" class="secondary-button magnetic-button">Conocer más</a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-8 right-5 z-10 hidden max-w-xs border-l border-gold/35 pl-5 text-sm leading-7 text-warm/62 md:block">
            Luz, agua, selva y silencio para iniciar un proceso profundo.
        </div>
    </section>

    <section id="filosofia" class="section-2 section-ambient">
        <div class="section-2-particles" aria-hidden="true"></div>
        <div class="section-2-glow" aria-hidden="true"></div>
        <div class="section-2-inner">
            <div class="section-2-content">
                <p class="eyebrow section-2-label">Nuestra filosofía</p>
                <h2 class="section-title max-w-[740px]" aria-label="Todo cambio comienza desde adentro.">
                    <span class="section-2-title-line">Todo cambio</span>
                    <span class="section-2-title-line">comienza</span>
                    <span class="section-2-title-line">desde adentro.</span>
                </h2>
                <div class="section-2-rule" aria-hidden="true"></div>
                <p class="section-2-copy">Cada persona tiene un proceso distinto. Nuestro propósito es acompañarlo con respeto, naturaleza y presencia.</p>
            </div>
            <div class="section-2-divider" aria-hidden="true"></div>
            <div class="section-2-image-shell">
                <img src="{{ asset('images/ramcen/ramcen.png') }}" alt="Maestro Ramcen en un entorno natural" class="section-2-image" loading="lazy">
            </div>
        </div>
    </section>

    <section id="experiencias" class="experiences-section section-ambient py-28 lg:py-40">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="reveal mx-auto max-w-4xl text-center">
                <p class="eyebrow">Experiencias</p>
                <h2 class="section-title mx-auto max-w-[920px]">Rituales de agua, vapor, cuerpo y mente.</h2>
            </div>
            <div class="mt-16 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($experiences as $item)
                    <article class="experience-card reveal-card" data-image-placeholder="experiences-{{ Str::slug($item[0]) }}-editorial.jpg">
                        <div class="experience-glow"></div>
                        <svg viewBox="0 0 24 24" class="experience-icon" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="{{ $item[3] }}" />
                        </svg>
                        <span>{{ $item[2] }}</span>
                        <h3>{{ $item[0] }}</h3>
                        <p>{{ $item[1] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="santuario" class="sanctuary-section py-28 lg:py-40">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid items-end gap-10 lg:grid-cols-[1.05fr_0.75fr]">
                <div class="reveal">
                    <p class="eyebrow">Santuario</p>
                    <h2 class="section-title max-w-[880px]">Un refugio de selva, piedra, vapor y agua.</h2>
                </div>
                <p class="reveal max-w-md text-lg leading-8 text-warm/62">La galería abandona el lenguaje de flyer y entra en un territorio editorial: calma, textura, misterio y deseo de estar ahí.</p>
            </div>

            <div class="masonry-gallery mt-16">
                @foreach ($gallery as $image)
                    <figure class="gallery-tile gallery-{{ $image[2] }} reveal-image">
                        <div class="editorial-photo gallery-photo" data-image-placeholder="{{ $image[0] }}"></div>
                        <figcaption>{{ $image[1] }}</figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <section class="testimonials-section py-28 text-ink lg:py-36">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="reveal max-w-3xl">
                <p class="eyebrow text-jade">Testimonios</p>
                <h2 class="section-title max-w-[760px] text-ink">Lo que cambia se siente primero por dentro.</h2>
            </div>
            <div class="mt-12 grid gap-5 md:grid-cols-3">
                @foreach (['Llegué con ansiedad y salí con claridad. El lugar se siente profundamente cuidado.', 'La ceremonia fue íntima, fuerte y muy humana. Sentí confianza desde el inicio.', 'El vapor y la guía mental me ayudaron a soltar tensión que llevaba meses cargando.'] as $quote)
                    <blockquote class="reveal testimonial">“{{ $quote }}”</blockquote>
                @endforeach
            </div>
        </div>
    </section>

    <section class="faq-section section-ambient py-28 lg:py-36">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 lg:grid-cols-[0.72fr_1fr] lg:px-8">
            <div class="reveal">
                <p class="eyebrow">Preguntas</p>
                <h2 class="section-title max-w-[620px]">Antes de llegar al santuario.</h2>
            </div>
            <div class="space-y-4">
                @foreach ($faqs as $faq)
                    <details class="reveal faq-item">
                        <summary>{{ $faq[0] }}</summary>
                        <p>{{ $faq[1] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contacto" class="contact-section relative px-5 py-28 lg:px-8 lg:py-40">
        <div class="editorial-photo contact-photo absolute inset-0" data-image-placeholder="contact-evening-sanctuary-editorial.jpg"></div>
        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(5,10,8,.84),rgba(5,10,8,.58),rgba(5,10,8,.9))]"></div>
        <div class="relative z-10 mx-auto max-w-5xl text-center">
            <p class="reveal eyebrow">Contacto</p>
            <h2 class="reveal section-title mx-auto max-w-[850px]">Tu proceso empieza con un mensaje.</h2>
            <p class="reveal mx-auto mt-7 max-w-2xl text-lg leading-8 text-warm/70">Sábados de 11:11 AM a 11:11 PM. Ubicación en Komchén, Yucatán. Agenda por WhatsApp para confirmar disponibilidad.</p>
            <div class="reveal mt-10 flex flex-col items-center gap-4">
                <a href="{{ $waUrl }}" target="_blank" class="premium-button magnetic-button">Hablar por WhatsApp</a>
                <span class="text-sm uppercase tracking-[0.28em] text-gold">{{ $phoneLabel }}</span>
            </div>
        </div>
    </section>

    <a href="{{ $waUrl }}" target="_blank" class="fixed bottom-5 right-5 z-50 rounded-full bg-[#25D366] px-5 py-4 text-xs font-black uppercase tracking-[0.14em] text-ink shadow-2xl shadow-black/40 transition hover:-translate-y-1">WhatsApp</a>
</main>
@endsection
