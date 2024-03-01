<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <?php include('layout/sidebar.php'); ?>
    <!-- Page Content -->
    <div class="container mt-5">
        <h2>List Produk
            <div class="search-box">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search..." required>
                    <button onclick="searchItem()">
                        <i class="ion-search ion-2x"></i>
                    </button>
                </div>
            </div>
        </h2>

        <div class="btn2">
            <label for="itemKategori">Kategori:</label> 
            <select id="itemKategori" name="itemKategori" onchange="filterByCategory()" required>
                <option value="all">Semua Kategori</option>
                <?php foreach ($list_kategori as $data) : ?>
                <option value="<?php echo $data->KategoriID; ?>"><?php echo $data->NamaKategori; ?></option>
                <?php endforeach ?>
            </select>
            <button class="add-btn" onclick="openAddModal()"><i class="ion-plus ion-2x"></i>Tambah Produk</button>
        </div>

        <table class="table table-bordered" id="tabelProduk">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Diskon</th>
                    <th>Tanggal Berlaku</th>
                    <th>Harga Jual</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Isi tabel disesuaikan dengan data dari kategori yang dipilih -->
                <?php foreach ($list_produk as $data) : ?>
                        <?php $kategoribyid = $this->Admin_Model->kategoribyidkategori($data->KategoriID);?>
                    <tr data-kategori="<?php echo $data->KategoriID; ?>">
                        <td><?php echo $data->NamaProduk; ?></td>
                        <td><?php echo $kategoribyid->NamaKategori; ?></td>
                        <td><?php echo $data->Stok; ?></td>
                        <td><?php echo "Rp. " . number_format($data->HargaBeli, 2); ?></td>
                        <td>
                            <?php
                            $tanggalSekarang = date("Y-m-d");
                            if ($data->Diskon !== null && $data->Diskon != 0 && $tanggalSekarang >= $data->TanggalAktifDiskon && $tanggalSekarang <= $data->TanggalExpiredDiskon) {
                                echo $data->Diskon . "%";
                            }else{
                                echo "-";
                            }
                            ?>
                        </td>
                        <?php
                        $tanggalSekarang = date("Y-m-d");

                        $bulanIndonesia = array(
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
                        
                        $tanggalAktif = $data->TanggalAktifDiskon ? date("d F Y", strtotime($data->TanggalAktifDiskon)) : "-";
                        $tanggalAktif = strtr($tanggalAktif, $bulanIndonesia);
                        
                        $tanggalExpired = $data->TanggalExpiredDiskon ? date("d F Y", strtotime($data->TanggalExpiredDiskon)) : "-";
                        $tanggalExpired = strtr($tanggalExpired, $bulanIndonesia);

                        if ($tanggalSekarang >= $data->TanggalAktifDiskon && $tanggalSekarang <= $data->TanggalExpiredDiskon) {
                            // Diskon berlaku
                            echo "<td id='tanggal'>$tanggalAktif -<br> $tanggalExpired</td>";
                        } else {
                            // Tidak ada diskon
                            echo "<td>" . "-" . "</td>";
                        }

                        // Logika untuk menentukan apakah diskon berlaku atau tidak
                        if ($tanggalSekarang >= $data->TanggalAktifDiskon && $tanggalSekarang <= $data->TanggalExpiredDiskon) {
                            // Diskon berlaku
                            $hargaSetelahDiskon = $data->HargaJual - ($data->HargaJual * ($data->Diskon / 100));
                            echo "<td>Rp. " . number_format($hargaSetelahDiskon, 2) . "</td>";
                        } else {
                            // Tidak ada diskon
                            echo "<td>Rp. " . number_format($data->HargaJual, 2) . "</td>";
                        }
                        ?>
                        <td class="action-buttons">
                            <a href="#" class="btn-view" onclick="openViewModal(this)">
                                <i class="ion-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn-edit" onclick="openEditModal(<?php $id=$data->ProdukID;echo $id;?>)">
                                <i class="ion-edit"></i>
                            </a>
                            <a href="#" class="btn-delete" onclick="openDeleteModal(<?php echo $data->ProdukID; ?>)">
                                <i class="ion-android-delete"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        
        <div id="pagination">
            <button onclick="previousPage()">Sebelumnya</button>
            <span id="currentPage">1</span>
            <button onclick="nextPage()">Selanjutnya</button>
        </div>
        
    </div>

    <div class="modal-container" id="addModal">
        <div class="modal-content">
            <h3>Tambah Produk</h3>
            <div id="addContent">
                <!-- Add your form fields for adding a customer here -->
                <form method="post" action="<?php echo base_url("admin/admin/tambahproduk");?>">
                <!-- Example: -->
                <label for="itemName">Nama:</label>
                <input type="text" id="itemName" name="namaproduk" required>
                
                <label for="itemCategory">Kategori Barang:</label>
                <select type="Stok" id="itemCategory" name="kategori" required>
                    <?php foreach ($list_kategori as $data) : ?>
                    <option value="<?php echo $data->KategoriID; ?>"><?php echo $data->NamaKategori; ?></option>
                <?php endforeach;?>
                </select><br>
    
                <label for="itemStok">Stok:</label>
                <input type="Stok" id="itemStok" name="stok" required>

                <label for="itemBuy">Harga Beli:</label>
                <input type="text" id="itemBuy" name="hargabeli" required>

                <label for="itemSell">Harga Jual:</label>
                <input type="text" id="itemSell" name="hargajual" required>

                <label for="Discount">Diskon:</label>
                <input type="text" id="Discount" name="diskon">

                <label for="Active">Tanggal Aktif Diskon:</label>
                <input type="date" id="Active" name="tglaktif">

                <label for="Expired">Tanggal Expired Diskon:</label>
                <input type="date" id="Expired" name="tglexprd">
            </div>
            <div class="button-container">
                <center>
                <button type="submit">Tambah</button>
                <button onclick="closeAddModal()">Batal</button>
                </center>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this HTML structure inside your existing document, preferably near the end of the body -->
    <div class="modal-container" id="viewModal">
        <div class="modal-content">
            <!-- Content for View Pop-up -->
            <h3>Detail Produk</h3>
            <div id="viewContent">
                <!-- Content will be dynamically populated here -->
            </div>
            <center>
            <button class="close-btn" onclick="closeViewModal()">Close</button>
            </center>
        </div>
    </div>

    <div class="modal-container" id="editModal">
    </div>

<div class="modal-container" id="deleteModal">
    <div class="modal-content">
        <!-- Content for Delete Confirmation Pop-up -->
        <!-- You can customize this section based on your needs -->
        <h3>Hapus Produk</h3>
        <p><center>Apakah Anda Yakin Ingin Menghapus Data?</center></p>
        <div class="button-container">
            <button onclick="confirmDelete()">Ya</button>
            <button onclick="closeDeleteModal()">Tidak</button>
        </div>
    </div>
</div>

<?php include('layout/footer.php'); ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url("assets/js/item.js")?>"></script>
<script>
// Function to open the Edit Modal
    function openEditModal(id) {
        
        $.ajax({
            type: 'POST', // or 'POST' depending on your needs
            url: '<?= base_url() ?>admin/admin/editmodalproduk/' +id, // Replace with the actual ID
            data: {
                id: id,
            },
            success: function(response) {
                $("#editModal").html(response).css("display", "flex");
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

    // Function to open the Delete Modal
    function openDeleteModal(produkID) {
        // Set the customer ID in a data attribute
        $("#deleteModal").attr("data-produk-id", produkID);

        // Show the modal
        document.getElementById("deleteModal").style.display = "flex";
    }

    // Function to confirm the Delete action
    function confirmDelete() {  // Get the customer ID from the data attribute
        var produkID = $("#deleteModal").attr("data-produk-id");

        // Make AJAX request
        $.ajax({
            type: "POST", // You can use "GET" or "POST" depending on your server implementation
            url: "<?= base_url() ?>admin/admin/deleteproduk/", // Replace with your server endpoint
            data: { id: produkID }, // Data to be sent to the server
            success: function(response) {
                // Handle success response
                console.log("Customer deleted successfully");
                // You can update the UI or perform additional actions as needed

                // Close the modal after successful deletion
                closeDeleteModal();
                    
                // Reload the page
                location.reload();
            },
            error: function(error) {
                // Handle error response
                console.error("Error deleting customer", error);
                // You can provide user feedback or perform additional actions as needed
            }
        });
    }

    //filter kategori
    function filterByCategory() {
        var selectedCategory = document.getElementById("itemKategori").value;
        var tableRows = document.getElementById("tabelProduk").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        for (var i = 0; i < tableRows.length; i++) {
            var rowCategory = tableRows[i].getAttribute("data-kategori");

            if (selectedCategory === "all" || rowCategory === selectedCategory) {
                tableRows[i].style.display = "";
            } else {
                tableRows[i].style.display = "none";
            }
        }
    }
    
    var currentPage = 1;
    var rowsPerPage = 10; // Number of rows per page, adjust as needed

    function showRowsForPage(page) {
        var table = document.getElementById("tabelProduk");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) { // Start from 1 to exclude the header row
            rows[i].style.display = (i >= (page - 1) * rowsPerPage + 1 && i <= page * rowsPerPage) ? "" : "none";
        }

        // Show or hide pagination buttons based on current page
        document.getElementById("previousButton").disabled = (currentPage > 1) ? false : true;
        document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
    }

    function searchItem() {
        var input = document.getElementById("searchInput").value.toUpperCase();
        var table = document.getElementById("tabelProduk");
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

    function previousPage() {
        if (currentPage > 1) {
            currentPage--;
            document.getElementById("currentPage").innerText = currentPage;
            showRowsForPage(currentPage);
        }
    }

    function nextPage() {
        var table = document.getElementById("tabelProduk");
        var rows = table.getElementsByTagName("tr");

        if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) {
            currentPage++;
            document.getElementById("currentPage").innerText = currentPage;
            showRowsForPage(currentPage);
        }
    }

    // Show initial page
    showRowsForPage(currentPage);

    // Fungsi untuk mengonversi tanggal ke format Indonesia
    function formatDateIndo(dateStr) {
        // Mendefinisikan nama-nama bulan dalam bahasa Indonesia
        var months = [
            "Januari", "Februari", "Maret",
            "April", "Mei", "Juni", "Juli",
            "Agustus", "September", "Oktober",
            "November", "Desember"
        ];

        // Mendapatkan objek tanggal dari string tanggal
        var date = new Date(dateStr);

        // Mendapatkan tanggal, bulan, dan tahun
        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        // Mengembalikan tanggal dalam format yang sesuai dengan konvensi Indonesia
        return day + ' ' + months[monthIndex] + ' ' + year;
    }

    // Mendapatkan nilai tanggal dari elemen <td> dengan ID "tanggal"
    var tanggalElem = document.getElementById("tanggal");
    var tanggalStr = tanggalElem.innerHTML;

    // Memformat tanggal menjadi format Indonesia
    var tanggalIndo = formatDateIndo(tanggalStr);

    // Mengganti isi dari elemen <td> dengan tanggal yang telah diformat
    tanggalElem.innerHTML = tanggalIndo;
</script>
</html>