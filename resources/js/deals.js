document.addEventListener('DOMContentLoaded', function () {
    // ── Category Modal ──
    const modal = document.getElementById('dealsCategoriesModal');
    const overlay = document.getElementById('dealsModalOverlay');
    const showBtn = document.getElementById('dealsShowAllCategories');
    const closeBtn = document.getElementById('dealsCloseCategoriesModal');

    function openModal() {
        if (!modal) return;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        // Focus trap for accessibility
        closeBtn?.focus();
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        showBtn?.focus();
    }

    showBtn?.addEventListener('click', openModal);
    closeBtn?.addEventListener('click', closeModal);
    overlay?.addEventListener('click', closeModal);

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // ── Search Input: Clear button auto-focus ──
    const searchInput = document.querySelector('input[name="search"]');
    const clearBtn = document.getElementById('dealsSearchClear');

    if (searchInput && clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            searchInput.focus();
        });
    }

    // ── Sticky shadow on scroll ──
    const filterBar = document.querySelector('.deals-filter-bar');
    if (filterBar) {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (!entry.isIntersecting) {
                    filterBar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.06)';
                } else {
                    filterBar.style.boxShadow = '';
                }
            },
            { threshold: 1.0, rootMargin: '-1px 0px 0px 0px' }
        );
        // Create a sentinel element right before the filter bar
        const sentinel = document.createElement('div');
        sentinel.style.position = 'absolute';
        sentinel.style.top = '0';
        sentinel.style.height = '1px';
        filterBar.parentElement.style.position = 'relative';
        filterBar.parentElement.insertBefore(sentinel, filterBar);
        observer.observe(sentinel);
    }
});
