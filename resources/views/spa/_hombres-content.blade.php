{{--
    Partial: contenido dinámico de la experiencia SOLO HOMBRES (Robby Mendez).
    Se inyecta dentro de la home /inicio cuando el parámetro
    `?experiencia=hombres` está presente, reemplazando la
    sección de servicios general.

    Estructura:
      · Splash "estilo Robby Mendez" (foto + título + descripción)
      · La razón principal (por qué salir de la ciudad)
      · Qué incluye el lugar (vapor, piscina, hamacas, nevera, asador, fogata)
      · Reglas (no bocinas, no cigarros)
      · Qué traer (comida, frutas, bebidas, repelente)
      · Horarios (domingos 2–10 PM · 9 PM última hora)
      · Donación sugerida ($100 o más)
      · Servicios opcionales con precios (toalla, sandalias, masajes, baños)
      · Aviso: solo masajes, no escort
      · Video gratuito de activación
      · Cierre con contacto (Robby Mendez · 9993292148)

    Toda la información está en arreglos al inicio para poder
    editar/agregar elementos sin tocar el markup.
--}}

@php
    $waTextHombres = rawurlencode("Hola Robby, quiero información para el SPA SOLO HOMBRES del domingo. ¿Podría confirmarme disponibilidad y cómo apunto mi lugar?");
    $waUrlHombres = "https://wa.me/529993292148?text={$waTextHombres}";

    // ── Qué incluye el lugar ──
    $incluye = [
        ['icon' => 'vapor',     'titulo' => 'Vapor',                  'desc' => 'Sesión de vapor para purificar, relajar y renovar el cuerpo.'],
        ['icon' => 'piscina',   'titulo' => 'Piscina',                'desc' => 'Agua y descanso en medio de la naturaleza para soltar el estrés.'],
        ['icon' => 'hamacas',   'titulo' => 'Área de hamacas',        'desc' => 'Espacios cómodos para descansar, leer o simplemente no hacer nada.'],
        ['icon' => 'nevera',    'titulo' => 'Nevera',                 'desc' => 'Para mantener frescas tus bebidas y alimentos durante la jornada.'],
        ['icon' => 'asador',    'titulo' => 'Asador',                 'desc' => 'Listo para que prepares lo que quieras traer.'],
        ['icon' => 'fogata',    'titulo' => 'Fogata',                 'desc' => 'Para cerrar la tarde con calma, conversación y luz cálida.'],
    ];

    // ── Qué traer ──
    $traer = [
        'Tu comida',
        'Frutas frescas',
        'Bebidas de tu preferencia',
        'Repelente',
        'Todo lo necesario para pasar un domingo completo',
    ];

    // ── Reglas ──
    $reglas = [
        'No se permiten bocinas.',
        'No se permite fumar cigarros.',
    ];

    // ── Servicios opcionales con precios ──
    $opcionales = [
        ['titulo' => 'Toalla',                          'precio' => '$20',  'desc' => 'Para que no tengas que cargarla desde casa.'],
        ['titulo' => 'Sandalias',                       'precio' => '$10',  'desc' => 'Cómodas para estar en el área de vapor y piscina.'],
        ['titulo' => 'Masajes y baños turcos',          'precio' => '$200', 'desc' => 'Un baño de espumas por todo tu cuerpo.'],
        ['titulo' => 'Privados (lun a vier con cita)',  'precio' => '—',    'desc' => 'Sesiones privadas entre semana, únicamente con cita previa.'],
        ['titulo' => 'Baño turco',                      'precio' => '$400', 'desc' => 'Sesión completa de baño turco, con预约.'],
        ['titulo' => 'Masaje especial',                 'precio' => '$500', 'desc' => 'Para activar tu energía sexual: relajante, erótico o para bajar de peso. Tú eliges la intención.'],
        ['titulo' => 'Combo (masaje + baño turco)',     'precio' => '$800', 'desc' => 'Lleva ambos servicios por $100 menos que si los tomas por separado.'],
    ];
@endphp

<div class="hombres-shell">

    {{-- ═══════════════ SPLASH ESTILO ROBBY MENDEZ ═══════════════ --}}
    <section class="hombres-splash" aria-label="Spa Solo Hombres · Robby Mendez · introducción">
        <div class="hombres-splash__bg" aria-hidden="true"></div>
        <div class="hombres-splash__overlay" aria-hidden="true"></div>

        <div class="hombres-splash__inner">
            <div class="hombres-splash__copy">
                <p class="hombres-splash__eyebrow">
                    <span>Bienestar</span>
                    <span class="hombres-splash__sep" aria-hidden="true">•</span>
                    <span>Equilibrio</span>
                    <span class="hombres-splash__sep" aria-hidden="true">•</span>
                    <span>Renovación</span>
                </p>

                <div class="hombres-splash__rule" aria-hidden="true"></div>

                <p class="hombres-splash__pre">Spa Solo Hombres con</p>
                <h1 class="hombres-splash__title">
                    Robby <em>Mendez</em>.
                </h1>

                <p class="hombres-splash__lead">
                    Salirte de la ciudad, dejar el ajetreo y el estrés,
                    y estar en medio de la naturaleza en un terreno grande.
                    Vapor, piscina, hamacas, asador y fogata. Domingos de
                    2 PM a 10 PM. Tú traes la comida, nosotros ponemos el lugar.
                </p>

               
            </div>
        </div>
    </section>

    {{-- ═══════════════ LA RAZÓN PRINCIPAL ═══════════════ --}}
    <section class="hombres-section" aria-label="La razón principal">
        <div class="hombres-section__head">
            <span class="hombres-section__eyebrow">La razón principal</span>
            <h2 class="hombres-section__title">Salirte de la ciudad.</h2>
            <p class="hombres-section__intro">
                La idea es dejar el ajetreo, soltar el estrés y estar en
                medio de la naturaleza, en un terreno grande, sin ruido y
                sin prisa. Un domingo entero para volver a tu centro.
            </p>
        </div>
    </section>

    {{-- ═══════════════ QUÉ INCLUYE ═══════════════ --}}
    <section class="hombres-section hombres-section--alt" aria-label="Qué incluye el lugar">
        <div class="hombres-section__head">
            <span class="hombres-section__eyebrow">Qué incluye</span>
            <h2 class="hombres-section__title">El lugar ya está listo.</h2>
            <p class="hombres-section__intro">
                Vapor, piscina, área de hamacas, nevera, asador y fogata.
                Todo lo necesario para pasar el día completo.
            </p>
        </div>

        <div class="hombres-grid">
            @foreach ($incluye as $item)
                <article class="hombres-feature">
                    <span class="hombres-feature__icon" aria-hidden="true">
                        @switch($item['icon'])
                            @case('vapor')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 16h8M6 20h12M9 12c-1.2-1.1-1.2-2.7 0-3.8 1.2-1.1 1.2-2.7 0-3.8m6 7.6c-1.2-1.1-1.2-2.7 0-3.8 1.2-1.1 1.2-2.7 0-3.8"/>
                                </svg>
                                @break
                            @case('piscina')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 14c2 1.5 4 1.5 6 0s4-1.5 6 0 4 1.5 6 0"/>
                                    <path d="M3 18c2 1.5 4 1.5 6 0s4-1.5 6 0 4 1.5 6 0"/>
                                    <path d="M6 10c1.5 1 3 1 4.5 0M13 10c1.5 1 3 1 4.5 0"/>
                                </svg>
                                @break
                            @case('hamacas')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 14h18"/>
                                    <path d="M5 14c0 3 3 5 7 5s7-2 7-5"/>
                                    <path d="M3 14l1.5-7M21 14l-1.5-7"/>
                                </svg>
                                @break
                            @case('nevera')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="6" y="3" width="12" height="18" rx="2"/>
                                    <path d="M6 10h12"/>
                                    <path d="M9 7v1M9 14v3"/>
                                </svg>
                                @break
                            @case('asador')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="13" r="6"/>
                                    <path d="M12 7V3M9 5l3-2 3 2"/>
                                    <path d="M10 13c0-1 .9-2 2-2s2 1 2 2"/>
                                </svg>
                                @break
                            @case('fogata')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3c2 3 4 5 4 8a4 4 0 0 1-8 0c0-1.5.7-2.5 1.5-3.5C10 9 9 10 9 11"/>
                                    <path d="M8 21h8"/>
                                </svg>
                                @break
                        @endswitch
                    </span>
                    <h3 class="hombres-feature__title">{{ $item['titulo'] }}</h3>
                    <p class="hombres-feature__desc">{{ $item['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════ REGLAS + QUÉ TRAER ═══════════════ --}}
    <section class="hombres-section" aria-label="Reglas y qué traer">
        <div class="hombres-section__head">
            <span class="hombres-section__eyebrow">Reglas y qué traer</span>
            <h2 class="hombres-section__title">Lo que pedimos y lo que tú traes.</h2>
            <p class="hombres-section__intro">
                Para que el lugar se mantenga limpio, en calma y en respeto
                para todos, hay dos reglas muy simples.
            </p>
        </div>

        <div class="hombres-split">
            <article class="hombres-card hombres-card--rules">
                <span class="hombres-card__eyebrow">Reglas</span>
                <ul class="hombres-card__list">
                    @foreach ($reglas as $regla)
                        <li>{{ $regla }}</li>
                    @endforeach
                </ul>
            </article>

            <article class="hombres-card hombres-card--bring">
                <span class="hombres-card__eyebrow">Qué traer</span>
                <ul class="hombres-card__list">
                    @foreach ($traer as $cosa)
                        <li>{{ $cosa }}</li>
                    @endforeach
                </ul>
            </article>
        </div>
    </section>

    {{-- ═══════════════ HORARIOS ═══════════════ --}}
    <section class="hombres-section hombres-section--alt" aria-label="Horarios">
        <div class="hombres-section__head">
            <span class="hombres-section__eyebrow">Horarios</span>
            <h2 class="hombres-section__title">Domingos de 2 PM a 10 PM.</h2>
            <p class="hombres-section__intro">
                La jornada arranca a las <strong>2 PM</strong> y cierra a las
                <strong>10 PM</strong>. La última hora para llegar es a las
                <strong>9 PM</strong>.
            </p>
        </div>

        <div class="hombres-schedule">
            <div class="hombres-schedule__time">
                <span class="hombres-schedule__hour">2 PM</span>
                <span class="hombres-schedule__label">Apertura</span>
            </div>
            <div class="hombres-schedule__bar" aria-hidden="true">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
            <div class="hombres-schedule__time">
                <span class="hombres-schedule__hour">9 PM</span>
                <span class="hombres-schedule__label">Última hora de llegada</span>
            </div>
            <div class="hombres-schedule__time hombres-schedule__time--end">
                <span class="hombres-schedule__hour">10 PM</span>
                <span class="hombres-schedule__label">Cierre</span>
            </div>
        </div>
    </section>

    {{-- ═══════════════ DONACIÓN SUGERIDA ═══════════════ --}}
    <section class="hombres-section" aria-label="Donación sugerida">
        <div class="hombres-donation">
            <span class="hombres-donation__eyebrow">Donación sugerida</span>
            <p class="hombres-donation__amount">
                <span class="hombres-donation__currency">$</span>100<small>MXN o más</small>
            </p>
            <p class="hombres-donation__lead">
                Sugerida o más, para seguir mejorando el lugar.
                Toda aportación se usa en el mantenimiento y crecimiento del espacio.
            </p>
        </div>
    </section>

    {{-- ═══════════════ OPCIONALES CON PRECIOS ═══════════════ --}}
    <section class="hombres-section hombres-section--alt" aria-label="Servicios opcionales">
        <div class="hombres-section__head">
            <span class="hombres-section__eyebrow">Opcional</span>
            <h2 class="hombres-section__title">Lo que puedes agregar.</h2>
            <p class="hombres-section__intro">
                Estos servicios no son obligatorios. Si quieres completar
                tu experiencia, aquí están los precios.
            </p>
        </div>

        <div class="hombres-optionals">
            @foreach ($opcionales as $item)
                <article class="hombres-optional">
                    <div class="hombres-optional__head">
                        <h3 class="hombres-optional__title">{{ $item['titulo'] }}</h3>
                        <span class="hombres-optional__price">{{ $item['precio'] }}</span>
                    </div>
                    <p class="hombres-optional__desc">{{ $item['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════ AVISO: SOLO MASAJES ═══════════════ --}}
    <section class="hombres-section" aria-label="Aviso importante">
        <div class="hombres-notice">
            <span class="hombres-notice__eyebrow">Aviso importante</span>
            <p class="hombres-notice__lead">
                <strong>Solo ofrezco masajes. No soy escort.</strong>
            </p>
            <p class="hombres-notice__body">
                Si vienes por un servicio profesional de masajes, con gusto te atiendo.
                Si buscas otro tipo de compañía, este no es el lugar.
            </p>
        </div>
    </section>

    {{-- ═══════════════ VIDEO GRATUITO ═══════════════ --}}
    <section class="hombres-section hombres-section--alt" aria-label="Video gratuito">
        <div class="hombres-video">
            <span class="hombres-video__eyebrow">Pide el video gratis</span>
            <h2 class="hombres-video__title">
                Activación de la energía sexual masculina.
            </h2>
            <p class="hombres-video__desc">
                Un video gratuito donde te explico cómo activar tu energía sexual
                desde tu propia práctica. Solo escríbeme y te lo envío sin costo.
            </p>
            <a href="{{ $waUrlHombres }}" target="_blank" rel="noopener" class="hombres-video__button">
                Pedir mi video gratis
            </a>
        </div>
    </section>

    {{-- ═══════════════ CIERRE / CONTACTO (removido: el botón flotante
         de WhatsApp cubre ese rol en todo el sitio) ═══════════════ --}}

</div>