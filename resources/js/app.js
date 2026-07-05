import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

window.Alpine = Alpine;

/*
   Si la página renderizó contenido mixto (cargado condicionalmente en
   la vista cuando llega ?experiencia=mixto), esperamos al siguiente
   tick del event loop antes de iniciar Alpine. Esto garantiza que
   spa-mixto.js (cargado justo después en el documento) haya tenido
   oportunidad de registrar su componente `mixtoPage` con Alpine.data()
   antes de que el scan inicial del DOM ocurra. Sin este defer,
   Alpine se quejaría con "mixtoPage is not defined".
*/
if (document.querySelector('[x-data*="mixtoPage"]')) {
    window.setTimeout(() => Alpine.start(), 0);
} else {
    Alpine.start();
}

gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const ambientAudio = document.querySelector('#heroAmbientAudio');
const ambientToggle = document.querySelector('#heroAmbientToggle');
const ambientToggleText = ambientToggle?.querySelector('.ambient-audio-text');

if (ambientAudio && ambientToggle && ambientToggleText) {
    ambientAudio.volume = 0.18;

    const setAudioState = (isPlaying) => {
        ambientToggle.classList.toggle('is-playing', isPlaying);
        ambientToggle.setAttribute('aria-label', isPlaying ? 'Pausar sonido ambiental' : 'Reproducir sonido ambiental');
        ambientToggle.firstElementChild.textContent = isPlaying ? '⏸' : '🌿';
        ambientToggleText.textContent = isPlaying ? 'Pausar ambiente' : 'Escuchar ambiente';
    };

    const playAmbient = async (savePreference = true) => {
        try {
            await ambientAudio.play();
            setAudioState(true);

            if (savePreference) {
                localStorage.setItem('santuarioAudioPaused', 'false');
            }
        } catch (error) {
            setAudioState(false);
        }
    };

    const pauseAmbient = (savePreference = true) => {
        ambientAudio.pause();
        setAudioState(false);

        if (savePreference) {
            localStorage.setItem('santuarioAudioPaused', 'true');
        }
    };

    ambientToggle.addEventListener('click', () => {
        if (ambientAudio.paused) {
            playAmbient();
        } else {
            pauseAmbient();
        }
    });

    /* ------------------------------------------------------------------
       Autoplay solicitado desde la splash (spa-select).
       Cuando el usuario hace click en una tarjeta de la splash, marcamos
       `ramcen-autoplay=1` en sessionStorage. Aquí lo leemos y forzamos
       la reproducción: el navegador reconoce el click previo en la splash
       como interacción válida del usuario y permite el play().
       ------------------------------------------------------------------ */
    let requestedAutoplay = false;
    try {
        if (window.sessionStorage.getItem('ramcen-autoplay') === '1') {
            window.sessionStorage.removeItem('ramcen-autoplay');
            requestedAutoplay = true;
        }
    } catch (error) {
        // sessionStorage no disponible
    }

    if (requestedAutoplay) {
        // Pequeño delay para asegurar que el audio element está listo
        // y que el navegador "ve" la interacción reciente.
        window.setTimeout(() => playAmbient(true), 60);
    } else if (localStorage.getItem('santuarioAudioPaused') === 'true') {
        setAudioState(false);
    } else {
        playAmbient(false);
    }
}

if (!prefersReducedMotion) {
    gsap.set('.reveal, .reveal-line, .reveal-card, .reveal-image', { autoAlpha: 0, y: 34 });
    gsap.set('.reveal-title', { autoAlpha: 0, y: 46, filter: 'blur(10px)' });
    gsap.set('.section-2-label', { autoAlpha: 0, y: 12 });
    gsap.set('.section-2-title-line', { autoAlpha: 0, y: 28 });
    gsap.set('.section-2-copy', { autoAlpha: 0, x: 18 });
    gsap.set('.section-2-divider', { scaleY: 0 });
    gsap.set('.section-2-image', { autoAlpha: 0, scale: .96, y: 0 });
    gsap.set('.services-label, .services-subtitle, .services-cta', { autoAlpha: 0, y: 18 });
    gsap.set('.services-title-line', { autoAlpha: 0, y: 30 });
    gsap.set('.service-card', { autoAlpha: 0, y: 40, scale: .97 });
    gsap.set('.upcoming-events-label, .upcoming-events-title, .upcoming-events-copy', { autoAlpha: 0, y: 28 });
    gsap.set('.event-card, .event-empty', { autoAlpha: 0, y: 50 });
    gsap.set('.testimonials-label, .testimonials-intro, .testimonials-cta', { autoAlpha: 0, y: 18 });
    gsap.set('.testimonials-title span', { autoAlpha: 0, y: 28 });
    gsap.set('.testimonial-slide', { autoAlpha: 0, y: 40 });

    gsap.timeline({ defaults: { ease: 'power3.out' } })
        .to('.reveal-line', { autoAlpha: 1, y: 0, duration: .9 }, .2)
        .to('.reveal-title', { autoAlpha: 1, y: 0, filter: 'blur(0px)', duration: 1.25 }, .38)
        .to('.hero-copy .reveal', { autoAlpha: 1, y: 0, duration: 1, stagger: .12 }, .78);

    const section2 = document.querySelector('.section-2');

    if (section2) {
        const section2Timeline = gsap.timeline({
            defaults: { ease: 'power3.out' },
            scrollTrigger: {
                trigger: section2,
                start: 'top 72%',
                once: true,
            },
        });

        section2Timeline
            .to('.section-2-label', { autoAlpha: 1, y: 0, duration: 1 })
            .to('.section-2-divider', { scaleY: 1, duration: 1.35, ease: 'power2.inOut' }, .15)
            .to('.section-2-title-line', { autoAlpha: 1, y: 0, duration: 1.05, stagger: .16 }, .28)
            .to('.section-2-copy', { autoAlpha: 1, x: 0, duration: 1.15 }, .82)
            .to('.section-2-image', {
                autoAlpha: 1,
                scale: 1,
                duration: 1.35,
                ease: 'power2.out',
                onComplete: () => {
                    gsap.to('.section-2-image', {
                        scale: 1.025,
                        y: -6,
                        duration: 12,
                        repeat: -1,
                        yoyo: true,
                        ease: 'sine.inOut',
                    });
                },
            }, .92);

        gsap.to('.section-2-glow', {
            opacity: .28,
            duration: 12,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
        });

        ScrollTrigger.matchMedia({
            '(min-width: 1024px)': () => {
                const image = section2.querySelector('.section-2-image-shell');

                if (!image) return undefined;

                const moveImage = (event) => {
                    const rect = section2.getBoundingClientRect();
                    const x = ((event.clientX - rect.left) / rect.width - .5) * 20;
                    const y = ((event.clientY - rect.top) / rect.height - .5) * 20;

                    gsap.to(image, {
                        x: Math.max(-10, Math.min(10, x)),
                        y: Math.max(-10, Math.min(10, y)),
                        duration: 1.2,
                        ease: 'power3.out',
                        overwrite: 'auto',
                    });
                };

                const resetImage = () => {
                    gsap.to(image, { x: 0, y: 0, duration: 1.4, ease: 'power3.out', overwrite: 'auto' });
                };

                section2.addEventListener('mousemove', moveImage);
                section2.addEventListener('mouseleave', resetImage);

                return () => {
                    section2.removeEventListener('mousemove', moveImage);
                    section2.removeEventListener('mouseleave', resetImage);
                };
            },
        });
    }

    const servicesSection = document.querySelector('.services-section');

    if (servicesSection) {
        const startServiceBreathing = () => {
            gsap.to('.service-card', {
                scale: 1.01,
                duration: 10,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut',
                stagger: {
                    each: .35,
                    repeat: -1,
                    yoyo: true,
                },
            });
        };

        gsap.timeline({
            defaults: { duration: .72, ease: 'power2.out' },
            scrollTrigger: {
                trigger: servicesSection,
                start: 'top 72%',
                once: true,
            },
        })
            .to('.services-label', { autoAlpha: 1, y: 0 })
            .to('.services-title-line', { autoAlpha: 1, y: 0, stagger: .12 }, .12)
            .to('.services-subtitle', { autoAlpha: 1, y: 0 }, .38)
            .to('.service-card', { autoAlpha: 1, y: 0, scale: 1, stagger: .09 }, .58)
            .to('.services-cta', { autoAlpha: 1, y: 0, onComplete: startServiceBreathing }, .95);

    }

    const upcomingEvents = document.querySelector('.upcoming-events');

    if (upcomingEvents) {
        gsap.timeline({
            defaults: { duration: .78, ease: 'power2.out' },
            scrollTrigger: {
                trigger: upcomingEvents,
                start: 'top 72%',
                once: true,
            },
        })
            .to('.upcoming-events-label', { autoAlpha: 1, y: 0 })
            .to('.upcoming-events-title', { autoAlpha: 1, y: 0 }, .12)
            .to('.upcoming-events-copy', { autoAlpha: 1, y: 0 }, .28)
            .to('.event-card', { autoAlpha: 1, y: 0, stagger: .16 }, .5)
            .to('.event-empty', { autoAlpha: 1, y: 0 }, .5);
    }

    const testimonialsSection = document.querySelector('.testimonials-section');

    if (testimonialsSection) {
        gsap.timeline({
            defaults: { duration: .82, ease: 'power2.out' },
            scrollTrigger: {
                trigger: testimonialsSection,
                start: 'top 72%',
                once: true,
            },
        })
            .to('.testimonials-label', { autoAlpha: 1, y: 0 })
            .to('.testimonials-title span', { autoAlpha: 1, y: 0, stagger: .13 }, .12)
            .to('.testimonials-intro', { autoAlpha: 1, y: 0, duration: .72 }, .34)
            .to('.testimonial-slide', { autoAlpha: 1, y: 0, stagger: .12 }, .58)
            .to('.testimonials-cta', { autoAlpha: 1, y: 0 }, .9);
    }

    gsap.utils.toArray('.reveal').forEach((element) => {
        if (element.closest('.hero-copy')) return;

        gsap.to(element, {
            autoAlpha: 1,
            y: 0,
            duration: 1.05,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 84%',
            },
        });
    });

    gsap.utils.toArray('.reveal-card').forEach((element, index) => {
        gsap.to(element, {
            autoAlpha: 1,
            y: 0,
            duration: .9,
            delay: (index % 3) * .08,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 86%',
            },
        });
    });

    gsap.utils.toArray('.reveal-image').forEach((element) => {
        gsap.to(element, {
            autoAlpha: 1,
            y: 0,
            duration: 1.15,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 88%',
            },
        });
    });

    gsap.to('.hero-photo', {
        scale: 1,
        yPercent: 8,
        ease: 'none',
        scrollTrigger: {
            trigger: '.hero-scene',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        },
    });

    gsap.utils.toArray('.gallery-photo, .contact-photo').forEach((element) => {
        gsap.to(element, {
            yPercent: -6,
            ease: 'none',
            scrollTrigger: {
                trigger: element,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            },
        });
    });

    gsap.to('.ambient-light', {
        xPercent: 4,
        yPercent: -3,
        opacity: .72,
        ease: 'sine.inOut',
        repeat: -1,
        yoyo: true,
        duration: 7,
    });

    gsap.to('.floating-nav', {
        scrollTrigger: {
            trigger: document.body,
            start: '80px top',
            end: 'max',
            toggleClass: { targets: '.floating-nav', className: 'is-compact' },
        },
    });

    document.querySelectorAll('.magnetic-button').forEach((button) => {
        button.addEventListener('mousemove', (event) => {
            const rect = button.getBoundingClientRect();
            const x = event.clientX - rect.left - rect.width / 2;
            const y = event.clientY - rect.top - rect.height / 2;
            gsap.to(button, { x: x * .08, y: y * .18, duration: .35, ease: 'power3.out' });
        });

        button.addEventListener('mouseleave', () => {
            gsap.to(button, { x: 0, y: 0, duration: .5, ease: 'elastic.out(1, .45)' });
        });
    });

    document.querySelectorAll('.testimonials-carousel').forEach((carousel) => {
        const shell = carousel.closest('.testimonials-carousel-shell');
        const dots = shell ? Array.from(shell.querySelectorAll('.testimonial-dots button')) : [];
        const slides = Array.from(carousel.querySelectorAll('.testimonial-slide'));
        let isDown = false;
        let startX = 0;
        let scrollLeft = 0;
        let scrollTimeout;

        const getStep = () => {
            const slide = slides[0];
            if (!slide) return carousel.clientWidth;

            const style = window.getComputedStyle(carousel);
            return slide.offsetWidth + parseFloat(style.columnGap || style.gap || 0);
        };

        const getVisibleCount = () => {
            if (window.matchMedia('(max-width: 640px)').matches) return 1;
            if (window.matchMedia('(max-width: 900px)').matches) return 2;
            return 4;
        };

        const updateDots = () => {
            const step = getStep();
            const index = Math.round(carousel.scrollLeft / (step * getVisibleCount()));

            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('is-active', dotIndex === index);
            });
        };

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                carousel.scrollTo({
                    left: getStep() * getVisibleCount() * index,
                    behavior: 'smooth',
                });
            });
        });

        carousel.addEventListener('scroll', () => {
            window.clearTimeout(scrollTimeout);
            scrollTimeout = window.setTimeout(updateDots, 60);
        });

        carousel.addEventListener('pointerdown', (event) => {
            if (event.pointerType === 'touch') return;

            isDown = true;
            startX = event.pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
            carousel.classList.add('is-dragging');
            carousel.setPointerCapture(event.pointerId);
        });

        carousel.addEventListener('pointermove', (event) => {
            if (!isDown) return;

            event.preventDefault();
            const x = event.pageX - carousel.offsetLeft;
            carousel.scrollLeft = scrollLeft - (x - startX);
        });

        const stopDragging = () => {
            isDown = false;
            carousel.classList.remove('is-dragging');
        };

        carousel.addEventListener('pointerup', stopDragging);
        carousel.addEventListener('pointercancel', stopDragging);
        carousel.addEventListener('mouseleave', stopDragging);
        updateDots();
    });
} else {
    document.querySelectorAll('.reveal, .reveal-line, .reveal-title, .reveal-card, .reveal-image, .section-2-label, .section-2-title-line, .section-2-copy, .section-2-image, .services-label, .services-title-line, .services-subtitle, .service-card, .services-cta, .upcoming-events-label, .upcoming-events-title, .upcoming-events-copy, .event-card, .event-empty, .testimonials-label, .testimonials-title span, .testimonials-intro, .testimonial-slide, .testimonials-cta').forEach((element) => {
        element.style.opacity = 1;
        element.style.visibility = 'visible';
        element.style.transform = 'none';
    });

    document.querySelectorAll('.section-2-divider').forEach((element) => {
        element.style.transform = 'scaleY(1)';
    });
}
