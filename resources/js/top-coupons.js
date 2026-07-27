document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.coupon-reveal-btn').forEach(function (revealBtn) {
        revealBtn.addEventListener('click', function () {
            var box = revealBtn.closest('.coupon-code-box');
            if (!box) return;

            var codeText = box.querySelector('.coupon-code-text');
            var copyAgainBtn = box.querySelector('.coupon-copy-again-btn');
            var code = revealBtn.dataset.code;
            var storeUrl = revealBtn.dataset.storeUrl;

            if (codeText) codeText.classList.remove('blur-sm');
            if (copyAgainBtn) copyAgainBtn.classList.remove('hidden');
            revealBtn.remove();

            if (code && navigator.clipboard) {
                navigator.clipboard.writeText(code);
            }

            if (storeUrl && storeUrl !== '#') {
                window.open(storeUrl, '_blank');
            }
        });
    });

    document.querySelectorAll('.coupon-copy-again-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var code = btn.dataset.code;
            if (!code || !navigator.clipboard) return;

            navigator.clipboard.writeText(code).then(function () {
                var label = btn.querySelector('.copy-label');
                var icon = btn.querySelector('.copy-icon');
                var defaultLabel = btn.dataset.defaultLabel || 'Copy';

                if (label) label.textContent = 'Copied!';
                if (icon) icon.innerHTML = '<path d="M20 6L9 17l-5-5"/>';
                btn.classList.add('bg-emerald-600');
                btn.classList.remove('bg-red-600', 'hover:bg-red-700', 'active:bg-red-800');

                clearTimeout(btn._copyTimeout);
                btn._copyTimeout = setTimeout(function () {
                    if (label) label.textContent = defaultLabel;
                    if (icon) icon.innerHTML = '<rect x="9" y="9" width="12" height="12" rx="2"></rect><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>';
                    btn.classList.remove('bg-emerald-600');
                    btn.classList.add('bg-red-600', 'hover:bg-red-700', 'active:bg-red-800');
                }, 1800);
            });
        });
    });
});