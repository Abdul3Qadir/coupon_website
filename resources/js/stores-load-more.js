document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('loadMoreStoresBtn');
    var grid = document.getElementById('storesGrid');

    if (!btn || !grid) return;

    btn.addEventListener('click', function () {
        var url = btn.dataset.nextUrl;
        if (!url) return;

        btn.disabled = true;
        var originalText = btn.textContent;
        btn.textContent = 'Loading...';

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                grid.insertAdjacentHTML('beforeend', data.html);

                if (data.nextPageUrl) {
                    btn.dataset.nextUrl = data.nextPageUrl;
                    btn.disabled = false;
                    btn.textContent = originalText;
                } else {
                    btn.remove();
                }
            })
            .catch(function () {
                btn.disabled = false;
                btn.textContent = originalText;
            });
    });
});