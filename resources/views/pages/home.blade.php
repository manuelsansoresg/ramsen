@extends('layouts.app')

@section('content')
@php
    $waText = rawurlencode('Hola Maestro Ramcen, quiero agendar una experiencia en el santuario.');
    $waUrl = "https://wa.me/{$whatsapp}?text={$waText}";
    $testimonialWaText = rawurlencode('Hola Maestro Ramcen, vi los testimonios en su sitio web y me gustaría recibir información para iniciar mi proceso.');
    $testimonialWaUrl = "https://wa.me/{$whatsapp}?text={$testimonialWaText}";
    $services = [
        ['CEREMONIAS', 'Rituales privados inspirados en la tradición maya para acompañar procesos de transformación, conexión y equilibrio interior.', 'Ceremonial', 'service-ceremonies', 'M12 3.5c2.9 3 4.8 5.9 4.8 8.3A4.8 4.8 0 0 1 8.4 15c0-2.4 1.7-5.2 3.6-7.1Zm0 4.2c-.8 1.3-1.4 2.5-1.4 3.8a1.4 1.4 0 1 0 2.8 0c0-1.3-.6-2.5-1.4-3.8Z'],
        ['PISCINA', 'Una experiencia de agua, descanso y naturaleza diseñada para recuperar la energía física y mental.', 'Agua', 'service-spa', 'M4 14c2 1.7 4 1.7 6 0s4-1.7 6 0 4 1.7 6 0v3c-2 1.7-4 1.7-6 0s-4-1.7-6 0-4 1.7-6 0v-3Zm0-6c2 1.7 4 1.7 6 0s4-1.7 6 0 4 1.7 6 0v3c-2 1.7-4 1.7-6 0s-4-1.7-6 0-4 1.7-6 0V8Z'],
        ['VAPOR', 'Sesiones de vapor orientadas a la purificación, relajación y renovación corporal.', 'Vapor', 'service-steam', 'M8 16h8M6 20h12M9 12c-1.2-1.1-1.2-2.7 0-3.8 1.2-1.1 1.2-2.7 0-3.8m6 7.6c-1.2-1.1-1.2-2.7 0-3.8 1.2-1.1 1.2-2.7 0-3.8'],
        ['REPROGRAMACIÓN MENTAL', 'Acompañamiento para transformar emociones, hábitos y patrones internos hacia mayor equilibrio y claridad.', 'Mente', 'service-reprogramming', 'M9.5 19.5a3 3 0 0 1-3-3V15a3 3 0 0 1-1-5.8A3.2 3.2 0 0 1 8.4 4a3.4 3.4 0 0 1 3.1-2 3.4 3.4 0 0 1 3.1 2 3.2 3.2 0 0 1 2.9 5.2 3 3 0 0 1-1 5.8v1.5a3 3 0 0 1-3 3h-4Zm2-17v17m0-12.5a2.4 2.4 0 0 1-2.4 2.4m2.4 2.1a2.6 2.6 0 0 0-2.6 2.6m2.6-7.1a2.4 2.4 0 0 0 2.4 2.4m-2.4 2.1a2.6 2.6 0 0 1 2.6 2.6'],
        ['CAMPAMENTOS', 'Encuentros en la naturaleza para convivir, reconectar y vivir procesos de crecimiento espiritual en comunidad.', 'Naturaleza', 'service-camps', 'M3 20h18M5 20l7-16 7 16M8 20l4-8 4 8M12 12v8M9 7h6M6.5 17h11'],
        
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
                <a class="nav-link" href="#experiencias">Servicios</a>
                <a class="nav-link" href="#eventos">Eventos</a>
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
                <a href="#experiencias" x-on:click="menuOpen = false">Servicios</a>
                <a href="#eventos" x-on:click="menuOpen = false">Eventos</a>
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
        <div class="hero-bokeh absolute inset-0" aria-hidden="true">
            @for ($i = 1; $i <= 40; $i++)
                <span></span>
            @endfor
        </div>
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

    <section id="experiencias" class="services-section section-ambient py-28 lg:py-40">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mx-auto max-w-5xl text-center">
                <p class="eyebrow services-label">Servicios</p>
                <h2 class="section-title services-title mx-auto max-w-[940px]" aria-label="Un espacio para sanar el cuerpo, la mente y el espíritu.">
                    <span class="services-title-line">Un espacio para</span>
                    <span class="services-title-line">sanar el cuerpo,</span>
                    <span class="services-title-line">la mente y</span>
                    <span class="services-title-line">el espíritu.</span>
                </h2>
                <p class="services-subtitle mx-auto mt-7 max-w-2xl text-lg leading-8 text-warm/66">Cada proceso es diferente. Elige el camino que mejor conecte contigo o permítenos orientarte personalmente.</p>
            </div>
            <div class="services-grid mt-16 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $item)
                    <article class="service-card {{ $item[3] }}">
                        <div class="service-card-image" aria-hidden="true"></div>
                        <div class="service-card-shade" aria-hidden="true"></div>
                        <div class="service-card-glow" aria-hidden="true"></div>
                        <svg viewBox="0 0 24 24" class="service-icon" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="{{ $item[4] }}" />
                        </svg>
                        <div class="service-content">
                            <span>{{ $item[2] }}</span>
                            <h3>{{ $item[0] }}</h3>
                            <p>{{ $item[1] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="services-cta mx-auto mt-16 max-w-3xl text-center">
                <h3>¿No sabes cuál experiencia elegir?</h3>
                <p>Cada persona vive un proceso diferente. Podemos ayudarte a encontrar el servicio más adecuado para ti.</p>
                <a href="{{ $waUrl }}" target="_blank" class="premium-button magnetic-button mt-8">Quiero recibir orientación</a>
            </div>
        </div>
    </section>

    <x-sections.upcoming-events :events="$upcomingExperiences" :whatsapp="$whatsapp" />

    <section class="testimonials-section py-28 text-ink lg:py-40">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="testimonials-heading mx-auto max-w-4xl text-center">
                <p class="eyebrow testimonials-label text-jade">Testimonios</p>
                <h2 class="testimonials-title section-title mx-auto max-w-[760px] text-ink" aria-label="Lo que cambia se siente primero por dentro.">
                    <span>Lo que cambia</span>
                    <span>se siente</span>
                    <span>primero</span>
                    <span>por dentro.</span>
                </h2>
                <p class="testimonials-intro mx-auto">Cada experiencia es distinta, pero todas tienen algo en común: las personas salen con una sensación de calma, claridad y conexión.</p>
            </div>

            @php
                $testimonials = [
                    ['Llegué buscando calma. Me fui con una paz que hacía mucho no sentía.', 'Carlos M.', 'Spa Holístico'],
                    ['Desde el primer momento me sentí bien recibido. Una experiencia auténtica.', 'Laura S', 'Ceremonia Maya'],
                    ['El vapor y la naturaleza me ayudaron a desconectar del estrés diario.', 'Alejandro R.', 'Vapor ceremonial'],
                    ['Más que una actividad, fue un espacio para volver a conectar conmigo.', 'Miguel A.', 'Proceso personal'],
                    ['Llegué con ruido mental y encontré un espacio de calma, respeto y presencia.', 'Fernando L.', 'Reprogramación mental'],
                    ['El santuario se siente cuidado. Todo invita a respirar y soltar.', 'Javier S.', 'Bienestar emocional'],
                    ['Me ayudó a detenerme, respirar y escuchar lo que necesitaba cambiar.', 'Raúl P.', 'Acompañamiento'],
                    ['Salí con el cuerpo ligero y la mente mucho más clara.', 'Carla M.', 'Piscina y vapor'],
                ];
                $testimonialPages = ceil(count($testimonials) / 4);
            @endphp

            <div class="testimonials-carousel-shell mt-16">
                <div class="testimonials-carousel" aria-label="Testimonios del Santuario">
                    @foreach ($testimonials as $testimonial)
                        <blockquote class="testimonial-slide">
                            <div class="testimonial-stars" aria-hidden="true">★★★★★</div>
                            <p>“{{ $testimonial[0] }}”</p>
                            <footer>
                                <strong>{{ $testimonial[1] }}</strong>
                                <span>{{ $testimonial[2] }}</span>
                            </footer>
                        </blockquote>
                    @endforeach
                </div>
                <div class="testimonial-dots" aria-label="Navegación de testimonios">
                    @for ($index = 0; $index < $testimonialPages; $index++)
                        <button type="button" class="{{ $index === 0 ? 'is-active' : '' }}" aria-label="Ver grupo {{ $index + 1 }} de testimonios"></button>
                    @endfor
                </div>
            </div>

            <div class="testimonials-cta mx-auto mt-14 text-center">
                <p>¿Quieres vivir tu propia experiencia?</p>
                <a href="{{ $testimonialWaUrl }}" target="_blank" class="testimonial-button magnetic-button">Reservar por WhatsApp</a>
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
