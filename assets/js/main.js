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

/**
 * FAQ em acordeão nas páginas de procedimento.
 * No editor: um Título 2 "Perguntas frequentes", cada pergunta como Título 3
 * e a resposta logo abaixo. O texto continua no HTML (bom para o Google);
 * o script só transforma em acordeão: a primeira aberta, uma por vez.
 */
document.addEventListener('DOMContentLoaded', () => {
    const content = document.querySelector('.procedure-body .entry-content');
    if (!content) return;

    const faqHeading = Array.from(content.querySelectorAll('h2'))
        .find((h2) => /perguntas|frequentes|faq|d[uú]vidas/i.test(h2.textContent));
    if (!faqHeading) return;

    const faq = document.createElement('div');
    faq.className = 'faq-accordion';

    let node = faqHeading.nextElementSibling;
    let item = null;
    let index = 0;

    while (node && node.tagName !== 'H2') {
        const next = node.nextElementSibling;

        if (node.tagName === 'H3') {
            index += 1;
            const id = `faq-resposta-${index}`;

            item = document.createElement('div');
            item.className = 'faq-item';

            const heading = document.createElement('h3');
            heading.className = 'faq-question';

            const button = document.createElement('button');
            button.type = 'button';
            button.setAttribute('aria-expanded', 'false');
            button.setAttribute('aria-controls', id);
            button.innerHTML = `<span>${node.innerHTML}</span><span class="faq-icon" aria-hidden="true"></span>`;
            heading.appendChild(button);

            const answer = document.createElement('div');
            answer.className = 'faq-answer';
            answer.id = id;
            answer.hidden = true;

            item.append(heading, answer);
            faq.appendChild(item);
            node.remove();
        } else if (item) {
            item.querySelector('.faq-answer').appendChild(node);
        }

        node = next;
    }

    if (!index) return;
    faqHeading.after(faq);

    const items = Array.from(faq.querySelectorAll('.faq-item'));
    const setOpen = (target) => {
        items.forEach((el) => {
            const open = el === target;
            el.classList.toggle('is-open', open);
            el.querySelector('button').setAttribute('aria-expanded', String(open));
            el.querySelector('.faq-answer').hidden = !open;
        });
    };

    items.forEach((el) => {
        el.querySelector('button').addEventListener('click', () => {
            setOpen(el.classList.contains('is-open') ? null : el);
        });
    });

    setOpen(items[0]);
});
