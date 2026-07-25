document.addEventListener('DOMContentLoaded', function () {
    var pxPerSecond = 50;

    document.querySelectorAll('.brand-carousel-track').forEach(function (track) {
        if (track.dataset.cloned === 'true') return;

        var group = track.querySelector('.brand-carousel-group');
        if (!group) return;

        var clone = group.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        track.appendChild(clone);
        track.dataset.cloned = 'true';

        var width = group.getBoundingClientRect().width;
        if (width > 0) {
            track.style.animationDuration = (width / pxPerSecond) + 's';
        }
    });
});