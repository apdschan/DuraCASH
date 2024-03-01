<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/dashboard.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/StyleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <body>
    <?php include('layout/sidebar.php'); ?>
    <!-- Page Content -->
    <div class="content">
        <div class="text1">
            <h2>Dasboard Penjualan</h2>
        </div>

        <!-- Flexbox container for the cards and chart -->
        <div class="flex-container">
            <!-- Card Container -->
            <div class="card-container">
                <div class="card">
                    <h2>Barang Terjual</h2>
                    <h1><?php echo $total_terjual; ?></h1>
                    <a href="<?php echo base_url("kasir/produk/" . $data_kasir->UserID)?>">Lihat Detail</a>
                </div>

                <div class="card">
                    <h2>Stok Barang</h2>
                    <h1><?php echo $total_stock; ?></h1>
                    <a href="<?php echo base_url("kasir/produk/" . $data_kasir->UserID)?>">Lihat Detail</a>
                </div>

                <div class="card">
                    <h2>Customer</h2>
                    <h1><?php echo $total_kasir; ?></h1>
                    <a href="<?php echo base_url("kasir/customer/" . $data_kasir->UserID)?>">Lihat Detail</a>
                </div>
            </div>

            <!-- Chart Container -->
            <div class="chart">
                <h2>Laporan Perbandingan</h2>
                <canvas id="salesChart" width="80%" height="20%" data-labels="<?php  echo json_encode($chartData['labels']); ?>" data-data="<?php echo json_encode($chartData['data']); ?>"></canvas>
            </div>
        </div>
    </div>

<?php include('layout/footer.php'); ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url("assets/js/dashboard.js")?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    // Data chart dari PHP (data yang diterima dari controller)
    var chartData = <?= json_encode($chartData) ?>;

    // Inisialisasi chart
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Total Harga Transaksi',
                data: chartData.data,
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna merah dengan transparansi
                borderColor: 'rgba(255, 99, 132, 1)', // Warna merah
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0, // Non-gebogen
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna merah dengan transparansi
                    borderColor: 'rgba(255, 99, 132, 1)', // Warna merah
                    borderWidth: 1
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Total Harga Transaksi',
                    color: 'rgba(255, 99, 132, 1)' // Warna merah
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: 'rgba(255, 99, 132, 1)' // Warna merah
                    }
                }
            }
        }
    });
</script>
</html>