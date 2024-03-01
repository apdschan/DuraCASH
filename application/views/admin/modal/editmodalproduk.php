<title>Customer</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <div class="modal-content">
            <!-- Content for Edit Pop-up -->
            <h3>Edit Produk</h3>
            <div id="editContent">
            <form id="formedit" method="post" action="<?php echo base_url('admin/admin/editproduk')?>">
                
            <input name="id" type="hidden" id="editName" value="<?php echo $dataprodukbyid->ProdukID; ?>">

            <label for="editName">Nama:</label>
            <input name="namaproduk" type="text" id="editName" value="<?php echo $dataprodukbyid->NamaProduk; ?>">

            <label for="itemCategory">Kategori Barang:</label>
            <?php $kategoribyid = $this->Admin_Model->kategoribyidkategori($dataprodukbyid->KategoriID)?>
                <select type="Stok" id="itemCategory" name="kategori" required>
                    <option value="<?php echo $dataprodukbyid->KategoriID; ?>" selected><?php echo $kategoribyid->NamaKategori?></option>
                <?php foreach ($list_kategori as $data) : ?>
                    <option value="<?php echo $data->KategoriID; ?>"><?php echo $data->NamaKategori; ?></option>
                <?php endforeach;?>
                </select><br>

            <label for="stoksekarang">Stok Sekarang:</label>
            <input name="stok" type="text" id="stoksekarang" value="<?php echo $dataprodukbyid->Stok; ?>" readonly>
            
            <label for="stoktambahan">Stok Tambahan:</label>
            <input name="stoktambahan" type="text" id="stoktambahan"">

            <label for="hargabeli">Harga Beli:</label>
            <input name="hargabeli" type="text" id="beli" value="<?php echo $dataprodukbyid->HargaBeli; ?>">
            
            <label for="hargajual">Harga Jual:</label>
            <input name="hargajual" type="text" id="jual" value="<?php echo $dataprodukbyid->HargaJual; ?>">

            <label for="Discount">Diskon:</label>
            <input type="text" id="Discount" name="diskon" value="<?php echo $dataprodukbyid->Diskon; ?>">

            <label for="Active">Tanggal Aktif Diskon:</label>
            <input type="date" id="Active" name="tglaktif" value="<?php echo $dataprodukbyid->TanggalAktifDiskon; ?>">

            <label for="Expired">Tanggal Expired Diskon:</label>
            <input type="date" id="Expired" name="tglexprd" value="<?php echo $dataprodukbyid->TanggalExpiredDiskon; ?>">
            </div>
            <center>
            <button onclick="confirmEdit()" type="submit">Ubah</button>
            <button onclick="closeEditModal()">Batal</button>
            </center>
            </form>
        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url("assets/js/item.js")?></script>