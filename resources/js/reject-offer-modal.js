document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('rejectOfferModal');
    if (!modal) return;

    var backdrop = document.getElementById('rejectOfferBackdrop');
    var cancelBtn = document.getElementById('rejectOfferCancel');
    var form = document.getElementById('rejectOfferForm');
    var messageEl = document.getElementById('rejectOfferMessage');

    function open(trigger) {
        form.action = trigger.dataset.rejectUrl;
        messageEl.textContent = 'Tell ' + trigger.dataset.brandName + ' why "' + trigger.dataset.offerTitle + '" wasn\'t approved.';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function close() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.querySelectorAll('.open-reject-offer-modal').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            open(trigger);
        });
    });

    if (cancelBtn) cancelBtn.addEventListener('click', close);
    if (backdrop) backdrop.addEventListener('click', close);
});