const openBtn = document.querySelector('button[aria-label="Open menu"]');
const closeBtn = document.getElementById('close-menu-btn');
const menuOverlay = document.getElementById('mobile-menu');
const menuDrawer = menuOverlay.querySelector('div > div');
const mobileSearchBtn = document.getElementById('mobile-search-btn');
const closeSearchBtn = document.getElementById('close-search-btn');
const searchModal = document.getElementById('mobile-search-modal');
const searchBox = searchModal.querySelector('div > div').parentElement;

// HamBurger JS

function openMenu() {
    menuOverlay.classList.remove('opacity-0', 'pointer-events-none');
    menuDrawer.classList.remove('-translate-x-full');
}

function closeMenu() {
    menuOverlay.classList.add('opacity-0', 'pointer-events-none');
    menuDrawer.classList.add('-translate-x-full');
}

openBtn.addEventListener('click', openMenu);
closeBtn.addEventListener('click', closeMenu);
menuOverlay.addEventListener('click', (e) => {
    if (e.target === menuOverlay) closeMenu();
});

// Search Modal JS

function openSearch() {
    searchModal.classList.remove('opacity-0', 'pointer-events-none');
    searchModal.querySelector('div > div').classList.remove('-translate-y-10');
    searchModal.querySelector('input').focus();
}

function closeSearch() {
    searchModal.classList.add('opacity-0', 'pointer-events-none');
    searchModal.querySelector('div > div').classList.add('-translate-y-10');
}

mobileSearchBtn.addEventListener('click', openSearch);
closeSearchBtn.addEventListener('click', closeSearch);
searchModal.addEventListener('click', (e) => {
    if (e.target === searchModal) closeSearch();
});

