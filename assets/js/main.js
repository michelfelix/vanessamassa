document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('site-header');
    const toggle = document.querySelector('.menu-toggle');

    const updateHeader = () => {
        if (window.scrollY > 30) {
            header?.classList.add('is-scrolled');
        } else {
            header?.classList.remove('is-scrolled');
        }
    };

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    toggle?.addEventListener('click', () => {
        const isOpen = header.classList.toggle('menu-open');
        toggle.setAttribute('aria-expanded', String(isOpen));
    });

    document.querySelectorAll('.main-navigation a').forEach((link) => {
        link.addEventListener('click', () => {
            header.classList.remove('menu-open');
            toggle?.setAttribute('aria-expanded', 'false');
        });
    });
});
