document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('rejectSubAdminModal');
    if (!modal) return;

    var backdrop = document.getElementById('rejectSubAdminBackdrop');
    var cancelBtn = document.getElementById('rejectSubAdminCancel');
    var openBtn = document.getElementById('openRejectSubAdminModal');

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