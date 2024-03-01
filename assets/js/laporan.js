// chartScript.js

function printReport() {
    window.print();
}

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

document.addEventListener('DOMContentLoaded', function () {
    updateChart(defaultChartData);

    // Add an event listener to the date inputs
    document.getElementById('startDate').addEventListener('change', handleDateChange);
    document.getElementById('endDate').addEventListener('change', handleDateChange);
});

document.addEventListener('DOMContentLoaded', function () {
    // Set the default start date to the first day of the current month
    var currentDate = new Date();
    var firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    
    // Format the first day of the month as 'YYYY-MM-DD'
    var formattedFirstDay = formatDate(firstDayOfMonth);
    
    document.getElementById('startDate').value = formattedFirstDay;

    // Add an event listener to the date inputs
    document.getElementById('startDate').addEventListener('change', handleDateChange);
    document.getElementById('endDate').addEventListener('change', handleDateChange);

    // Call handleDateChange initially to trigger any necessary actions
    handleDateChange();
});

function formatDate(date) {
    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = date.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
}

function handleDateChange() {
    // Retrieve end date
    var endDate = document.getElementById('endDate').value;

    // Your logic to fetch updated data from the server based on the selected date range
    // Update the chart with the new data

    // For now, let's just alert a message
    // alert('Updating chart based on the selected date range.');
}

function filterData() {
    var startDate = new Date(document.getElementById('startDate').value);
    var endDate = new Date(document.getElementById('endDate').value);
    var grandTotal = 0; // Variabel untuk menyimpan grand total

    var rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        var dateString = row.querySelector('td:first-child').textContent;
        var parts = dateString.split(' ');
        var month = parts[1];
        var monthIndex = getMonthIndex(month);
        var day = parseInt(parts[0]);
        var year = parseInt(parts[2]);
        var tableDate = new Date(year, monthIndex, day);

        if (tableDate < startDate || tableDate > endDate) {
            row.style.display = 'none';
        } else {
            row.style.display = '';
            // Ambil nilai total dari kolom 'Total'
            var totalText = row.querySelector('td:nth-child(5)').textContent;
            var total = parseCurrency(totalText);
            // Tambahkan nilai total ke grand total
            grandTotal += total;
        }
    });

    // Tampilkan grand total
    document.getElementById('grandTotalValue').textContent = formatCurrency(grandTotal);
}

// Fungsi untuk mengubah format mata uang Rupiah menjadi nilai numerik
function parseCurrency(currencyString) {
    // Hapus simbol mata uang dan pemisah ribuan, kemudian konversi ke tipe data numerik
    return parseFloat(currencyString.replace('Rp ', '').replace(/\./g, '').replace(',', '.'));
}

// Fungsi untuk mengubah angka menjadi format mata uang Rupiah
function formatCurrency(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID') + ',00'; // Tambahkan 00 di belakang untuk menampilkan dua digit desimal
}

function getMonthIndex(monthName) {
    // Daftar nama bulan dalam bahasa Inggris dan indeksnya
    var months = {
        'Januari': 0,
        'Februari': 1,
        'Maret': 2,
        'April': 3,
        'Mei': 4,
        'Juni': 5,
        'Juli': 6,
        'Agustus': 7,
        'September': 8,
        'Oktober': 9,
        'November': 10,
        'Desember': 11
    };
    return months[monthName];
}


function updateChart(newChartData) {
    if (salesChart) {
        // If the chart exists, destroy it before updating
        salesChart.destroy();
    }

    salesChart = new Chart(ctx, {
        type: 'bar',
        data: newChartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}