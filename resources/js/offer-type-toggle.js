document.addEventListener('DOMContentLoaded', function () {
    var radios = document.querySelectorAll('input[name="type"]');
    var codeWrapper = document.getElementById('codeFieldWrapper');

    if (!radios.length || !codeWrapper) return;

    function syncCodeField() {
        var selected = document.querySelector('input[name="type"]:checked');
        if (!selected) return;

        var isCoupon = selected.value === 'coupon';
        codeWrapper.classList.toggle('hidden', !isCoupon);

        var codeInput = document.getElementById('codeInput');
        if (codeInput) codeInput.required = isCoupon;
    }

    radios.forEach(function (radio) {
        radio.addEventListener('change', syncCodeField);
    });

    syncCodeField();
});