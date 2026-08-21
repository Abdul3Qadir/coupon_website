document.addEventListener('DOMContentLoaded', function () {
    
    var showAllBtn = document.getElementById('dealsShowAllCategories');
    var remainingCategories = document.getElementById('dealsRemainingCategories');

    if (showAllBtn && remainingCategories) {
        showAllBtn.addEventListener('click', function () {
            var expanded = this.dataset.expanded === 'true';

            if (!expanded) {
                remainingCategories.style.maxWidth = remainingCategories.scrollWidth + 'px';
                remainingCategories.style.opacity = '1';
                remainingCategories.parentNode.appendChild(this);
                this.textContent = 'Show Less −';
                this.dataset.expanded = 'true';
            } else {
                remainingCategories.style.maxWidth = '0px';
                remainingCategories.style.opacity = '0';
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