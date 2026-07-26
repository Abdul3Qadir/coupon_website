document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.faq-item').forEach(function (item) {
        var toggle = item.querySelector('.faq-toggle');
        var panel = item.querySelector('.faq-panel');
        var icon = item.querySelector('.faq-icon');

        if (!toggle || !panel) return;

        toggle.addEventListener('click', function () {
            var isOpen = toggle.getAttribute('aria-expanded') === 'true';

            toggle.setAttribute('aria-expanded', String(!isOpen));
            panel.style.gridTemplateRows = isOpen ? '0fr' : '1fr';

            if (icon) {
                icon.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            }
        });
    });
});