document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('dashboardSidebar');
    var backdrop = document.getElementById('mobileSidebarBackdrop');
    var openBtn = document.getElementById('openSidebarBtn');
    var closeBtn = document.getElementById('closeSidebarBtn');

    if (!sidebar || !backdrop) return;

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    }

    if (openBtn) openBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    backdrop.addEventListener('click', closeSidebar);
});
