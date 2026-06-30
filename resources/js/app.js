import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

window.Alpine = Alpine;
Alpine.start();

gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!prefersReducedMotion) {
    gsap.set('.reveal, .reveal-line, .reveal-card, .reveal-image', { autoAlpha: 0, y: 34 });
    gsap.set('.reveal-title', { autoAlpha: 0, y: 46, filter: 'blur(10px)' });
    gsap.set('.section-2-label', { autoAlpha: 0, y: 12 });
    gsap.set('.section-2-title-line', { autoAlpha: 0, y: 28 });
    gsap.set('.section-2-copy', { autoAlpha: 0, x: 18 });
    gsap.set('.section-2-divider', { scaleY: 0 });
    gsap.set('.section-2-image', { autoAlpha: 0, scale: .96, y: 0 });

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

        gsap.to('.section-2-particles', {
            xPercent: 1.5,
            yPercent: -2,
            duration: 18,
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

    gsap.to('.particle-field', {
        yPercent: -8,
        xPercent: 2,
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
} else {
    document.querySelectorAll('.reveal, .reveal-line, .reveal-title, .reveal-card, .reveal-image, .section-2-label, .section-2-title-line, .section-2-copy, .section-2-image').forEach((element) => {
        element.style.opacity = 1;
        element.style.visibility = 'visible';
    });

    document.querySelectorAll('.section-2-divider').forEach((element) => {
        element.style.transform = 'scaleY(1)';
    });
}
