<div class="modaltransaksi-content1">
    <h3>Edit Barang</h3>
    <!-- Replace with your actual form fields -->
    <div class="inputModal">
        <?php $produk = $this->Kasir_Model->produkbyid($datakeranjang->ProdukID) ?>
        
        <label for="editName">Nama:</label>
        <input type="text" id="editName" value="<?php echo $produk->NamaProduk;?>" readonly>

        <label for="editQty">Qty:</label>
        <input type="text" id="editQty" value="<?php echo $datakeranjang->JumlahProduk;?>" oninput="updateTotal()">
        <input type="hidden" id="editQtyOld" value="<?php echo $datakeranjang->JumlahProduk;?>" oninput="updateTotal()">

        <label for="editSell">Harga Jual:</label>
        
        <?php
        $tanggalSekarang = date("Y-m-d");
        // Logika untuk menentukan apakah diskon berlaku atau tidak
        if ($tanggalSekarang >= $produk->TanggalAktifDiskon && $tanggalSekarang <= $produk->TanggalExpiredDiskon) {
            // Diskon berlaku
            $hargaSetelahDiskon = $produk->HargaJual - ($produk->HargaJual * ($produk->Diskon / 100));
            echo "<input type=\"text\" id=\"editSell\" oninput=\"updateTotal()\" required value=\"$hargaSetelahDiskon\" readonly>";
        } else {
            // Tidak ada diskon
            echo "<input type=\"text\" id=\"editSell\" oninput=\"updateTotal()\" required value=\"" . $produk->HargaJual . "\" readonly>";
        }
        ?>

        <label for="editTotal">Total:</label>
        <input type="text" id="editTotal" readonly>
    </div>
    <div class="button-container">
        <button onclick="saveChanges()">Ubah</button>
        <button onclick="closeEditModal()">Close</button>
    </div>
</div>

<script>
    // Fungsi untuk mengupdate total harga
    function updateTotal() {
        var qty = parseInt(document.getElementById('editQty').value) || 0;
        var hargaJual = parseFloat(document.getElementById('editSell').value) || 0;

        // Hitung total harga
        var total = qty * hargaJual;

        // Tampilkan total harga pada input 'editTotal'
        document.getElementById('editTotal').value = total.toFixed(2); // Menggunakan toFixed untuk membatasi desimal menjadi dua digit
    }

    // Fungsi lainnya sesuai kebutuhan
    function saveChanges() {
        // Implementasi logika untuk menyimpan perubahan
        var detailID = <?php echo $datakeranjang->DetailID; ?>;
        var produkID = <?php echo $datakeranjang->ProdukID; ?>;
        var jumlahProdukBaru = document.getElementById('editQty').value;
        var jumlahProdukLama = document.getElementById('editQtyOld').value;
        var totalHarga = document.getElementById('editTotal').value;
        console.log(produkID);
        
        console.log("InputValue:", detailID);
        console.log("jumlah:", jumlahProdukBaru);
        console.log("total:", totalHarga);

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>kasir/kasir/updatekeranjang',
            data: {
                detailID: detailID,
                produkID: produkID,
                jumlahProdukLama: jumlahProdukLama,
                jumlahProdukBaru: jumlahProdukBaru,
                totalHarga: totalHarga
            },
            dataType: 'json',
            success: function(response) {
                // Handle respons sukses sesuai kebutuhan
                console.log("Perubahan berhasil disimpan");
            },
            error: function(xhr, status, error) {
                // Handle error jika terjadi
                console.error("Gagal menyimpan perubahan:", error);
            }
        });
        updateAddedItemsList();
        updateAddedItemsListTransaksi();
        closeEditModal();
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
        updateAddedItemsList();
    }
</script>