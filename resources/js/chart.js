import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('tabunganChart').getContext('2d');

    fetch('/chart-data')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels, // Nama bulan sebagai label
                    datasets: data.datasets, // Data dari controller
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Statistik Pemasukan dan Pengeluaran Bulanan',
                        },
                    },
                },
            });
        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
        });
});
