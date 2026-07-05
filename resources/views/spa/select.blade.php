<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#06120F">
    <meta name="color-scheme" content="dark">
    <meta name="robots" content="noindex, nofollow">

    <title>Spa Holístico · Mérida · Elige tu experiencia</title>
    <meta name="description" content="Un espacio de bienestar integral donde el equilibrio del cuerpo, mente y espíritu se encuentran. Elige tu experiencia: spa mixto o solo hombres.">

    {{-- Precarga de la imagen del fondo para evitar pop-in --}}
    <link rel="preload" as="image" href="{{ asset('images/ramcen/spa-holistico-merida.png') }}" media="(min-width: 768px)">
    <link rel="preload" as="image" href="{{ asset('images/ramcen/spa-holistico-merida-m.png') }}" media="(max-width: 767px)">

    {{-- Estilos y JS de esta pantalla (Vite) --}}
    @vite(['resources/css/spa-select.css', 'resources/js/spa-select.js'], 'build')
</head>
<body class="spa-body">

    {{--
        PANTALLA SPLASH — Selección de experiencia Spa Holístico
        Estructura semántica:
          - main > header (eyebrow + divider + título + subtítulo + descripción)
                  > nav (cta-label + tarjetas)
                  > footer (4 pilares)
        No se usa ningún framework CSS ni JS. Solo HTML + CSS + un módulo ES ligero
        para manejo de teclado y feedback de click (todo lo demás es CSS puro).
    --}}

    <main class="spa-splash" role="main" aria-labelledby="spa-splash-title">

        {{-- FONDO con imagen real y animación de zoom lenta --}}
        <div class="spa-bg" aria-hidden="true"></div>

        {{-- Overlay para mejorar legibilidad --}}
        <div class="spa-overlay" aria-hidden="true"></div>

        {{-- Viñeta sutil superior e inferior para fundir el contenido --}}
        <div class="spa-vignette spa-vignette--top" aria-hidden="true"></div>
        <div class="spa-vignette spa-vignette--bottom" aria-hidden="true"></div>

        {{-- LOGO Ramcen (esquina superior izquierda, estilo resort 5★) --}}
        <a href="{{ url('/') }}" class="spa-logo" aria-label="Ramcen — ir al inicio">
            <img
                src="{{ asset('images/ramcen/logo ramcen (500 x 500 px).png') }}"
                alt="Ramcen — Bienestar, Equilibrio, Renovación"
                width="500"
                height="500"
                loading="eager"
                decoding="async"
            >
        </a>

        {{-- CONTENIDO principal --}}
        <div class="spa-stage">

            {{-- HEADER: identidad --}}
            <header class="spa-header">

                <p class="spa-eyebrow">
                    <span>Bienestar</span>
                    <span class="spa-eyebrow__sep" aria-hidden="true">•</span>
                    <span>Equilibrio</span>
                    <span class="spa-eyebrow__sep" aria-hidden="true">•</span>
                    <span>Renovación</span>
                </p>

                <div class="spa-divider" role="presentation" aria-hidden="true">
                    <span class="spa-divider__line"></span>
                    <svg class="spa-divider__leaf" viewBox="0 0 24 12" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 1c-3.2 1.6-5 4-5 6.6 0 1.3.7 2.4 1.6 2.4 1.4 0 2.7-1.3 3.4-3 .7 1.7 2 3 3.4 3 .9 0 1.6-1.1 1.6-2.4 0-2.6-1.8-5-5-6.6Z"/>
                        <path d="M12 1v10"/>
                    </svg>
                    <span class="spa-divider__line"></span>
                </div>

                <p class="spa-title">Spa Holístico</p>

                <h1 id="spa-splash-title" class="spa-name">
                    <span class="spa-name__word">Mixto</span>
                </h1>

                <p class="spa-tag">
                    <span class="spa-tag__word">Hombres</span>
                    <span class="spa-tag__amp" aria-hidden="true">&amp;</span>
                    <span class="spa-tag__word">Mujeres</span>
                </p>

                <p class="spa-description">
                    Un espacio de bienestar integral donde el equilibrio del cuerpo,
                    mente y espíritu se encuentran.
                </p>

            </header>

            {{-- NAV: selector de experiencia (las dos tarjetas premium) --}}
            <nav class="spa-cta" aria-label="Elige tu experiencia de spa">

                <p class="spa-cta__label">
                    <span class="spa-cta__line" aria-hidden="true"></span>
                    <span>Elige tu experiencia</span>
                    <span class="spa-cta__line" aria-hidden="true"></span>
                </p>

                <div class="spa-cards">

                    {{-- TARJETA 1 · MIXTO --}}
                    <button
                        type="button"
                        class="spa-card spa-card--mixto"
                        data-spa-target="{{ url('/inicio') }}"
                        data-spa-label="Spa Holístico Mixto"
                        aria-label="Ir al inicio — Spa Holístico Mixto, hombres y mujeres"
                    >
                        <span class="spa-card__shine" aria-hidden="true"></span>
                        <span class="spa-card__glow" aria-hidden="true"></span>

                        <span class="spa-card__inner">
                            <span class="spa-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 64 32" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="18" cy="11" r="3.6"/>
                                    <path d="M10 25c0-3.4 3.6-5.6 8-5.6s8 2.2 8 5.6"/>
                                    <circle cx="46" cy="11" r="3.6"/>
                                    <path d="M38 25c0-3.4 3.6-5.6 8-5.6s8 2.2 8 5.6"/>
                                </svg>
                            </span>

                            <span class="spa-card__eyebrow">Spa Holístico</span>
                            <span class="spa-card__title">Mixto</span>
                            <span class="spa-card__sub">Hombres &amp; Mujeres</span>

                            <span class="spa-card__cta">
                                <span>Descubrir</span>
                                <svg viewBox="0 0 24 12" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" aria-hidden="true">
                                    <path d="M2 6h19M16 1l5 5-5 5"/>
                                </svg>
                            </span>
                        </span>
                    </button>

                    {{-- TARJETA 2 · SOLO HOMBRES --}}
                    <button
                        type="button"
                        class="spa-card spa-card--hombres"
                        data-spa-target="{{ url('/inicio') }}"
                        data-spa-label="Spa Holístico Solo Hombres"
                        aria-label="Ir al inicio — Spa Holístico Solo Hombres, experiencia exclusiva"
                    >
                        <span class="spa-card__shine" aria-hidden="true"></span>
                        <span class="spa-card__glow" aria-hidden="true"></span>

                        <span class="spa-card__inner">
                            <span class="spa-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="16" cy="10" r="4"/>
                                    <path d="M6 26c0-4.4 4.5-7.2 10-7.2s10 2.8 10 7.2"/>
                                </svg>
                            </span>

                            <span class="spa-card__eyebrow">Spa Holístico</span>
                            <span class="spa-card__title">Solo Hombres</span>
                            <span class="spa-card__sub">Experiencia exclusiva</span>

                            <span class="spa-card__cta">
                                <span>Descubrir</span>
                                <svg viewBox="0 0 24 12" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" aria-hidden="true">
                                    <path d="M2 6h19M16 1l5 5-5 5"/>
                                </svg>
                            </span>
                        </span>
                    </button>

                </div>
            </nav>

            {{-- FOOTER: 4 pilares --}}
            <footer class="spa-pillars" aria-label="Pilares del santuario">

                <ul class="spa-pillars__list">
                    <li class="spa-pillar">
                        <span class="spa-pillar__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12c2.5-3 6-3 8.5 0M11 12c2.5-3 6-3 8.5 0"/>
                                <circle cx="4.5" cy="12" r="1.6"/>
                                <circle cx="19.5" cy="12" r="1.6"/>
                            </svg>
                        </span>
                        <span class="spa-pillar__label">Conexión</span>
                    </li>

                    <li class="spa-pillar">
                        <span class="spa-pillar__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10Z"/>
                                <path d="M9 11h2v-2h2v2h2"/>
                            </svg>
                        </span>
                        <span class="spa-pillar__label">Sanación</span>
                    </li>

                    <li class="spa-pillar">
                        <span class="spa-pillar__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3v18"/>
                                <path d="M3 12h18"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </span>
                        <span class="spa-pillar__label">Equilibrio</span>
                    </li>

                    <li class="spa-pillar">
                        <span class="spa-pillar__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3c4 4 6 7 6 10a6 6 0 0 1-12 0c0-3 2-6 6-10Z"/>
                                <path d="M12 13v6"/>
                            </svg>
                        </span>
                        <span class="spa-pillar__label">Renovación</span>
                    </li>
                </ul>
            </footer>

        </div>

        {{-- Marca sutil abajo a la derecha --}}
        <p class="spa-brand" aria-hidden="true">Ramcen · Yucatán</p>

    </main>

</body>
</html>