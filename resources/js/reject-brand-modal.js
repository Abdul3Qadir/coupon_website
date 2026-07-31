document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('rejectBrandModal');
    if (!modal) return;

    var backdrop = document.getElementById('rejectBrandBackdrop');
    var cancelBtn = document.getElementById('rejectBrandCancel');
    var openBtn = document.getElementById('openRejectBrandModal');

    function open() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function close() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    if (openBtn) openBtn.addEventListener('click', open);
    if (cancelBtn) cancelBtn.addEventListener('click', close);
    if (backdrop) backdrop.addEventListener('click', close);
});