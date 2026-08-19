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
    
    const dropdownBtn = document.getElementById('storeTabDropdownBtn');
    const dropdown = document.getElementById('storeTabDropdown');
    const dropdownIcon = document.getElementById('storeTabDropdownIcon');

    if (dropdownBtn && dropdown) {
        const toggleDropdown = (show) => {
            dropdown.classList.toggle('opacity-0', !show);
            dropdown.classList.toggle('invisible', !show);
            dropdown.classList.toggle('scale-95', !show);
            dropdown.classList.toggle('translate-y-1', !show);

            dropdown.classList.toggle('opacity-100', show);
            dropdown.classList.toggle('visible', show);
            dropdown.classList.toggle('scale-100', show);
            dropdown.classList.toggle('translate-y-0', show);

            if (dropdownIcon) dropdownIcon.classList.toggle('rotate-180', show);
        };

        dropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = !dropdown.classList.contains('invisible');
            toggleDropdown(!isOpen);
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && !dropdownBtn.contains(e.target)) {
                toggleDropdown(false);
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
});