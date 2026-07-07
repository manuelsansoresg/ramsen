{{--
    Partial: contenido dinámico de la experiencia TEMAZCAL MIXTO.
    Se inyecta dentro de la home /inicio cuando el parámetro
    `?experiencia=temazcal-mixto` está presente, reemplazando la
    sección de servicios general.

    Estructura:
      · Hero local (intro + maestro)
      · Dónde (santuario de Doña Nico + familia)
      · Hora / Timeline del domingo
      · Las 4 puertas (dentro del temazcal)
      · Convivio (11:11 AM)
      · Donaciones ($333 / $111)
      · Equipo / Contactos
      · CTA final

    Toda la información está en arreglos al inicio para poder
    editar/agregar elementos sin tocar el markup.
--}}

@php
    $waTextTemazcal = rawurlencode("Hola Maestro Ramcen. Quiero reservar para el TEMAZCAL MIXTO del domingo 9 AM.\n\n¿Podría confirmarme disponibilidad, qué necesito llevar y cómo apunto mi lugar en la lista para el convivio?");
    $waUrlTemazcal = "https://wa.me/{$whatsapp}?text={$waTextTemazcal}";

    // ── Lugar: casa de Doña Nico + sanadora familia ──
    $lugar = [
        'anfitriona' => [
            'rol'      => 'Partera tradicional y huesera maya',
            'nombre'   => 'Doña Nico',
            'experiencia' => 'Más de 47 años de experiencia · Casi 500 bebés recibidos',
            'direccion' => 'Calle 27 S/N x 26 y 28, Komchén, Mérida, Yucatán · Carretera Mérida a Progreso',
        ],
        'familia' => [
            [
                'rol'     => 'Limpias, masajes y despojos',
                'nombre'  => 'María José',
                'detalle' => 'Sanadora · hija de Doña Nico',
            ],
            [
                'rol'     => 'Limpias, baños y trabajos para abrir caminos',
                'nombre'  => 'Martha Beatriz',
                'detalle' => 'Lectura de huevo · hija de Doña Nico',
            ],
        ],
    ];

    // ── Línea de tiempo del domingo ──
    $timeline = [
        ['hora' => '9:00 AM',  'sub' => 'Reunión',  'titulo' => 'Punto de encuentro',         'desc' => 'Nos reunimos en casa de Doña Nico para recibir al grupo y preparar el espacio sagrado.'],
        ['hora' => '9:30 AM',  'sub' => 'Entrada',  'titulo' => 'Entramos al temazcal',       'desc' => 'Iniciamos la ceremonia con la primera vuelta de piedras volcánicas y hierbas de olor.'],
        ['hora' => '10:30 AM', 'sub' => 'Cierre',   'titulo' => 'Salida del temazcal',        'desc' => 'Después de las 4 puertas (15 min c/u) cerramos la experiencia de una hora total.'],
        ['hora' => '11:11 AM', 'sub' => 'Convivio', 'titulo' => 'Cierre del evento',          'desc' => 'Convivio con fruta fresca orgánica picada y jugo natural orgánico con azúcar mascabado.'],
    ];

    // ── Las 4 puertas dentro del temazcal ──
    $puertas = [
        ['label' => '1.ª puerta', 'titulo' => 'Círculo de palabra',                    'desc' => 'Abrimos el espacio sagrado compartiendo desde el corazón.'],
        ['label' => '2.ª puerta', 'titulo' => 'Reprogramación neurolingüística',      'desc' => 'Soltamos patrones mentales que ya no nos sirven y sembramos nuevas intenciones.'],
        ['label' => '3.ª puerta', 'titulo' => 'Risoterapia',                            'desc' => 'La risa como medicina: liberamos el cuerpo y la mente con alegría genuina.'],
        ['label' => '4.ª puerta', 'titulo' => 'Conversaciones trascendentales',         'desc' => 'Para seguir evolucionando hacia una mejor comprensión de las circunstancias personales y globales de este planeta.'],
    ];

    // ── Convivio: qué traer y notas ──
    $traerConvivio = [
        'Tu almuerzo',
        'Frutas frescas',
        'Semillas (nuez, almendras, pistaches, etc.)',
        'Actitud abierta para compartir',
    ];

    // ── Donaciones ──
    $donaciones = [
        [
            'monto'      => '$333',
            'eyebrow'    => 'Donación sugerida',
            'titulo'     => 'Temazcal completo',
            'desc'       => 'Para seguir mejorando el lugar. Cubre la experiencia completa del temazcal (1 hora dentro con las 4 puertas).',
            'featured'   => true,
        ],
        [
            'monto'      => '$111',
            'eyebrow'    => 'Donación sugerida',
            'titulo'     => 'Solo convivio',
            'desc'       => 'Para participar únicamente en el convivio de las 11:11 AM, sin la experiencia previa del temazcal.',
            'featured'   => false,
        ],
    ];

    // ── Equipo: 4 contactos directos ──
    $equipo = [
        [
            'rol'     => 'Guía · Maestro de conocimientos',
            'nombre'  => 'Maestro Ramcen',
            'tel'     => '9993 292148',
            'tel_raw' => '529993292148',
            'mensaje' => 'Hola Maestro Ramcen, quiero información para el Temazcal Mixto del domingo.',
        ],
        [
            'rol'     => 'Anfitriona · Partera maya',
            'nombre'  => 'Mami Nico',
            'tel'     => '9992 195144',
            'tel_raw' => '529992195144',
            'mensaje' => 'Hola Mami Nico, quiero información para el Temazcal Mixto del domingo en su casa.',
        ],
        [
            'rol'     => 'Limpias · Masajes · Despojos',
            'nombre'  => 'María José',
            'tel'     => '9996 431785',
            'tel_raw' => '529996431785',
            'mensaje' => 'Hola María José, quiero información sobre las limpias y trabajos después del convivio.',
        ],
        [
            'rol'     => 'Limpias · Baños · Lectura de huevo',
            'nombre'  => 'Martha Beatriz',
            'tel'     => '9999 077795',
            'tel_raw' => '529999077795',
            'mensaje' => 'Hola Martha Beatriz, quiero información sobre los trabajos para abrir caminos y la lectura de huevo.',
        ],
    ];
@endphp

<div class="temazcal-shell">

    {{-- ═══════════════ HERO ═══════════════ --}}
    <section class="temazcal-hero" aria-label="Temazcal Mixto · introducción">
        <div class="temazcal-hero__bg" aria-hidden="true"></div>
        <div class="temazcal-hero__particles" aria-hidden="true">
            @for ($i = 0; $i < 32; $i++)
                <span style="left: {{ number_format(($i * 3.125) + (($i * 7) % 11) * 0.5, 2) }}%; animation-delay: {{ number_format($i * 0.27, 2) }}s;"></span>
            @endfor
        </div>

        <div class="temazcal-hero__inner">
            <span class="temazcal-hero__eyebrow">Ceremonia maya · Domingos 9 AM</span>
            <h1 class="temazcal-hero__title">
                Temazcal <em>Mixto</em>
            </h1>
            <p class="temazcal-hero__lead">
                Con piedras volcánicas y hierbas de olor para sanación y relajación.
                Guiado por el Maestro de conocimientos, reprogramador neurolingüístico
                y fisioterapista especializado en elevar la energía vital del hombre.
                El famoso <strong>Ramcen de Komchén</strong> con más de 14 años de experiencia.
            </p>
        </div>
    </section>

    {{-- ═══════════════ DÓNDE ═══════════════ --}}
    <section class="temazcal-section temazcal-section--alt" aria-label="Dónde se realiza el temazcal">
        <div class="temazcal-section__head">
            <span class="temazcal-section__eyebrow">Dónde</span>
            <h2 class="temazcal-section__title">En casa de Doña Nico</h2>
            <p class="temazcal-section__intro">
                En la casa de la famosa partera tradicional y huesera maya,
                junto con su sanadora familia.
            </p>
        </div>

        <div class="temazcal-where">
            {{-- Tarjeta principal: anfitriona --}}
            <article class="temazcal-where__card">
                <h3>{{ $lugar['anfitriona']['rol'] }}</h3>
                <p>
                    <strong>Doña Nico</strong><br>
                    {{ $lugar['anfitriona']['experiencia'] }}
                </p>
                <address class="temazcal-where__address">
                    {{ $lugar['anfitriona']['direccion'] }}
                </address>
            </article>

            {{-- Tarjetas de la familia --}}
            @foreach ($lugar['familia'] as $persona)
                <article class="temazcal-where__card">
                    <h3>{{ $persona['rol'] }}</h3>
                    <p>
                        <strong>{{ $persona['nombre'] }}</strong><br>
                        {{ $persona['detalle'] }}
                    </p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════ HORA / TIMELINE ═══════════════ --}}
    <section class="temazcal-section" aria-label="Horario del temazcal">
        <div class="temazcal-section__head">
            <span class="temazcal-section__eyebrow">Hora</span>
            <h2 class="temazcal-section__title">El domingo, paso a paso</h2>
            <p class="temazcal-section__intro">
                9 AM punto de encuentro. A las 9:30 AM entramos al temazcal.
                Son <strong>4 puertas de 15 minutos</strong> o cuatro veces que abrimos
                el temazcal para meter más piedras, haciendo de la experiencia
                <strong>una hora en total</strong>.
            </p>
        </div>

        <ol class="temazcal-timeline">
            @foreach ($timeline as $paso)
                <li class="temazcal-timeline__step">
                    <div class="temazcal-timeline__time">
                        {{ $paso['hora'] }}
                        <small>{{ $paso['sub'] }}</small>
                    </div>
                    <div class="temazcal-timeline__body">
                        <h3>{{ $paso['titulo'] }}</h3>
                        <p>{{ $paso['desc'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- ═══════════════ LAS 4 PUERTAS ═══════════════ --}}
    <section class="temazcal-section temazcal-section--alt" aria-label="Las 4 puertas dentro del temazcal">
        <div class="temazcal-section__head">
            <span class="temazcal-section__eyebrow">Dentro del temazcal habrá</span>
            <h2 class="temazcal-section__title">Las 4 puertas</h2>
            <p class="temazcal-section__intro">
                Cada puerta es una invitación a soltar, mirar hacia adentro
                y abrirse a una nueva comprensión.
            </p>
        </div>

        <div class="temazcal-puertas">
            @foreach ($puertas as $puerta)
                <article class="temazcal-puerta">
                    <span class="temazcal-puerta__label">{{ $puerta['label'] }}</span>
                    <h3 class="temazcal-puerta__title">{{ $puerta['titulo'] }}</h3>
                    <p class="temazcal-puerta__desc">{{ $puerta['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════ CONVIVIO ═══════════════ --}}
    <section class="temazcal-section" aria-label="Convivio de cierre">
        <div class="temazcal-conv">
            <h2 class="temazcal-conv__title">11:11 AM — cierre con convivio</h2>
            <p class="temazcal-conv__lead">
                Al cerrar la ceremonia te esperamos con
                <strong>fruta fresca orgánica picada</strong> y un
                <strong>jugo natural orgánico con azúcar mascabado</strong>.
                Después del convivio se les atenderá personalmente
                por la familia para lo que requieran.
            </p>

            <ul class="temazcal-conv__list">
                @foreach ($traerConvivio as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <p class="temazcal-conv__note">
                ✦ Es necesario apuntarse en la lista para preparar
                suficiente comida para todos.
            </p>
        </div>
    </section>

    {{-- ═══════════════ DONACIONES ═══════════════ --}}
    <section class="temazcal-section temazcal-section--alt" aria-label="Donaciones sugeridas">
        <div class="temazcal-section__head">
            <span class="temazcal-section__eyebrow">Donación</span>
            <h2 class="temazcal-section__title">Dos formas de sumarte</h2>
            <p class="temazcal-section__intro">
                Toda donación es voluntaria y se usa para seguir mejorando
                el lugar y cuidando a la familia que lo sostiene.
            </p>
        </div>

        <div class="temazcal-pricing">
            @foreach ($donaciones as $precio)
                <article class="temazcal-price {{ $precio['featured'] ? 'temazcal-price--featured' : '' }}">
                    <span class="temazcal-price__eyebrow">{{ $precio['eyebrow'] }}</span>
                    <span class="temazcal-price__amount">
                        {{ $precio['monto'] }}<small>MXN</small>
                    </span>
                    <h3 class="temazcal-puerta__title" style="font-size: 1.1rem;">{{ $precio['titulo'] }}</h3>
                    <p class="temazcal-price__desc">{{ $precio['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════ EQUIPO / CONTACTOS ═══════════════ --}}
    <section class="temazcal-section" aria-label="Equipo del temazcal">
        <div class="temazcal-section__head">
            <span class="temazcal-section__eyebrow">Equipo</span>
            <h2 class="temazcal-section__title">Las personas detrás del fuego</h2>
            <p class="temazcal-section__intro">
                Después del convivio se les atenderá personalmente por la familia.
                Puedes escribirles directo o al Maestro Ramcen.
            </p>
        </div>

        <div class="temazcal-team">
            @foreach ($equipo as $persona)
                @php
                    $waTextPersona = rawurlencode($persona['mensaje']);
                    $waPersona = "https://wa.me/{$persona['tel_raw']}?text={$waTextPersona}";
                @endphp
                <article class="temazcal-team__person">
                    <span class="temazcal-team__role">{{ $persona['rol'] }}</span>
                    <h3 class="temazcal-team__name">{{ $persona['nombre'] }}</h3>
                    <a class="temazcal-team__phone"
                       href="{{ $waPersona }}"
                       target="_blank"
                       rel="noopener"
                       aria-label="Escribir por WhatsApp a {{ $persona['nombre'] }}">
                        {{ $persona['tel'] }}
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════ CTA FINAL ═══════════════ --}}
    <section class="temazcal-final" aria-label="Reservar temazcal">
        <span class="temazcal-final__eyebrow">Muchas gracias</span>
        <h2 class="temazcal-final__title">
            Apúntate en la <em>lista</em> y ven a vivirlo.
        </h2>
        <p class="temazcal-final__desc">
            Es necesario apuntarse en la lista para preparar suficiente comida para todos.
            Te esperamos cada domingo a las 9 AM en casa de Doña Nico, Komchén, Yucatán.
        </p>

        <div class="temazcal-final__cta">
            <a href="{{ $waUrlTemazcal }}" target="_blank" rel="noopener" class="temazcal-final__button">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M17.5 14.4c-.3-.2-1.8-.9-2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.5-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6.1-.1.3-.3.4-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.1-.7-1.6-.9-2.2-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.2-.3-.3-.5-.4zM12 2C6.5 2 2 6.5 2 12c0 1.8.5 3.5 1.3 5L2 22l5.2-1.3c1.4.8 3 1.3 4.7 1.3 5.5 0 10-4.5 10-10S17.5 2 12 2z"/>
                </svg>
                <span>Apuntarme en la lista</span>
            </a>
            <span class="temazcal-final__signoff">— Maestro Ramcen &amp; familia —</span>
        </div>
    </section>

</div>