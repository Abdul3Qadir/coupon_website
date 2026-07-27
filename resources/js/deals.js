document.addEventListener('DOMContentLoaded', function () {
    var grid = document.getElementById('dealsGrid');
    var noResults = document.getElementById('noDealsFound');
    var categoryButtons = document.querySelectorAll('.category-filter-btn');
    var statusButtons = document.querySelectorAll('.status-tab-btn');

    if (!grid) return;

    var cards = grid.querySelectorAll('.deal-card');
    var activeCategory = 'all';
    var activeStatus = 'active';

    function applyFilters() {
        var visibleCount = 0;

        cards.forEach(function (card) {
            var matchesCategory = activeCategory === 'all' || card.dataset.category === activeCategory;
            var matchesStatus = card.dataset.status === activeStatus;
            var matches = matchesCategory && matchesStatus;

            card.classList.toggle('hidden', !matches);
            if (matches) visibleCount++;
        });

        if (noResults) {
            noResults.classList.toggle('hidden', visibleCount !== 0);
        }
    }

    categoryButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            categoryButtons.forEach(function (b) {
                b.classList.remove('active', 'bg-gray-900', 'text-white');
                b.classList.add('bg-gray-50', 'text-gray-800');
            });
            btn.classList.add('active', 'bg-gray-900', 'text-white');
            btn.classList.remove('bg-gray-50', 'text-gray-800');

            activeCategory = btn.dataset.category;
            applyFilters();
        });
    });

    statusButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            statusButtons.forEach(function (b) {
                b.classList.remove('active', 'bg-gray-900', 'text-white');
                b.classList.add('text-gray-500');
            });
            btn.classList.add('active', 'bg-gray-900', 'text-white');
            btn.classList.remove('text-gray-500');

            activeStatus = btn.dataset.status;
            applyFilters();
        });
    });

    applyFilters();
});