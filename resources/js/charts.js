document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('offersChart');
    if (!canvas || typeof Chart === 'undefined') return;

    var chartData = JSON.parse(canvas.dataset.chart || '{}');
    var labels = Object.keys(chartData);
    var values = Object.values(chartData);

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: '#ef4444',
                borderRadius: 6,
                maxBarThickness: 36,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111827',
                    padding: 10,
                    cornerRadius: 8,
                    titleFont: { family: 'Manrope', weight: 'bold' },
                    bodyFont: { family: 'Inter' },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0, font: { family: 'Inter' } },
                    grid: { color: '#f3f4f6' },
                },
                x: {
                    ticks: { font: { family: 'Inter' } },
                    grid: { display: false },
                },
            },
        },
    });
});