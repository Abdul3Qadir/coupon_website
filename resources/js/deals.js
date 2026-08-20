/**
 * Deals Page Scripts — coupon_website
 * File: resources/js/deals.js
 */

document.addEventListener('DOMContentLoaded', function () {
    // ── Category Show All / Show Less ──
    const showAllBtn = document.getElementById('dealsShowAllCategories');
    const remainingCategories = document.getElementById('dealsRemainingCategories');

    if (showAllBtn && remainingCategories) {
        showAllBtn.addEventListener('click', function () {
            const expanded = this.dataset.expanded === 'true';

            if (!expanded) {
                // Expand: set max-width to scrollWidth for smooth animation
                remainingCategories.style.maxWidth = remainingCategories.scrollWidth + 'px';
                remainingCategories.style.opacity = '1';
                // Move button to end
                remainingCategories.parentNode.appendChild(this);
                this.textContent = 'Show Less −';
                this.dataset.expanded = 'true';
            } else {
                // Collapse
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
            ([entry]) => {
                filterBar.style.boxShadow = entry.isIntersecting ? '' : '0 4px 20px rgba(0,0,0,0.06)';
            },
            { threshold: 1.0, rootMargin: '-1px 0px 0px 0px' }
        );
        observer.observe(sentinel);
    }
});