    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <div class="modal-content">
            <!-- Content for Edit Pop-up -->
            <h3>Edit Kategori</h3>
            <div id="editContent">
            <form id="formedit" method="post" action="<?php echo base_url('kasir/kasir/editkategori')?>">
                
            <input name="id" type="hidden" id="editName" value="<?php echo $data_kategori->KategoriID; ?>">

            <label for="editName">Nama :</label>
            <input name="nama" type="text" id="editName" value="<?php echo $data_kategori->NamaKategori; ?>">

            <label for="editDescriptiom">Deskripsi :</label>
            <input name="deskripsi" type="text" id="editDescription" value="<?php echo $data_kategori->DeskripsiKategori; ?>">

            </div>
            <div class="button-container">
                <button onclick="confirmEdit()" type="submit">Ubah</button>
                <button onclick="closeEditModal()">Batal</button>
            </div>
            </form>
        </div>