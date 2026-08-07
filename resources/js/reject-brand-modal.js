document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('rejectOfferModal');
    if (!modal) return;

    const backdrop = document.getElementById('rejectOfferBackdrop');
    const cancelBtn = document.getElementById('rejectOfferCancel');
    const form = document.getElementById('rejectOfferForm');
    const messageEl = document.getElementById('rejectOfferMessage');

    function open(trigger) {
        const url = trigger.dataset.rejectUrl;
        const brand = trigger.dataset.brandName || 'the brand';
        const title = trigger.dataset.offerTitle || 'this offer';

        if (!url) {
            console.error('Reject modal: data-reject-url missing');
            return;
        }

        form.action = url;
        messageEl.textContent = 'Tell ' + brand + ' why "' + title + '" wasn\'t approved.';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        form.reset();
    }

    document.querySelectorAll('.open-reject-offer-modal').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            open(trigger);
        });
    });

    if (cancelBtn) cancelBtn.addEventListener('click', close);
    if (backdrop) backdrop.addEventListener('click', close);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            close();
        }
    });
});