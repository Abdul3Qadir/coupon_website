document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('categorySearchInput');
    var grid = document.getElementById('categoryGrid');
    var noResults = document.getElementById('noCategoriesFound');

    if (!input || !grid) return;

    var cards = grid.querySelectorAll('.category-card');

    input.addEventListener('input', function () {
        var query = input.value.trim().toLowerCase();
        var visibleCount = 0;

        cards.forEach(function (card) {
            var name = card.dataset.name || '';
            var matches = name.indexOf(query) !== -1;
            card.classList.toggle('hidden', !matches);
            if (matches) visibleCount++;
        });

        if (noResults) {
            noResults.classList.toggle('hidden', visibleCount !== 0);
        }
    });
});