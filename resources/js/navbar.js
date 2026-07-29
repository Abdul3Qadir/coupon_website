const openBtn = document.querySelector('button[aria-label="Open menu"]');
const closeBtn = document.getElementById('close-menu-btn');
const menuOverlay = document.getElementById('mobile-menu');

const mobileSearchBtn = document.getElementById('mobile-search-btn');
const closeSearchBtn = document.getElementById('close-search-btn');
const searchModal = document.getElementById('mobile-search-modal');


// Navbar JS
if (menuOverlay) {

    const menuDrawer = menuOverlay.querySelector('div > div');

    function openMenu() {
        menuOverlay.classList.remove(
            'opacity-0',
            'pointer-events-none'
        );

        menuDrawer.classList.remove('-translate-x-full');
    }

    function closeMenu() {
        menuOverlay.classList.add(
            'opacity-0',
            'pointer-events-none'
        );

        menuDrawer.classList.add('-translate-x-full');
    }

    if (openBtn) {
        openBtn.addEventListener('click', openMenu);
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    menuOverlay.addEventListener('click', (e) => {
        if (e.target === menuOverlay) {
            closeMenu();
        }
    });
}

// Mobile Search

if (searchModal) {

    const searchContent = searchModal.querySelector('div > div');
    const searchInput = searchModal.querySelector('input');

    function openSearch() {
        searchModal.classList.remove(
            'opacity-0',
            'pointer-events-none'
        );

        searchContent.classList.remove('-translate-y-10');

        if (searchInput) {
            searchInput.focus();
        }
    }

    function closeSearch() {
        searchModal.classList.add(
            'opacity-0',
            'pointer-events-none'
        );

        searchContent.classList.add('-translate-y-10');
    }

    if (mobileSearchBtn) {
        mobileSearchBtn.addEventListener('click', openSearch);
    }

    if (closeSearchBtn) {
        closeSearchBtn.addEventListener('click', closeSearch);
    }

    searchModal.addEventListener('click', (e) => {
        if (e.target === searchModal) {
            closeSearch();
        }
    });
}