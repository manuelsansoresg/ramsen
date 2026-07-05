{{--
    Partial: contenido dinámico de la experiencia MIXTO.
    Se inyecta dentro de la home /inicio cuando el parámetro
    `?experiencia=mixto` está presente, reemplazando la sección
    de servicios general.

    Este partial NO trae hero propio ni CTA final ni FAB porque
    la home ya cuenta con esas piezas (Hero original, sección de
    Contacto, botón flotante de WhatsApp).
--}}

@php
    $waTextMixto = rawurlencode("Hola Maestro Ramcen. Quiero reservar para el SPA HOLÍSTICO MIXTO.

¿Podría decirme qué día (sábado o domingo) aún tiene lugares disponibles y qué necesito llevar?");
    $waUrlMixto = "https://wa.me/{$whatsapp}?text={$waTextMixto}";

    // ── Servicios que sí se manejan en MIXTO ──
    $serviciosIncluidos = [
        ['tag' => 'Vapor', 'titulo' => 'Baños de vapor', 'desc' => 'Sesiones de vapor intenso para purificar cuerpo y mente. Disponible de 11:11 AM a 11:11 PM. Recomendado: mínimo 1 hora en total, en intervalos de 15 min.', 'icon' => 'vapor', 'nota' => 'Trae aceite de coco orgánico'],
        ['tag' => 'Agua', 'titulo' => 'Piscina', 'desc' => 'Agua, descanso y naturaleza para recuperar energía física y mental en un entorno selvático.', 'icon' => 'piscina', 'nota' => 'Trae traje de baño'],
        ['tag' => 'Mente', 'titulo' => 'Reprogramación neurolingüística', 'desc' => 'Acompañamiento para transformar emociones, hábitos y patrones internos hacia mayor equilibrio y claridad.', 'icon' => 'mente', 'nota' => 'Individual o en círculo'],
        ['tag' => 'Palabra', 'titulo' => 'Círculo de palabra y risoterapia', 'desc' => 'Conversaciones trascendentes, risoterapia y reprogramación en comunidad. Espacio para soltar, escuchar y reencontrarte.', 'icon' => 'circulo', 'nota' => 'Inicia 1:11 PM'],
        ['tag' => 'Fuego', 'titulo' => 'Fogata y campamento', 'desc' => 'Fogata con música en vivo, convivio y campamento hasta el amanecer. Solo los sábados.', 'icon' => 'fogata', 'nota' => 'Exclusivo sábados'],
        ['tag' => 'Cuerpo', 'titulo' => 'Entrenamiento físico', 'desc' => 'Calentamiento, fortalecimiento del ser, defensa personal, ejercicios pélvicos y estiramiento.', 'icon' => 'cuerpo', 'nota' => '5:00 PM · Solo sábados'],
    ];

    $serviciosExtras = [
        ['titulo' => 'Mascarilla carbón activado', 'precio' => '$10', 'desc' => 'Limpieza profunda para el rostro.'],
        ['titulo' => 'Mascarilla Tepezcohuite', 'precio' => '$50', 'desc' => 'El oro negro del sagrado Tepezcohuite. Mínimo 1 hora.'],
        ['titulo' => 'Baño turco de espuma', 'precio' => '$200', 'desc' => 'Espuma relajante por todo el cuerpo.'],
        ['titulo' => 'Masaje relajante', 'precio' => '$200', 'desc' => 'Hombros, brazos, espalda baja, piernas y pies.'],
        ['titulo' => 'Renta de toalla', 'precio' => '$20', 'desc' => 'Por unidad.'],
        ['titulo' => 'Renta de sandalias', 'precio' => '$10', 'desc' => 'Por unidad.'],
    ];

    $reglas = [
        ['icon' => 'no-fumar', 'titulo' => 'Cero sustancias nocivas', 'desc' => 'Si fumas, usa un parche de nicotina ese día. Fumar aquí daña tu sistema nervioso lentamente.'],
        ['icon' => 'silencio', 'titulo' => 'Sin bocinas', 'desc' => 'Para apreciar el silencio, el sonido de la naturaleza y conversar entre todos.'],
        ['icon' => 'limpiar', 'titulo' => 'Santuario limpio', 'desc' => 'Antes de las 10 AM del domingo debe estar listo para el siguiente grupo.'],
        ['icon' => 'respeto', 'titulo' => 'Respeto y amor', 'desc' => 'Comunidad basada en el amor y la evolución de la consciencia.'],
    ];

    $queTraer = [
        'Frutas, guisos y semillas para compartir',
        'Tu traje de baño y ropa cómoda',
        'Aceite de coco orgánico (para el vapor)',
        'Parche de nicotina (si fumas)',
        'Disposición para soltar y escuchar',
    ];
@endphp

{{-- ═══════════════ SELECTOR DE DÍA ═══════════════ --}}
<section class="mixto-days" aria-label="Elige el día de tu experiencia" x-data="mixtoPage()" x-init="init()">
    <div class="mixto-days__inner">
        <p class="eyebrow">Spa Holístico Mixto</p>
        <h2 class="mixto-days__title">¿Cuándo quieres venir?</h2>

        <div class="mixto-days__tabs" role="tablist">
            <button
                type="button"
                class="mixto-day-tab"
                :class="{ 'is-active': dia === 'sabado' }"
                role="tab"
                :aria-selected="dia === 'sabado'"
                x-on:click="setDia('sabado')"
            >
                <span class="mixto-day-tab__num">SÁB</span>
                <span class="mixto-day-tab__title">Experiencia completa</span>
                <span class="mixto-day-tab__sub">Incluye campamento hasta el amanecer</span>
                <span class="mixto-day-tab__icon" aria-hidden="true">🏕️</span>
            </button>
            <button
                type="button"
                class="mixto-day-tab"
                :class="{ 'is-active': dia === 'domingo' }"
                role="tab"
                :aria-selected="dia === 'domingo'"
                x-on:click="setDia('domingo')"
            >
                <span class="mixto-day-tab__num">DOM</span>
                <span class="mixto-day-tab__title">Solo un día</span>
                <span class="mixto-day-tab__sub">Sin campamento · 11:11 AM a 11:11 PM</span>
                <span class="mixto-day-tab__icon" aria-hidden="true">🌿</span>
            </button>
        </div>

        <div class="mixto-days__notice" role="status">
            <span x-show="dia === 'sabado'" x-transition.opacity>
                ✦ La experiencia completa incluye <strong>fogata, música en vivo y campamento hasta el amanecer</strong>. El domingo a las 10 AM el santuario debe estar limpio.
            </span>
            <span x-show="dia === 'domingo'" x-transition.opacity x-cloak>
                ✦ El domingo <strong>no hay campamento</strong>. Las actividades cierran a las 11:11 PM. Amanece en casa.
            </span>
        </div>
    </div>
</section>

{{-- ═══════════════ TIMELINE DEL DÍA ═══════════════ --}}
<section class="mixto-timeline section-ambient" aria-label="Itinerario del día">
    <div class="mx-auto max-w-6xl px-5 lg:px-8">
        <div class="mixto-timeline__head">
            <p class="eyebrow">Itinerario</p>
            <h2 class="section-title">
                <span x-show="dia === 'sabado'" x-transition.opacity>El día sábado</span>
                <span x-show="dia === 'domingo'" x-transition.opacity x-cloak>El día domingo</span>
            </h2>
            <p class="mixto-timeline__sub">
                <span x-show="dia === 'sabado'" x-transition.opacity>Lleva el ritmo que tu cuerpo pida. Todo es opcional pero muy recomendable.</span>
                <span x-show="dia === 'domingo'" x-transition.opacity x-cloak>Una jornada completa para renovar cuerpo y mente, sin pasar la noche.</span>
            </p>
        </div>

        <ol class="mixto-timeline__list">
            <template x-for="(item, idx) in (dia === 'sabado' ? timelineSabado : timelineDomingo)" :key="dia + '-' + idx">
                <li class="mixto-timeline__item" :class="{ 'is-star': item.destacado }" x-data="{ visible: false }" x-intersect.threshold.0.2="visible = true" :style="`transition-delay: ${idx * 70}ms`">
                    <div class="mixto-timeline__rail" aria-hidden="true">
                        <span class="mixto-timeline__dot"></span>
                    </div>
                    <div class="mixto-timeline__body">
                        <span class="mixto-timeline__hora" x-text="item.hora"></span>
                        <h3 class="mixto-timeline__titulo" x-text="item.titulo"></h3>
                        <p class="mixto-timeline__desc" x-text="item.desc"></p>
                    </div>
                </li>
            </template>
        </ol>
    </div>
</section>

{{-- ═══════════════ SERVICIOS INCLUIDOS ═══════════════ --}}
<section id="experiencias" class="mixto-services section-ambient" aria-label="Servicios incluidos en mixto">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mixto-services__head">
            <p class="eyebrow">Lo que incluye tu día</p>
            <h2 class="section-title">
                <span>Todo esto</span>
                <span>ya está incluido</span>
            </h2>
            <p class="mixto-services__sub">
                Vapor, agua, mente y comunidad. Solo trae tu disposición para soltar.
            </p>
        </div>

        <div class="mixto-services__grid">
            @foreach ($serviciosIncluidos as $s)
                <article class="mixto-service mixto-service--{{ $s['icon'] }}">
                    <div class="mixto-service__bg" aria-hidden="true"></div>
                    <div class="mixto-service__glow" aria-hidden="true"></div>
                    <div class="mixto-service__shade" aria-hidden="true"></div>

                    <span class="mixto-service__tag">{{ $s['tag'] }}</span>
                    <h3 class="mixto-service__title">{{ $s['titulo'] }}</h3>
                    <p class="mixto-service__desc">{{ $s['desc'] }}</p>
                    <span class="mixto-service__nota">{{ $s['nota'] }}</span>

                    <span class="mixto-service__icon" aria-hidden="true">
                        @switch($s['icon'])
                            @case('vapor')
                                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 48h32M20 48V32c0-3 2-5 5-5h14c3 0 5 2 5 5v16"/>
                                    <path d="M26 27c0-3 2-5 5-5h2c3 0 5 2 5 5"/>
                                    <path d="M32 22V14M28 14c-1.5-2 0-4 2-5M36 14c1.5-2 0-4-2-5M30 8c-1-1.5 0-3 1.5-4M34 8c1-1.5 0-3-1.5-4"/>
                                </svg>
                                @break
                            @case('piscina')
                                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 28c4 4 8 4 12 0s8-4 12 0 8 4 12 0 8-4 12 0"/>
                                    <path d="M8 38c4 4 8 4 12 0s8-4 12 0 8 4 12 0 8-4 12 0"/>
                                    <path d="M8 48c4 4 8 4 12 0s8-4 12 0 8 4 12 0 8-4 12 0"/>
                                </svg>
                                @break
                            @case('mente')
                                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16c-6 0-10 4-10 10 0 4 2 7 5 9v6c0 2 1 3 3 3h6c2 0 3-1 3-3v-2"/>
                                    <path d="M42 16c6 0 10 4 10 10 0 4-2 7-5 9v6c0 2-1 3-3 3h-6c-2 0-3-1-3-3v-2"/>
                                    <path d="M22 26c0-6 4-10 10-10s10 4 10 10"/>
                                    <circle cx="22" cy="36" r="1.5"/>
                                    <circle cx="42" cy="36" r="1.5"/>
                                </svg>
                                @break
                            @case('circulo')
                                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="32" cy="32" r="22"/>
                                    <circle cx="32" cy="14" r="3"/>
                                    <circle cx="50" cy="32" r="3"/>
                                    <circle cx="32" cy="50" r="3"/>
                                    <circle cx="14" cy="32" r="3"/>
                                    <path d="M32 17v15M32 35l15-3M32 47V35M32 35 17 32"/>
                                </svg>
                                @break
                            @case('fogata')
                                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M32 8c4 6 6 11 6 16 0 4-2 8-6 8s-6-4-6-8c0-5 2-10 6-16z"/>
                                    <path d="M32 22c2 3 4 6 4 9 0 2-1 5-4 5s-4-3-4-5c0-3 2-6 4-9z"/>
                                    <path d="M14 50c0 4 8 6 18 6s18-2 18-6v-4H14v4z"/>
                                    <path d="M20 46v-6M28 46v-8M36 46v-8M44 46v-6"/>
                                </svg>
                                @break
                            @case('cuerpo')
                                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="32" cy="14" r="5"/>
                                    <path d="M32 19v18M22 28l10 4 10-4"/>
                                    <path d="M22 28l-4 22M42 28l4 22M32 37v18"/>
                                </svg>
                                @break
                        @endswitch
                    </span>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════ SERVICIOS EXTRAS (CON PRECIO) ═══════════════ --}}
<section class="mixto-extras section-ambient" aria-label="Servicios adicionales con costo">
    <div class="mx-auto max-w-6xl px-5 lg:px-8">
        <div class="mixto-extras__head">
            <p class="eyebrow">Si quieres ir un paso más allá</p>
            <h2 class="section-title">
                <span>Servicios adicionales</span>
            </h2>
            <p class="mixto-extras__sub">Todo opcional · Pagos en efectivo en el santuario</p>
        </div>

        <div class="mixto-extras__grid">
            @foreach ($serviciosExtras as $ex)
                <div class="mixto-extra">
                    <div class="mixto-extra__body">
                        <h3>{{ $ex['titulo'] }}</h3>
                        <p>{{ $ex['desc'] }}</p>
                    </div>
                    <span class="mixto-extra__price">{{ $ex['precio'] }}<small>MXN</small></span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════ MICRODOSIS (CALLOUT ANIMADO) ═══════════════ --}}
<section class="mixto-micro" aria-label="Microdosis de Tepezcohuite opcional">
    <div class="mixto-micro__inner">
        <div class="mixto-micro__bg" aria-hidden="true"></div>
        <div class="mixto-micro__content">
            <p class="eyebrow mixto-micro__eyebrow">Recomendado</p>
            <h2 class="mixto-micro__title">
                Microdosis de <em>Tepezcohuite</em> sagrado
            </h2>
            <p class="mixto-micro__lead">
                Estabilizador natural para sentirte en paz y feliz contigo mismo
                al llegar al santuario. Una experiencia opcional pero muy recomendable.
            </p>
            <ul class="mixto-micro__rules">
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>
                    <span>Si vas a realizar esta experiencia, <strong>llega en ayunas</strong></span>
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>
                    <span>No se pueden tomar más cápsulas <strong>después de las 6:00 PM</strong></span>
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>
                    <span>Se ofrece al momento de tu llegada</span>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- ═══════════════ QUÉ TRAER + REGLAS ═══════════════ --}}
<section class="mixto-prep section-ambient" aria-label="Qué traer y reglas del santuario">
    <div class="mx-auto max-w-6xl px-5 lg:px-8">
        <div class="mixto-prep__grid">

            <article class="mixto-prep__card">
                <p class="eyebrow">Qué traer</p>
                <h3 class="mixto-prep__title">Tu kit para el santuario</h3>
                <ul class="mixto-checklist">
                    @foreach ($queTraer as $item)
                        <li class="mixto-checklist__item" x-data="{ checked: false }" x-on:click="checked = !checked" :class="{ 'is-checked': checked }">
                            <span class="mixto-checklist__box" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5 9-11"/></svg>
                            </span>
                            <span class="mixto-checklist__label">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mixto-prep__hint">
                    💡 <strong>Cooperacha</strong>: si no trajiste comida, cooperamos entre todos para cocinar algo juntos al amanecer (solo sábados).
                </p>
            </article>

            <article class="mixto-prep__card mixto-prep__card--rules">
                <p class="eyebrow">Reglas del santuario</p>
                <h3 class="mixto-prep__title">Para cuidar el espacio</h3>
                <div class="mixto-rules">
                    @foreach ($reglas as $regla)
                        <div class="mixto-rule">
                            <span class="mixto-rule__icon" aria-hidden="true">
                                @switch($regla['icon'])
                                    @case('no-fumar')
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M2 12a4 4 0 0 0 8 0M2 6v12M10 6v12M14 6c2 1.5 4 3 4 6s-2 4.5-4 6M18 4c2 2 4 4 4 8s-2 6-4 8"/><path d="M3 3l18 18"/></svg>
                                        @break
                                    @case('silencio')
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5L6 9H2v6h4l5 4V5zM16 9a4 4 0 0 1 0 6"/></svg>
                                        @break
                                    @case('limpiar')
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l18 18M9 12l-3 3 6 6 9-9-6-6-3 3"/></svg>
                                        @break
                                    @case('respeto')
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-4.5-9-10c-1-3 1-7 5-7 2 0 3 1 4 3 1-2 2-3 4-3 4 0 6 4 5 7-2 5.5-9 10-9 10z"/></svg>
                                        @break
                                @endswitch
                            </span>
                            <div>
                                <h4>{{ $regla['titulo'] }}</h4>
                                <p>{{ $regla['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        </div>
    </div>
</section>

{{-- ═══════════════ AFIRMACIÓN + VIDEO TESTIMONIO ═══════════════ --}}
<section class="mixto-affirmation" aria-label="Afirmación y testimonios">
    <div class="mixto-affirmation__inner">
        <p class="eyebrow mixto-affirmation__eyebrow">Repite en voz alta, especialmente antes de dormir</p>
        <blockquote class="mixto-affirmation__quote">
            <span class="mixto-affirmation__mark" aria-hidden="true">&ldquo;</span>
            <p class="mixto-affirmation__text">
                Yo estoy mejorando en todos los aspectos de mi vida cada día.
            </p>
        </blockquote>
        <p class="mixto-affirmation__caption">
            Las palabras tienen mucho poder. Son energía condensada. Háblate bonito siempre.
        </p>

        <div class="mixto-video">
            <p class="eyebrow mixto-video__label">Escucha algunos testimonios</p>
            <h3 class="mixto-video__title">14 años reprogramando · 10 años facilitando</h3>
            <p class="mixto-video__sub">
                Más de 14 años como reprogramador mental y más de 10 años como facilitador
                de enteógenos para expandir la consciencia. El gran despertar es posible.
            </p>
            <div class="mixto-video__frame" x-data="{ playing: false }">
                <template x-if="!playing">
                    <button type="button" class="mixto-video__poster" x-on:click="playing = true" aria-label="Reproducir video de testimonios">
                        <img src="{{ asset('images/ramcen/spa-holistico-maestro-ramcen.png') }}" alt="Testimonios del santuario">
                        <span class="mixto-video__play" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span class="mixto-video__poster-label">Ver testimonios en vivo</span>
                    </button>
                </template>
                <template x-if="playing">
                    <div class="mixto-video__embed">
                        <iframe
                            src="https://www.youtube.com/embed/c0eNvMElF5s?autoplay=1&rel=0"
                            title="Testimonios del santuario · Maestro Ramcen"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ CTA DENTRO DEL FLUJO MIXTO ═══════════════ --}}
<section class="mixto-final" aria-label="Reservar y datos finales">
    <div class="mx-auto max-w-5xl px-5 text-center lg:px-8">
        <p class="eyebrow">De una mente tranquila, nacen las buenas ideas.</p>
        <h2 class="mixto-final__title">
            Decide hoy. <em>Ven a conocer</em> nuestra comunidad.
        </h2>
        <p class="mixto-final__desc">
            Comunidad basada en el amor y la evolución de la consciencia.
            <br>Ceremonias, reprogramación mental, control de la mente, risoterapia y mucho más.
        </p>

        <div class="mixto-final__cta">
            <a href="{{ $waUrlMixto }}" target="_blank" class="mixto-final__button">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.2-1.8-.9-2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.5-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6.1-.1.3-.3.4-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.1-.7-1.6-.9-2.2-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.2-.3-.3-.5-.4zM12 2C6.5 2 2 6.5 2 12c0 1.8.5 3.5 1.3 5L2 22l5.2-1.3c1.4.8 3 1.3 4.7 1.3 5.5 0 10-4.5 10-10S17.5 2 12 2z"/></svg>
                <span>Reservar por WhatsApp</span>
            </a>
            <p class="mixto-final__phone">{{ $phoneLabel }}</p>
        </div>

        <div class="mixto-final__info">
            <div class="mixto-final__cell">
                <span class="eyebrow">Cuándo</span>
                <p>Sábados y domingos<br>11:11 AM &mdash; 11:11 PM</p>
            </div>
            <div class="mixto-final__cell">
                <span class="eyebrow">Dónde</span>
                <p>Santuario del Maestro Ramcen<br>Komchén, Yucatán</p>
            </div>
            <div class="mixto-final__cell">
                <span class="eyebrow">Donación</span>
                <p>$100 pesos sugeridos<br>o más para seguir mejorando</p>
            </div>
            <div class="mixto-final__cell">
                <span class="eyebrow">Confirma</span>
                <p>Mínimo un día antes<br>de tu visita</p>
            </div>
        </div>
    </div>
</section>
