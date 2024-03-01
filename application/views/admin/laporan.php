<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/StyleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <?php include('layout/sidebar.php'); ?>
    <!-- Page Content -->
    <div class="container mt-5">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Laporan Penjualan</h2>
            <!-- Print Button -->
            <button class="print-btn" onclick="printReport()"><i class="ion-android-print ion-2x"></i>Print</button>
        </div>
        <div class="datePeriod">
            <label for="dateRange">Periode:</label>
            <input type="date" id="startDate" onchange="filterData()">
            <span>-</span>
            <input type="date" id="endDate" onchange="filterData()" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Harga Jual</th>
                    <th>Qty Terjual</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_laporan as $data) : ?>
                <?php 
                    $detail = $this->Admin_Model->getdetaillaporanbyid($data->PenjualanID);
                    $produk = $this->Admin_Model->produkbyid($data->ProdukID);
                ?>
                <tr>
                    <?php 
                    // Tanggal dalam format Inggris
                    $tanggalInggris = $detail->TanggalPenjualan;

                    // Format tanggal dalam bahasa Indonesia
                    $tanggalIndonesia = date("d F Y", strtotime($tanggalInggris));

                    // Daftar nama bulan dalam bahasa Indonesia
                    $bulan = array(
                        'January' => 'Januari',
                        'February' => 'Februari',
                        'March' => 'Maret',
                        'April' => 'April',
                        'May' => 'Mei',
                        'June' => 'Juni',
                        'July' => 'Juli',
                        'August' => 'Agustus',
                        'September' => 'September',
                        'October' => 'Oktober',
                        'November' => 'November',
                        'December' => 'Desember'
                    );

                    // Mengganti nama bulan dalam bahasa Indonesia
                    $tanggalIndonesia = strtr($tanggalIndonesia, $bulan);

                    echo "<td>$tanggalIndonesia</td>";
                    ?>
                    <td><?php echo $produk->NamaProduk;?></td>
                    <td id="hargajual">
                        <?php 
                            $hargajual = $produk->HargaJual; 
                            // Menggunakan number_format() dengan 2 digit di belakang koma
                            echo 'Rp ' . number_format($hargajual, 2, ',', '.') . (strpos($hargajual, '.') === false ? ',00' : '');
                        ?>
                    </td>
                    <td><?php echo $data->JumlahProduk;?></td>
                    <td id="subtotal_<?php echo $produk->ProdukID; ?>">
                        <?php 
                            $subtotal = $data->Subtotal; 
                            // Menggunakan number_format() dengan 2 digit di belakang koma
                            echo 'Rp ' . number_format($subtotal, 2, ',', '.') . (strpos($subtotal, '.') === false ? ',00' : '');
                        ?>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
        <div class="grand-total">
            <strong>Grand Total :</strong> <span  id="grandTotalValue">
        </div>
        
        <div class="chart">
            <h2>Laporan Perbandingan</h2>
            <canvas id="salesChart" width="80%" height="20%" 
            data-labels="{{ json_encode($chartData['labels']) }}"
            data-data="{{ json_encode($chartData['data']) }}"></canvas>
        </div>

    </div>

    <?php include('layout/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url("assets/js/laporan.js")?>"></script>
</body>

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
<script>
$(document).ready(function() {
    updateGrandTotal();

    function updateGrandTotal() {
        var grandTotal = 0;
        $('td[id^="subtotal_"]').each(function() {
            var subtotal = parseFloat($(this).text().replace('Rp ', '').replace(/\./g, '').replace(',', '.')); // Menghilangkan karakter "Rp " dan mengganti titik dengan string kosong, mengganti koma dengan titik untuk parsing
            if (!isNaN(subtotal)) {
                grandTotal += subtotal;
            }
        });
        // Ubah grand total ke dalam format mata uang rupiah
        var formattedGrandTotal = grandTotal.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        $('#grandTotalValue').text(formattedGrandTotal);
    }
});
</script>
</html>