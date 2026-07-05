/* =====================================================================
   Spa Holístico · Pantalla de selección — comportamiento
   ---------------------------------------------------------------------
   - Solo ES Modules. Sin frameworks. Sin librerías de animación.
   - Responsabilidades:
       1. Click en tarjeta → feedback scale(.98) → redirigir al destino.
       2. Teclado: ya son <button>, así que ENTER/SPACE ya disparan click.
          Añadimos soporte extra para flechas (←/→) entre tarjetas.
       3. Respeta prefers-reduced-motion.
   ===================================================================== */

const SELECTOR = '[data-spa-target]';
const PRESS_CLASS = 'is-pressed';
const PRESS_MS = 220;       // duración de la animación de presión
const REDIRECT_DELAY = 280; // pequeña pausa tras presionar antes de navegar

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Marca la intención de reproducir audio en la siguiente navegación.
 * El click del usuario cuenta como interacción válida para las
 * políticas de autoplay de los navegadores.
 */
const flagAutoplayForNextPage = () => {
    try {
        window.sessionStorage.setItem('ramcen-autoplay', '1');
    } catch (error) {
        // sessionStorage no disponible (modo privado, etc.) — se ignora.
    }
};

/**
 * Maneja la pulsación de una tarjeta: aplica la clase visual y
 * redirige después de un pequeño delay para que se vea el feedback.
 *
 * @param {HTMLButtonElement} card
 */
const navigateFromCard = (card) => {
    const target = card.dataset.spaTarget;

    if (!target) return;

    // Indicamos al home que debe iniciar el audio ambiental.
    flagAutoplayForNextPage();

    // Si el usuario prefiere reducir movimiento, saltamos el feedback visual.
    if (!prefersReducedMotion) {
        card.classList.add(PRESS_CLASS);
    }

    window.setTimeout(() => {
        window.location.assign(target);
    }, prefersReducedMotion ? 0 : REDIRECT_DELAY);
};

/**
 * Navegación con flechas entre tarjetas (←/→ o ↑/↓).
 *
 * @param {KeyboardEvent} event
 * @param {HTMLButtonElement[]} cards
 */
const handleArrowNavigation = (event, cards) => {
    const isArrowHorizontal = event.key === 'ArrowRight' || event.key === 'ArrowLeft';
    const isArrowVertical   = event.key === 'ArrowDown'  || event.key === 'ArrowUp';
    if (!isArrowHorizontal && !isArrowVertical) return;

    const currentIndex = cards.indexOf(document.activeElement);
    if (currentIndex === -1) return;

    event.preventDefault();

    const direction = (event.key === 'ArrowRight' || event.key === 'ArrowDown') ? 1 : -1;
    const nextIndex = (currentIndex + direction + cards.length) % cards.length;

    cards[nextIndex].focus();
};

/**
 * Inicializa los listeners de todas las tarjetas de la pantalla.
 */
const initSplashCards = () => {
    const cards = Array.from(document.querySelectorAll(SELECTOR));

    if (cards.length === 0) return;

    cards.forEach((card) => {
        card.addEventListener('click', (event) => {
            // Evitamos que un ENTER "suelto" tras focus se redirija dos veces
            if (card.dataset.spaNavigating === 'true') {
                event.preventDefault();
                return;
            }
            card.dataset.spaNavigating = 'true';
            navigateFromCard(card);
        });
    });

    // Soporte extra: flechas para moverse entre tarjetas.
    document.addEventListener('keydown', (event) => {
        handleArrowNavigation(event, cards);
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSplashCards);
} else {
    initSplashCards();
}