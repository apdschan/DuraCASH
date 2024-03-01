var chartCanvas = document.getElementById('salesChart');
var chartData = {
    labels: JSON.parse(chartCanvas.getAttribute('data-labels')),
    datasets: [
        {
            label: 'Penjualan Bulan Kemarin',
            data: [124, 153, 125, 111, 163],
            backgroundColor: 'rgba(196, 46, 29, 0.2)',
            borderColor: 'rgba(196, 46, 29, 1)',
            borderWidth: 1
        },
        {
            label: 'Penjualan Bulan Ini',
            data: [123, 162, 132, 123, 107],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
};

document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});