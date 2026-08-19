document.addEventListener('DOMContentLoaded', function () {
    var grid = document.getElementById('storesGrid');
    var noResults = document.getElementById('noStoresFound');
    var categoryButtons = document.querySelectorAll('.category-filter-btn');
    var tabButtons = document.querySelectorAll('.store-tab-btn');
    var storesHeading = document.getElementById('storesHeading');
    var showCategoriesBtn = document.getElementById('showCategoriesBtn');
    var remainingCategories = document.getElementById('remainingCategories');

    if (showCategoriesBtn && remainingCategories) {

        showCategoriesBtn.addEventListener('click', function () {

            var expanded = this.dataset.expanded === 'true';

            if (!expanded) {

                remainingCategories.style.maxWidth =
                    remainingCategories.scrollWidth + 'px';

                remainingCategories.style.opacity = '1';

                remainingCategories.parentNode.appendChild(this);

                this.textContent = 'Show Less −';
                this.dataset.expanded = 'true';

            } else {

                remainingCategories.style.maxWidth = '0px';
                remainingCategories.style.opacity = '0';

                this.textContent =
                    'Show All (' + this.dataset.count + ')+';

                this.dataset.expanded = 'false';
            }
        });
    }

    if (!grid) return;

    var cards = grid.querySelectorAll('.store-card');
    var activeCategory = 'all';
    var activeTab = 'all';

    function applyFilters() {
        var visibleCount = 0;

        cards.forEach(function (card) {
            var cardTabs = (card.dataset.tab || '').split(' ');
            var matchesCategory = activeCategory === 'all' || card.dataset.category === activeCategory;
            var matchesTab = cardTabs.indexOf(activeTab) !== -1;
            var matches = matchesCategory && matchesTab;

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
                b.classList.add('bg-gray-100', 'text-gray-800');
            });
            btn.classList.add('active', 'bg-gray-900', 'text-white');
            btn.classList.remove('bg-gray-100', 'text-gray-800');

            activeCategory = btn.dataset.category;
            applyFilters();
        });
    });

    tabButtons.initHeading = function(btn) {
        if (storesHeading) {
            var tabName = btn.textContent.trim();
            storesHeading.textContent = tabName.toLowerCase().includes('store') ? tabName : tabName + ' Stores';
        }
    };

    tabButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabButtons.forEach(function (b) {
                b.classList.remove('active', 'bg-gray-900', 'text-white');
                b.classList.add('text-gray-500');
            });
            btn.classList.add('active', 'bg-gray-900', 'text-white');
            btn.classList.remove('text-gray-500');

            activeTab = btn.dataset.tab;
            tabButtons.initHeading(btn);
            applyFilters();
        });
    });

    applyFilters();
});