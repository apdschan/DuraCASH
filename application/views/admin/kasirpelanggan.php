<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir & Pelanggan</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <?php include('layout/sidebar.php'); ?>
    <!-- Page Content -->
    <div class="container mt-5">
    
        <h2>List Pelanggan
            <div class="search-box">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button onclick="searchCustomers()">
                        <i class="ion-search ion-2x"></i>
                    </button>
                </div>
            </div>
        </h2>

        <div>
            <button class="add-btn" onclick="openAddModal()"><i class="ion-plus ion-2x"></i>Tambah Pelanggan</button>
        </div>

        <table id="tblpelanggan" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_pelanggan as $data) : ?>
                <tr>
                    <td><?php echo $data->NamaPelanggan; ?></td>
                    <td><?php echo $data->AlamatJalan . ", " . $data->AlamatKelurahan . ", " . $data->AlamatKecamatan . ",<br>" . $data->AlamatKabupatenKota . ", " . $data->AlamatProvinsi .", " . $data->AlamatKodePos; ?></td>
                    <td><?php echo $data->NomorTelepon; ?></td>
                    <td class="action-buttons">
                        <a href="#" class="btn-view" onclick="openViewModal(this)">
                            <i class="ion-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-edit" onclick="openEditModal(<?php $id=$data->PelangganID;echo $id;?>)">
                            <i class="ion-edit"></i>
                        </a>
                        <a href="#" class="btn-delete" onclick="openDeleteModal(<?php echo $data->PelangganID; ?>)">
                            <i class="ion-android-delete"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                
        <div id="pagination">
            <button onclick="previousPage()">Sebelumnya</button>
            <span id="currentPage">1</span>
            <button onclick="nextPage()">Selanjutnya</button>
        </div>
        
    </div>

    <div class="container mt-5">
    
        <h2>List Kasir
            <div class="search-box">
                <div class="search-container">
                    <input type="text" id="searchInputKasir" placeholder="Search...">
                    <button onclick="searchKasir()">
                        <i class="ion-search ion-2x"></i>
                    </button>
                </div>
            </div>
        </h2>

        <div>
            <button class="add-btn" onclick="openAddModalKasir()"><i class="ion-plus ion-2x"></i>Tambah Kasir</button>
        </div>

        <table id="tblkasir" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_kasir as $data) : ?>
                <tr>
                    <td><?php echo $data->NamaUser; ?></td>
                    <td><?php echo $data->AlamatJalan . ", " . $data->AlamatKelurahan . ", " . $data->AlamatKecamatan . ",<br>" . $data->AlamatKabupatenKota . ", " . $data->AlamatProvinsi .", " . $data->AlamatKodePos; ?></td>
                    <td><?php echo $data->NomorTelepon; ?></td>
                    <td class="action-buttons">
                        <a href="#" class="btn-view" onclick="openViewModal(this)">
                            <i class="ion-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-edit" onclick="openEditModalKasir(<?php $id=$data->UserID;echo $id;?>)">
                            <i class="ion-edit"></i>
                        </a>
                        <a href="#" class="btn-delete" onclick="openDeleteModalKasir(<?php echo $data->UserID; ?>)">
                            <i class="ion-android-delete"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
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
            <h3>Tambah Pelanggan</h3>
            <div id="addContent">
                <!-- Add your form fields for adding a customer here -->
                <!-- Example: -->
                <form action="<?php echo base_url("admin/admin/tambahpelanggan");?>" method="post">
                <label for="customerName">Nama :</label>
                <?php 
                // Generate a random 4-digit number
                $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

                // Ensure the identifier starts with '1'
                $finalUniqueId = '1' . $randomNumber;
                ?>
                <input type="hidden" name="id" value="<?php echo $finalUniqueId?>">
                <input type="text" id="customerName" name="namacustomer" required>

                <label for="customerAddres">Alamat</label><br>
                    <div class="address-container-customer">
                        <label for="customerAddres">Jalan :</label>
                        <input type="text" id="customerAddres" name="jalan" required placeholder="Jl. ...">

                        <label for="customerAddres">Kelurahan: </label>
                        <input type="text" id="customerAddres" name="kelurahan" required placeholder="Desa...">
                        
                        <label for="customerAddres">Kecamatan :</label>
                        <input type="text" id="customerAddres" name="kecamatan" required placeholder="Kecamatan...">

                        <label for="customerAddres">Kabupaten / Kota :</label>
                        <input type="text" id="customerAddres" name="kabupatenkota" required placeholder="Kabupaten... / Kota...">

                        <label for="customerAddres">Provinsi :</label>
                        <input type="text" id="customerAddres" name="provinsi" required placeholder="Provinsi...">

                        <label for="customerAddres">KodePos :</label>
                        <input type="text" id="customerAddres" name="kodepos" required>
                    </div>
                
                <label for="customerPhone">Phone :</label>
                <input type="text" id="customerPhone" name="nomortelepon" required>
            </div>
            <div class="button-container">
                <center>
                <button type="submit">Tambah</button>
                <button onclick="closeAddModal()">Batal</button>
                </center>
            </div>
                </form>
        </div>
    </div>

    <div class="modal-container" id="addModalKasir">
        <div class="modal-content">
            <h3>Tambah Kasir</h3>
            <div id="addContent">
                <form action="<?php echo base_url("admin/admin/tambahkasir");?>" method="post">
                    <label for="customerName">Nama :</label>
                    <input type="hidden" name="role" value="2">
                    <input type="text" id="customerName" name="namakasir" required>

                    <label for="customerAddres">Email :</label>
                    <input type="text" id="customerAddres" name="email">
        
                    <label for="customerAddres">Password :</label>
                    <input type="text" id="customerAddres" name="sandi">

                    <label for="customerAddres">Alamat</label><br>
                    <div class="address-container">
                        <label for="customerAddres">Jalan :</label>
                        <input type="text" id="customerAddres" name="jalan" required placeholder="Jl. ...">

                        <label for="customerAddres">Kelurahan: </label>
                        <input type="text" id="customerAddres" name="kelurahan" required placeholder="Desa...">
                        
                        <label for="customerAddres">Kecamatan :</label>
                        <input type="text" id="customerAddres" name="kecamatan" required placeholder="Kecamatan...">

                        <label for="customerAddres">Kabupaten / Kota :</label>
                        <input type="text" id="customerAddres" name="kabupatenkota" required placeholder="Kabupaten... / Kota...">

                        <label for="customerAddres">Provinsi :</label>
                        <input type="text" id="customerAddres" name="provinsi" required placeholder="Provinsi...">

                        <label for="customerAddres">KodePos :</label>
                        <input type="text" id="customerAddres" name="kodepos" required>
                    </div>
                    
                    <label for="customerPhone">Phone :</label>
                    <input type="text" id="customerPhone" name="nomortelepon" required>
                
                <div class="button-container">
                    <center>
                        <button type="submit">Tambah</button>
                        <button onclick="closeAddModalKasir()">Batal</button>
                    </center>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this HTML structure inside your existing document, preferably near the end of the body -->
    <div class="modal-container" id="viewModal">
        <div class="modal-content">
            <!-- Content for View Pop-up -->
            <h3>Detail</h3>
            <div id="viewContent">
                <!-- Content will be dynamically populated here -->
            </div>
            <center>
            <button class="close-btn" onclick="closeViewModal()">Close</button>
            </center>
        </div>
    </div>

<div class="modal-container" id="editModal"></div>
<div class="modal-container" id="editModalKasir"></div>

<div class="modal-container" id="deleteModal">
    <div class="modal-content">
        <!-- Content for Delete Confirmation Pop-up -->
        <!-- You can customize this section based on your needs -->
        <h3>Hapus Pelanggan</h3>
        <center>
        <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
        <button onclick="confirmDelete()">Ya</button>
        <button onclick="closeDeleteModal()">Tidak</button>
        <center>
    </div>
</div>

<div class="modal-container" id="deleteModalKasir">
    <div class="modal-content">
        <!-- Content for Delete Confirmation Pop-up -->
        <!-- You can customize this section based on your needs -->
        <h3>Hapus Petugas Kasir</h3>
        <center>
        <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
        <button onclick="confirmDeleteKasir()">Ya</button>
        <button onclick="closeDeleteModalKasir()">Tidak</button>
        <center>
    </div>
</div>

<?php include('layout/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url("assets/js/cust.js")?>"></script>
    <script>
    // Function to open the Edit Modal
    function openEditModal(id) {
        
        $.ajax({
            type: 'POST', // or 'POST' depending on your needs
            url: '<?= base_url() ?>admin/admin/editmodal/' +id, // Replace with the actual ID
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
    function openDeleteModal(customerId) {
        // Set the customer ID in a data attribute
        $("#deleteModal").attr("data-customer-id", customerId);

        // Show the modal
        document.getElementById("deleteModal").style.display = "flex";
    }

    // Function to confirm the Delete action
    function confirmDelete() {  // Get the customer ID from the data attribute
        var customerId = $("#deleteModal").attr("data-customer-id");

        // Make AJAX request
        $.ajax({
            type: "POST", // You can use "GET" or "POST" depending on your server implementation
            url: "<?= base_url() ?>admin/admin/deleteCustomer/", // Replace with your server endpoint
            data: { id: customerId }, // Data to be sent to the server
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
    
    // Function to open the Edit Modal
    function openEditModalKasir(id) {
        
        $.ajax({
            type: 'POST', // or 'POST' depending on your needs
            url: '<?= base_url() ?>admin/admin/editmodalkasir/' +id, // Replace with the actual ID
            data: {
                id: id,
            },
            success: function(response) {
                $("#editModalKasir").html(response).css("display", "flex");
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
    function openDeleteModalKasir(id) {
        // Set the customer ID in a data attribute
        $("#deleteModalKasir").attr("data-kasir-id", id);

        // Show the modal
        document.getElementById("deleteModalKasir").style.display = "flex";
    }

    // Function to confirm the Delete action
    function confirmDeleteKasir() {  // Get the customer ID from the data attribute
        var customerId = $("#deleteModalKasir").attr("data-kasir-id");

        // Make AJAX request
        $.ajax({
            type: "POST", // You can use "GET" or "POST" depending on your server implementation
            url: "<?= base_url() ?>admin/admin/deleteKasir/", // Replace with your server endpoint
            data: { id: customerId }, // Data to be sent to the server
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
    var currentPage = 1;
    var rowsPerPage = 10; // Number of rows per page, adjust as needed

    function showRowsForPage(page) {
        var table = document.getElementById("tblpelanggan");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) { // Start from 1 to exclude the header row
            rows[i].style.display = (i >= (page - 1) * rowsPerPage + 1 && i <= page * rowsPerPage) ? "" : "none";
        }

        // Show or hide pagination buttons based on current page
        document.getElementById("previousButton").disabled = (currentPage > 1) ? false : true;
        document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
    }

    function searchCustomers() {
        var input = document.getElementById("searchInput").value.toUpperCase();
        var table = document.getElementById("tblpelanggan");
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
        var table = document.getElementById("tblpelanggan");
        var rows = table.getElementsByTagName("tr");

        if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) {
            currentPage++;
            document.getElementById("currentPage").innerText = currentPage;
            showRowsForPage(currentPage);
        }
    }

    // Show initial page
    showRowsForPage(currentPage);
    </script>
</body>

</html>
