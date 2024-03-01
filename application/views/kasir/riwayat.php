<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Transaksi</title>
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/StyleAll.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/StyleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>

<body>
    <?php include('layout/sidebar.php'); ?>
    <!-- Page Content -->
    <div class="container mt-5">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Riwayat Transaksi</h2>
        </div>
        <div class="header-container">
        <div class="datePeriod">
            <label for="dateRange">Periode:</label>
            <input type="date" id="startDate" onchange="filterData()">
            <span>-</span>
            <input type="date" id="endDate" onchange="filterData()" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="search-box">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search..." required>
                <button onclick="searchItem()">
                    <i class="ion-search ion-2x"></i>
                </button>
            </div>
        </div>
        </div>
        <table id="myTable"class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <th>ID Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Harga Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_laporan as $detail) : ?>
                    <?php 
                    $pelanggan = $this->Kasir_Model->customerbyid($detail->PelangganID);
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
                    <td><?php echo "POS-" . $detail->PenjualanID;?></td>
                    <td><?php echo $pelanggan->NamaPelanggan;?></td>
                    <td id="subtotal">
                        <?php 
                            $subtotal = $detail->TotalHarga; 
                            // Menggunakan number_format() dengan 2 digit di belakang koma
                            echo 'Rp ' . number_format($subtotal, 2, ',', '.') . (strpos($subtotal, '.') === false ? ',00' : '');
                        ?>
                    </td>
                    <td class="action-buttons">
                        <a onclick="openStrukModal(<?php $id=$detail->PenjualanID;echo $id;?>)" class="btn-view">
                            <i class="ion-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>

        <div id="pagination">
            <button onclick="previousPage()">Sebelumnya</button>
            <span id="currentPage">1</span>
            <button onclick="nextPage()">Selanjutnya</button>
        </div>
        
    </div>

    <div class="modal-container" id="strukModal">
    </div>

    <?php //include('layout/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url("assets/js/laporan.js")?>"></script>
    <script>
    function openStrukModal(id) {
        
        $.ajax({
            type: 'POST', // or 'POST' depending on your needs
            url: '<?= base_url() ?>kasir/kasir/struk/' +id, // Replace with the actual ID
            data: {
                id: id,
            },
            success: function(response) {
                $("#strukModal").html(response).css("display", "flex");
                //document.getElementById("editModal").style.display = "flex";
                //$("#editModal").html(response).modal('show');
                // $(response).modal("show");
                // $('body').removeClass('modal-backdrop');
                // $('.modal-backdrop').remove();
            },
            error: function(xhr, status, error) {
                // Handle error if needed
            }
        });
    }
    function searchItem() {
        var input = document.getElementById("searchInput").value.toUpperCase();
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) { // Start from 1 to exclude the header row
            var rowData = rows[i].innerText.toUpperCase();
            if (rowData.indexOf(input) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }

        // Reset current page after search
        currentPage = 1;
        document.getElementById("currentPage").innerText = currentPage;

        // Disable buttons after search
        document.getElementById("previousButton").disabled = true;
        document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
    }
    
    var currentPage = 1;
    var rowsPerPage = 10; // Number of rows per page, adjust as needed

    function showRowsForPage(page) {
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) { // Start from 1 to exclude the header row
            rows[i].style.display = (i >= (page - 1) * rowsPerPage + 1 && i <= page * rowsPerPage) ? "" : "none";
        }

        // Show or hide pagination buttons based on current page
        document.getElementById("previousButton").disabled = (currentPage > 1) ? false : true;
        document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
    }

    function previousPage() {
        if (currentPage > 1) {
            currentPage--;
            document.getElementById("currentPage").innerText = currentPage;
            showRowsForPage(currentPage);
        }
    }

    function nextPage() {
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tr");

        if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) {
            currentPage++;
            document.getElementById("currentPage").innerText = currentPage;
            showRowsForPage(currentPage);
        }
    }

    // Show initial page
    showRowsForPage(currentPage);
        
    // Function to close the Edit Modal
    function closeStrukModal() {
        document.getElementById("strukModal").style.display = "none";
    }

    </script>
</body>
</html>