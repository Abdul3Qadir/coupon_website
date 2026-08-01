document.addEventListener('DOMContentLoaded', function () {
    var textarea = document.getElementById('iconInput');
    var preview = document.getElementById('iconPreview');

    if (!textarea || !preview) return;

    function updatePreview() {
        preview.innerHTML = textarea.value.trim();
    }

    textarea.addEventListener('input', updatePreview);
    updatePreview();
});