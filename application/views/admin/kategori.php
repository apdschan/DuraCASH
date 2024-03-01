<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori Produk</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <?php include('layout/sidebar.php') ?>
    <!-- Page Content -->
    <div class="container mt-5">
        <h2>List Kategori
            <div class="search-box">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button onclick="searchItem()">
                        <i class="ion-search ion-2x"></i>
                    </button>
                </div>
            </div>
        </h2>

            <button class="add-btn" onclick="openAddModal()"><i class="ion-plus ion-2x"></i>Tambah Kategori</button>
        

        <table class="table table-bordered" id="tabelKategori">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_kategori as $data) : ?>
                <tr>
                    <td><?php echo $data->NamaKategori;?></td>
                    <td><?php echo $data->DeskripsiKategori;?></td>
                    <td class="action-buttons">
                        <a href="#" class="btn-view" onclick="openViewModal(this)">
                            <i class="ion-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-edit" onclick="openEditModalKategori(<?php echo $data->KategoriID;?>)">
                            <i class="ion-edit"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-delete" onclick="openDeleteModal(<?php echo $data->KategoriID; ?>)">
                            <i class="ion-android-delete"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>

    <div class="modal-container" id="addModal">
        <div class="modal-content">
            <h3>Tambah Kategori</h3>
            <div id="addContent">
                
                <form action="<?php echo base_url("admin/admin/tambahkategori");?>" method="post">
                <label for="itemName">Nama:</label>
                <input type="text" id="itemName" name="nama" required>
    
                <label for="itemDesc">Deskripsi:</label>
                <input type="text" id="itemDesc" name="deskripsi" required>
            </div>
            <div class="button-container">
                <button onclick="confirmAdd()">Tambah</button>
                <button onclick="closeAddModal()">Batal</button>
            </div>
                </form>
        </div>
    </div>

    <!-- Add this HTML structure inside your existing document, preferably near the end of the body -->
    <div class="modal-container" id="viewModal">
        <div class="modal-content">
            <!-- Content for View Pop-up -->
            <h3>Detail Kategori</h3>
            <div id="viewContent">
                <!-- Content will be dynamically populated here -->
            </div>
            <center><button class="close-btn" onclick="closeViewModal()">Close</button></center>
        </div>
    </div>

    <div class="modal-container" id="editModalKategori">
    </div>

<div class="modal-container" id="deleteModal">
    <div class="modal-content">
        <!-- Content for Delete Confirmation Pop-up -->
        <!-- You can customize this section based on your needs -->
        <h3>Hapus Kategori</h3>
        <p><center>Apakah Anda Yakin Ingin Menghapus Data?</center></p>
        <div class="button-container">
            <button onclick="confirmDelete()">Ya</button>
            <button onclick="closeDeleteModal()">Tidak</button>
        </div>
    </div>
</div>

<?php include('layout/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url("assets/js/kategori.js")?>"></script>
    <script>
            
    // Function to open the Edit Modal
    function openEditModalKategori(id) {
        
        $.ajax({
            type: 'POST', // or 'POST' depending on your needs
            url: '<?= base_url() ?>admin/admin/editmodalkategori/' +id, // Replace with the actual ID
            data: {
                id: id,
            },
            success: function(response) {
                $("#editModalKategori").html(response).css("display", "flex");
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
    function openDeleteModal(kategoriID) {
        // Set the customer ID in a data attribute
        $("#deleteModal").attr("data-kategori-id", kategoriID);

        // Show the modal
        document.getElementById("deleteModal").style.display = "flex";
    }

    // Function to confirm the Delete action
    function confirmDelete() { 
        var kategoriID = $("#deleteModal").attr("data-kategori-id");
        console.log(kategoriID);

        // Make AJAX request
        $.ajax({
            type: "POST", // You can use "GET" or "POST" depending on your server implementation
            url: "<?= base_url() ?>admin/admin/deletekategori/", // Replace with your server endpoint
            data: { id: kategoriID }, // Data to be sent to the server
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
        
    function searchItem() {
        var input = document.getElementById("searchInput").value.toUpperCase();
        var table = document.getElementById("tabelKategori");
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
        document.getElementById("currentPage").innerText = currentPag
        // Disable buttons after search
        document.getElementById("previousButton").disabled = true;
        document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
    }
    </script>
</body>
</html>
