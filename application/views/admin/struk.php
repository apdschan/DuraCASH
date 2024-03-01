<style>
    .containerstruk {
        width: 360px;
        margin: 0 auto;
        text-align: center;
        border: 1px solid #000;
        padding: 10px;
    }
    .header {
        font-weight: bold;
        font-size: 20px;
    }
    .transaction-details {
        text-align: left;
        margin-top: 10px;
    }
    .product-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    .product-name {
        flex: 1;
        text-align: left;
    }
    .product-count {
        flex: 1;
        text-align: right;
    }
    .product-price {
        flex: 1;
        text-align: right;
    }
    .total {
        font-weight: bold;
        margin-top: 10px;
    }
    .nama {
        margin-top: 10px;
    }
    .button-container {
        margin-top: 20px;
    }
    .print-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    .back-btn {
        padding: 10px 20px;
        background-color: #dc3545;
        color: #fff;
        border: none;
        cursor: pointer;
        margin-left: 10px;
    }
    hr {
        border-top: 1px dashed;
    }
    /* Hide buttons when printing */
    @media print {
        .print-btn, .back-btn {
            display: none;
        }
    }
</style>

<?php 
$detail = $this->Admin_Model->getDataByTransactionID($data_laporan->PenjualanID);
$pelanggan = $this->Admin_Model->customerbyid($data_laporan->PelangganID);
?>
<div class="modal-content"><br>
<div class="containerstruk">
    <div class="header">Struk Pembelian</div><br>
    <div class="transaction-details">
        <div>ID Transaksi: <?php echo 'POS-' . $data_laporan->PenjualanID; ?></div>
        <?php 
            // Tanggal dalam format Inggris
            $tanggalInggris = $data_laporan->TanggalPenjualan;

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

            echo "<div>Tanggal Transaksi: $tanggalIndonesia</div>";
            ?>
        <div>Nama Pembeli: <?php echo $pelanggan->NamaPelanggan?></div><br>
        <div>Detail</div>
<hr>
        <div class="products">
            <?php foreach ($detail as $produk) : ?>
            <?php 
            $nama = $this->Admin_Model->produkbyid($produk->ProdukID);
            ?>
                <div class="product-row">
                    <div class="product-name"><?php echo $nama->NamaProduk;?></div>
                    
                    <?php
                        $tanggalSekarang = date("Y-m-d");
                        if ($nama->Diskon !== null && $nama->Diskon != 0 && $tanggalSekarang >= $nama->TanggalAktifDiskon && $tanggalSekarang <= $nama->TanggalExpiredDiskon) {
                            echo ' <div class="product-count">' . $produk->JumlahProduk . 'X' . number_format($nama->HargaJual, 2, ',', '.') . '|' . $nama->Diskon . '%</div>';
                        }else{
                            echo '<div class="product-count">' . $produk->JumlahProduk . 'X' . number_format($nama->HargaJual, 2, ',', '.') . '</div>';
                        }
                    ?>

                    <div class="product-price"><?php echo 'Rp ' . number_format($produk->Subtotal, 2, ',', '.'); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        
<hr>
        <div class="total">Total: <?php echo 'Rp ' . number_format($data_laporan->TotalHarga, 2, ',', '.'); ?></div><br>
        
<hr>
        <div class="nama">Petugas Kasir: <?php echo $data_laporan->NamaKasir?></div><br>
        Terima Kasih Telah Berbelanja di '<?php echo $data_toko->NamaToko?>' Jangan Lupa Datang Kembali.
    </div>
    <div class="button-container">
        <button class="back-btn" onclick="closeStrukModal()"><i class="ion-android-arrow-back ion-2x"></i> Kembali</button>
        <button class="print-btn" onclick="printReport()"><i class="ion-android-print ion-2x"></i> Print</button>
    </div>
</div>
</div>
<script>
    function printReport() {
        window.print();
    }
</script>