/* =====================================================================
   Spa Holístico · Contenido dinámico de MIXTO
   ---------------------------------------------------------------------
   - Alpine.js: estado de tabs sábado/domingo y video play
   - GSAP: reveal en scroll, parallax suave, micro-interacciones
   - IntersectionObserver: timelines y elementos críticos

   NOTA: este módulo se importa junto a app.js (que ya hace Alpine.start()
   y registra ScrollTrigger). Aquí solo registramos datos y efectos
   adicionales. No se vuelve a llamar Alpine.start().
   ===================================================================== */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

if (window.gsap?.registerPlugin) {
    gsap.registerPlugin(ScrollTrigger);
}

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ─────────────────────────── Alpine component ─────────────────────────── */
Alpine.data('mixtoPage', () => ({
    dia: 'sabado',
    timelineSabado: [
        { hora: '11:11 AM', titulo: 'Apertura del santuario', desc: 'Llegada, recibimiento y conexión con el espacio.' },
        { hora: '1:11 PM',  titulo: 'Círculo de palabra + risoterapia', desc: 'Reprogramación neurolingüística y conversaciones trascendentes.', destacado: true },
        { hora: '2:30 PM',  titulo: 'Convivio · almuerzo juntos', desc: 'Lo que cada uno trajo para compartir.' },
        { hora: '5:00 PM',  titulo: 'Inicio del campamento 🏕️', desc: 'Entrenamiento físico: calentamiento, fortalecimiento, defensa personal, ejercicios pélvicos y estiramiento.', destacado: true },
        { hora: '7:00 PM',  titulo: 'Fogata + música en vivo', desc: 'Cena entre todos bajo las estrellas.' },
        { hora: '11:11 PM', titulo: 'Cierre de actividades', desc: 'Paz, silencio y descanso bajo la fogata.' },
        { hora: 'Amanecer', titulo: 'Desayuno juntos', desc: 'Cosas que trajiste o cooperacha para cocinar algo entre todos.', destacado: true },
        { hora: '10:00 AM', titulo: 'Santuario listo', desc: 'Limpio y preparado para el siguiente grupo de Solo Hombres Libres.' },
    ],
    timelineDomingo: [
        { hora: '11:11 AM', titulo: 'Apertura del santuario', desc: 'Llegada, recibimiento y conexión con el espacio.' },
        { hora: '1:11 PM',  titulo: 'Círculo de palabra + risoterapia', desc: 'Reprogramación neurolingüística y conversaciones trascendentes.' },
        { hora: '2:30 PM',  titulo: 'Convivio · almuerzo juntos', desc: 'Lo que cada uno trajo para compartir.' },
        { hora: '5:00 PM',  titulo: 'Vapor + fogata suave', desc: 'Sin campamento. Fogata más corta para cerrar el día.' },
        { hora: '9:00 PM',  titulo: 'Última hora de llegada', desc: 'Después de las 9 PM no se puede entrar al santuario.' },
        { hora: '11:11 PM', titulo: 'Cierre de actividades', desc: 'Amanece en casa. El santuario se prepara para el siguiente grupo.' },
    ],
    init() {
        // Hidratar el título con el reveal animado
        this.$nextTick(() => this.revealTitle());
    },
    setDia(d) {
        this.dia = d;
        // Re-animar timeline al cambiar
        this.$nextTick(() => {
            document.querySelectorAll('.mixto-timeline__item.is-visible').forEach((el) => {
                el.classList.remove('is-visible');
            });
            this.observeTimelines();
        });
    },
    revealTitle() {
        if (prefersReducedMotion) {
            const title = document.querySelector('.mixto-title');
            if (title) title.classList.add('is-revealed');
            return;
        }
        // Pequeño delay para asegurar que el navegador pintó el estado inicial
        window.setTimeout(() => {
            document.querySelector('.mixto-title')?.classList.add('is-revealed');
        }, 80);
    },
    observeTimelines() {
        const items = document.querySelectorAll('.mixto-timeline__item:not(.is-visible)');
        if (!items.length) return;

        if (prefersReducedMotion) {
            items.forEach((el) => el.classList.add('is-visible'));
            return;
        }

        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -60px 0px' });

        items.forEach((el) => io.observe(el));
    },
}));

/* ─────────────────────────── GSAP / ScrollTrigger ─────────────────────────── */

const animateOnReady = () => {
    if (prefersReducedMotion) {
        document.querySelectorAll(
            '.mixto-service, .mixto-extra, .mixto-micro__inner, .mixto-affirmation__inner, .mixto-video__frame, .mixto-final__title, .mixto-final__desc, .mixto-final__cta, .mixto-final__info, .mixto-rule, .mixto-micro__rules li, .mixto-day-tab'
        ).forEach((el) => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
        return;
    }

    /* Reveal de servicios con stagger */
    gsap.utils.toArray('.mixto-service').forEach((card, i) => {
        gsap.set(card, { autoAlpha: 0, y: 40, scale: 0.97 });
        gsap.to(card, {
            autoAlpha: 1,
            y: 0,
            scale: 1,
            duration: 0.85,
            delay: (i % 3) * 0.08,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: card,
                start: 'top 86%',
                once: true,
            },
        });
    });

    /* Reveal de servicios extras */
    gsap.utils.toArray('.mixto-extra').forEach((card, i) => {
        gsap.set(card, { autoAlpha: 0, y: 24 });
        gsap.to(card, {
            autoAlpha: 1,
            y: 0,
            duration: 0.7,
            delay: (i % 4) * 0.05,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: card,
                start: 'top 90%',
                once: true,
            },
        });
    });

    /* Microdosis callout */
    const microInner = document.querySelector('.mixto-micro__inner');
    if (microInner) {
        gsap.set(microInner, { autoAlpha: 0, y: 30 });
        gsap.to(microInner, {
            autoAlpha: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: microInner,
                start: 'top 85%',
                once: true,
            },
        });
    }

    /* Lista de reglas micro */
    gsap.utils.toArray('.mixto-micro__rules li').forEach((li, i) => {
        gsap.set(li, { autoAlpha: 0, x: -16 });
        gsap.to(li, {
            autoAlpha: 1,
            x: 0,
            duration: 0.65,
            delay: i * 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: li,
                start: 'top 90%',
                once: true,
            },
        });
    });

    /* Tarjetas prep (qué traer + reglas) */
    gsap.utils.toArray('.mixto-prep__card').forEach((card) => {
        gsap.set(card, { autoAlpha: 0, y: 30 });
        gsap.to(card, {
            autoAlpha: 1,
            y: 0,
            duration: 0.85,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: card,
                start: 'top 85%',
                once: true,
            },
        });
    });

    /* Reglas individuales */
    gsap.utils.toArray('.mixto-rule').forEach((rule, i) => {
        gsap.set(rule, { autoAlpha: 0, x: -14 });
        gsap.to(rule, {
            autoAlpha: 1,
            x: 0,
            duration: 0.6,
            delay: i * 0.08,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: rule,
                start: 'top 92%',
                once: true,
            },
        });
    });

    /* Affirmation */
    const aff = document.querySelector('.mixto-affirmation__quote');
    if (aff) {
        gsap.set(aff, { autoAlpha: 0, scale: 0.96 });
        gsap.to(aff, {
            autoAlpha: 1,
            scale: 1,
            duration: 1.1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: aff,
                start: 'top 85%',
                once: true,
            },
        });
    }

    /* Video */
    const video = document.querySelector('.mixto-video__frame');
    if (video) {
        gsap.set(video, { autoAlpha: 0, y: 40, scale: 0.96 });
        gsap.to(video, {
            autoAlpha: 1,
            y: 0,
            scale: 1,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: video,
                start: 'top 85%',
                once: true,
            },
        });
    }

    /* Final CTA cells */
    gsap.utils.toArray('.mixto-final__cell').forEach((cell, i) => {
        gsap.set(cell, { autoAlpha: 0, y: 20 });
        gsap.to(cell, {
            autoAlpha: 1,
            y: 0,
            duration: 0.7,
            delay: i * 0.08,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: cell,
                start: 'top 90%',
                once: true,
            },
        });
    });

    /* Tabs Sábado/Domingo — entran al scroll */
    gsap.utils.toArray('.mixto-day-tab').forEach((tab, i) => {
        gsap.set(tab, { autoAlpha: 0, y: 30 });
        gsap.to(tab, {
            autoAlpha: 1,
            y: 0,
            duration: 0.85,
            delay: i * 0.12,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: tab,
                start: 'top 88%',
                once: true,
            },
        });
    });

    /* Parallax sutil del hero */
    gsap.to('.mixto-hero__bg img', {
        yPercent: 8,
        scale: 1.02,
        ease: 'none',
        scrollTrigger: {
            trigger: '.mixto-hero',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        },
    });

    /* Magnetic button sutil en el CTA principal */
    document.querySelectorAll('.mixto-cta-primary, .mixto-final__button').forEach((button) => {
        button.addEventListener('mousemove', (event) => {
            const rect = button.getBoundingClientRect();
            const x = event.clientX - rect.left - rect.width / 2;
            const y = event.clientY - rect.top - rect.height / 2;
            gsap.to(button, { x: x * 0.12, y: y * 0.18, duration: 0.4, ease: 'power3.out' });
        });
        button.addEventListener('mouseleave', () => {
            gsap.to(button, { x: 0, y: 0, duration: 0.55, ease: 'elastic.out(1, .45)' });
        });
    });

    /* Tilt 3D sutil en las tarjetas de servicio (desktop) */
    if (window.matchMedia('(min-width: 1024px)').matches) {
        document.querySelectorAll('.mixto-service').forEach((card) => {
            const inner = card;
            inner.addEventListener('mousemove', (event) => {
                const rect = card.getBoundingClientRect();
                const x = ((event.clientX - rect.left) / rect.width - 0.5) * 8;
                const y = ((event.clientY - rect.top) / rect.height - 0.5) * -8;
                gsap.to(card, { rotateY: x, rotateX: y, transformPerspective: 800, duration: 0.6, ease: 'power3.out' });
            });
            inner.addEventListener('mouseleave', () => {
                gsap.to(card, { rotateY: 0, rotateX: 0, duration: 0.8, ease: 'power3.out' });
            });
        });
    }
};

/* ─────────────────────────── Boot ─────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    // Esperar al primer paint para iniciar animaciones
    window.requestAnimationFrame(() => {
        animateOnReady();

        // Activar observer del timeline después de Alpine
        window.setTimeout(() => {
            const root = document.querySelector('.mixto-shell');
            if (root && root._x_dataStack) {
                const component = root._x_dataStack[0];
                if (component && typeof component.observeTimelines === 'function') {
                    component.observeTimelines();
                }
            } else {
                // Fallback: disparar manualmente
                document.querySelectorAll('.mixto-timeline__item').forEach((el) => {
                    const io = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                                io.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.2 });
                    io.observe(el);
                });
            }
        }, 100);
    });
});
