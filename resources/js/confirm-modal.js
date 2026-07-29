document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('confirmModal');
    if (!modal) return;

    var titleEl = document.getElementById('confirmModalTitle');
    var messageEl = document.getElementById('confirmModalMessage');
    var confirmBtn = document.getElementById('confirmModalConfirm');
    var cancelBtn = document.getElementById('confirmModalCancel');
    var backdrop = modal.querySelector('.confirm-modal-backdrop');
    var pendingForm = null;

    function openModal(trigger) {
        titleEl.textContent = trigger.dataset.confirmTitle || 'Are you sure?';
        messageEl.textContent = trigger.dataset.confirmMessage || 'This action cannot be undone.';
        confirmBtn.textContent = trigger.dataset.confirmButton || 'Yes, Continue';
        pendingForm = trigger.closest('form') || document.getElementById(trigger.dataset.confirmFormId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        pendingForm = null;
    }

    document.querySelectorAll('.confirm-action').forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            openModal(trigger);
        });
    });

    confirmBtn.addEventListener('click', function () {
        if (pendingForm) {
            pendingForm.submit();
        }
        closeModal();
    });

    cancelBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });
});
