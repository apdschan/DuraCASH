<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/StyleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <?php include('layout/sidebar.php'); ?>

    <!-- Page Content -->
    <div class="container mt-5">
        <h2>List Toko
            <div class="search-box">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button onclick="searchStore()">
                        <i class="ion-search ion-2x"></i>
                    </button>
                </div>
            </div>
        </h2>

        <div>
            <button class="add-btn" onclick="openAddModal()"><i class="ion-plus ion-2x"></i>Tambah Toko</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Alamat</th>
                    <th>Telephone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_toko as $data) : ?>
                <tr>
                    <td><?php echo $data->NamaToko;?></td>
                    <td><?php echo $data->DeskripsiToko;?></td>
                    <td><?php echo $data->AlamatJalan . ", " . $data->AlamatKelurahan . ", " . $data->AlamatKecamatan . ",<br>" . $data->AlamatKabupatenKota . ", " . $data->AlamatProvinsi .", " . $data->AlamatKodePos; ?></td>
                    <td></td>
                    <td class="action-buttons">
                        <a href="#" class="btn-view" onclick="openViewModal(this)">
                            <i class="ion-eye"></i>
                        </a>
                        <a href="#" class="btn-edit" onclick="openEditModal(this)">
                            <i class="ion-edit"></i>
                        </a>
                        <a href="#" class="btn-delete" onclick="openDeleteModal()">
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
            <h3>Tambah Toko</h3>
            <div id="addContent">
                <!-- Add your form fields for adding a customer here -->
                <!-- Example: -->
                <label for="storeName">Nama:</label>
                <input type="text" id="storeName" name="storeName" required>
    
                <label for="storeAddress">ALamat:</label>
                <input type="Address" id="storeAddress" name="storeAddress" required>
    
                <label for="storeDescription">Deskripsi:</label>
                <input type="text" id="storeDescription" name="storeDescription" required>

                <label for="storeTelephone">Telephone:</label>
                <input type="text" id="storeTelephone" name="storeTelephone" required>
            </div>
            <div class="button-container">
                <button onclick="confirmAdd()">Tambah</button>
                <button onclick="closeAddModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Add this HTML structure inside your existing document, preferably near the end of the body -->
    <div class="modal-container" id="viewModal">
        <div class="modal-content">
            <!-- Content for View Pop-up -->
            <h3>Toko</h3>
            <div id="viewContent">
                <!-- Content will be dynamically populated here -->
            </div>
            <button class="close-btn" onclick="closeViewModal()">Close</button>
        </div>
    </div>

    <div class="modal-container" id="editModal">
        <div class="modal-content">
            <!-- Content for Edit Pop-up -->
            <h3>Edit Toko</h3>
            <div id="editContent">
                <!-- Content will be dynamically populated here -->
            </div>
            <div class="button-container">
                <button onclick="confirmEdit()">Ubah</button>
                <button onclick="closeEditModal()">Batal</button>
            </div>
        </div>
    </div>

<div class="modal-container" id="deleteModal">
    <div class="modal-content">
        <!-- Content for Delete Confirmation Pop-up -->
        <!-- You can customize this section based on your needs -->
        <h3>Hapus Toko</h3>
        <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
        <div class="button-container">
            <button onclick="confirmDelete()">Ya</button>
            <button onclick="closeDeleteModal()">Tidak</button>
        </div>
    </div>
</div>

<?php include('layout/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/store.js"></script>
</body>

</html>