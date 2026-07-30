document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('offersChart');

    if (!canvas) return;

    const labels = JSON.parse(canvas.dataset.labels);
    const values = JSON.parse(canvas.dataset.values);

    new Chart(canvas, {
        type: 'bar',

        data: {
            labels,

            datasets: [
                {
                    label: 'Offers',
                    data: values,
                    backgroundColor: '#2563eb',
                    borderRadius: 6,
                    borderSkipped: false,
                },
            ],
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false,
                },
            },

            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },

                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                    },
                },
            },
        },
    });
});