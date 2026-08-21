document.addEventListener('DOMContentLoaded', function () {
    // ── Category Show All / Show Less ──
    const showAllBtn = document.getElementById('dealsShowAllCategories');

    if (showAllBtn) {
        showAllBtn.addEventListener('click', function () {
            const expanded = this.dataset.expanded === 'true';
            const hiddenCats = document.querySelectorAll('.deals-cat-hidden');

            if (!expanded) {
                // Reveal all hidden categories
                hiddenCats.forEach(function (cat) {
                    cat.classList.remove('deals-cat-hidden');
                });
                this.textContent = 'Show Less −';
                this.dataset.expanded = 'true';
            } else {
                // Hide categories again (index >= 4)
                hiddenCats.forEach(function (cat) {
                    const idx = parseInt(cat.dataset.catIndex, 10);
                    if (idx >= 4) {
                        cat.classList.add('deals-cat-hidden');
                    }
                });
                this.textContent = 'Show All (' + this.dataset.count + ')+';
                this.dataset.expanded = 'false';
            }
        });
    }

    // ── Search Clear Button ──
    const searchInput = document.querySelector('input[name="search"]');
    const clearBtn = document.getElementById('dealsSearchClear');

    if (searchInput && clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            searchInput.focus();
        });
    }

    // ── Sticky Shadow on Scroll ──
    const filterBar = document.querySelector('.deals-filter-bar');
    if (filterBar) {
        const sentinel = document.createElement('div');
        sentinel.style.position = 'absolute';
        sentinel.style.top = '0';
        sentinel.style.height = '1px';
        filterBar.parentElement.style.position = 'relative';
        filterBar.parentElement.insertBefore(sentinel, filterBar);

        const observer = new IntersectionObserver(
            function ([entry]) {
                filterBar.style.boxShadow = entry.isIntersecting ? '' : '0 4px 20px rgba(0,0,0,0.06)';
            },
            { threshold: 1.0, rootMargin: '-1px 0px 0px 0px' }
        );
        observer.observe(sentinel);
    }
});