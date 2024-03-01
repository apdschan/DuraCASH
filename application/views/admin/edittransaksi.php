<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Transaksi</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/transaksiedit.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<SB-Mid-client-ju9ubVsAPAJjFlAn>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>
</head>

<body>
    <?php include('layout/sidebaredit.php'); ?>
    <!-- Page Content -->
    <div class="container">
        <h2> Edit Transaksi </h2>

        <div class="row">
            <div class="col-1">
                <label for="transactionNumber">Transaction Number :</label>
            </div>
            <div class="col-2">
                <input type="text" id="transactionNumber" name="transactionNumber" value="<?php echo $data_laporan->PenjualanID?>" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-1">
                <label for="transactionDate">Transaction Date :</label>
            </div>
            <div class="col-2">
                <input type="date" id="transactionDate" name="transactionDate" value="<?php echo $data_laporan->TanggalPenjualan?>" required>
            </div>
        </div>
            
        <?php 
        $pelanggan = $this->Admin_Model->customerbyid($data_laporan->PelangganID);
        ?>
        <div class="row">
            <div class="col-1">
                <label for="customer">Customer :</label>
            </div>
            <div class="col-2">
                <div class="add-customer-input">
                    <input type="text" id="pelanggan" name="customer" value="<?php echo $pelanggan->NamaPelanggan?>" required>
                    <button class="add-btnCust" onclick="openCustModal()"><i class="ion-plus ion-2x"></i></button>
                </div>
                <div id="customerErrorMessage" style="color: red; display: none;">Harap isi nama pelanggan terlebih dahulu!</div>
            </div>
        </div>
        
        <div>
        <button class="add-btnItem" onclick="checkAndOpenAddModal()"><i class="ion-plus ion-2x"></i>Tambah Produk</button>
        </div>
            <table id="transactionData" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $data) : ?>
                <tr>
                <?php
                    $detail = $this->Admin_Model->getdetaillaporanbyid($data->PenjualanID);
                    $produk = $this->Admin_Model->produkbyid($data->ProdukID);
                ?>
                <td><?php echo $produk->NamaProduk;?></td>
                <td><?php echo $data->JumlahProduk;?></td>
                <td id="subtotal_<?php echo $produk->ProdukID; ?>">
                    <?php 
                        $subtotal = $data->Subtotal; 
                        // Menggunakan number_format() dengan 2 digit di belakang koma
                        echo 'Rp ' . number_format($subtotal, 2, ',', '.') . (strpos($subtotal, '.') === false ? ',00' : '');
                    ?>
                </td>
                <td class="action-buttons">
                    <a href="javascript:void(0)" class="btn-edit" onclick="openEditModal(<?php $id=$data->ProdukID;echo $id;?>)">
                        <i class="ion-edit"></i>
                    </a>
                    <a href="#" class="btn-delete" onclick="openDeleteModal(<?php echo $data->ProdukID; ?>)">
                        <i class="ion-android-delete"></i>
                    </a>
                </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
        <div class="grand-total">
            <!--<strong>Grand Total:</strong>-->
        </div>

        <div class="button-containeredit">
            <button class="pay-btn" onclick="window.history.back()"><i class="ion-android-cancel ion-2x"></i> Batal</button>
            <button class="pay-btn" id="pay-button"><i class="ion-android-checkmark-circle ion-2x"></i>Bayar</button>
        </div>
    </div>

    <div id="customerModal" class="modaltransaksi">
        <div class="modaltransaksi-content">
            <span class="close" onclick="closeCustModal()">&times;</span>
            <div id="modalContent">
                <h3> Pilih Pelanggan</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_pelanggan as $pelanggan) : ?>
                            <tr>
                                <td><?php echo $pelanggan->NamaPelanggan?></td>
                                <td><?php echo $pelanggan->AlamatJalan . ", " . $pelanggan->AlamatKelurahan . ", " . $pelanggan->AlamatKecamatan . ",<br>" . $pelanggan->AlamatKabupatenKota . ", " . $pelanggan->AlamatProvinsi .", " . $pelanggan->AlamatKodePos; ?></td>
                                <td><?php echo $pelanggan->NomorTelepon?></td>
                                <td class="action-buttons">
                                    <button class="add-btnCust" onclick="addcustomer('<?php echo $pelanggan->NamaPelanggan?>','<?php echo $pelanggan->PelangganID?>')">
                                        <i class="ion-plus ion-2x"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php $datacustomer = $this->Kasir_Model->customerbyid($pelanggan->PelangganID); ?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="addItems" class="modaltransaksi">
        <div class="modaltransaksi-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <div id="modalContent">
                <h3>Tambah Barang</h3>
                <table class="table" id="tabelProduk">
                    <div class="searchbox">
                <input type="text" id="searchInput" placeholder="Search..." required>
                <button onclick="searchItem()">
                    <i class="ion-search ion-2x"></i>
                </button>
                </div>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Diskon</th>
                            <th>Harga Jual</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="id" name="id" required>
                        <?php foreach ($list_produk as $produk) : ?>
                        <?php $kategoribyid = $this->Kasir_Model->kategoribyidkategori($produk->KategoriID);?>
                            <tr>
                                <td><?php echo $produk->NamaProduk?></td>
                                <td><?php echo $kategoribyid->NamaKategori; ?></td>
                                <td><?php echo $produk->Stok?></td>
                                <td>
                                <?php
                                $tanggalSekarang = date("Y-m-d");
                                if ($produk->Diskon !== null && $produk->Diskon != 0 && $tanggalSekarang >= $produk->TanggalAktifDiskon && $tanggalSekarang <= $produk->TanggalExpiredDiskon) {
                                    echo $produk->Diskon . "%";
                                }else{
                                    echo "-";
                                }
                                ?>
                                </td>
                                
                        <?php
                        $tanggalSekarang = date("Y-m-d");
                        // Logika untuk menentukan apakah diskon berlaku atau tidak
                        if ($tanggalSekarang >= $produk->TanggalAktifDiskon && $tanggalSekarang <= $produk->TanggalExpiredDiskon) {
                            // Diskon berlaku
                            $hargaSetelahDiskon = $produk->HargaJual - ($produk->HargaJual * ($produk->Diskon / 100));
                            echo "<td>Rp. " . number_format($hargaSetelahDiskon, 2) . "</td>";
                        } else {
                            // Tidak ada diskon
                            echo "<td>Rp. " . number_format($produk->HargaJual, 2) . "</td>";
                        }
                        ?>
                                <td class="action-buttons">
                                    <button class="add-btnCust" onclick="AddItemsAct('<?php echo $produk->ProdukID ?>',document.getElementById('id').value,document.getElementById('transactionNumber').value)">
                                        <i class="ion-plus ion-2x"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div id="pagination">
                    <button onclick="previousPage()">Previous</button>
                    <span id="currentPage">1</span>
                    <button onclick="nextPage()">Next</button>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modaltransaksi">
    </div>



    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="modaltransaksi">
        <div class="modaltransaksi-content1">
            <h3>Hapus Barang</h3>
            <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
            <div class="button-container">
                <button onclick="deleteItem()">Ya</button>
                <button onclick="closeDeleteModal()">Tidak</button>
            </div>
        </div>
    </div>
   
    <?php //include('layout/footer.php') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo base_url("assets/js/transaksi.js")?>"></script>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<SB-Mid-client-ju9ubVsAPAJjFlAn>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript">
        
    // Function to open the delete confirmation pop-up
    function openDeleteModal(keranjangID) {

    $("#deleteConfirmModal").attr("data-keranjang-id", keranjangID);

    // Show the modal
    document.getElementById("deleteConfirmModal").style.display = "flex";
    }

    
    // Function to confirm the delete action
    function deleteItem() {
        
        var keranjangID = $("#deleteConfirmModal").attr("data-keranjang-id");
        console.log(keranjangID);

        // Make AJAX request
        $.ajax({
            type: "POST", // You can use "GET" or "POST" depending on your server implementation
            url: "<?= base_url() ?>kasir/kasir/deleteKeranjang/", // Replace with your server endpoint
            data: { id: keranjangID }, // Data to be sent to the server
            success: function(response) {
                // Handle success response
                console.log("keranjang berhasil dihapus");
                // You can update the UI or perform additional actions as needed

                // Close the modal after successful deletion
                closeDeleteModal();
                    
                // Reload the table
                updateAddedItemsList();
            },
            error: function(error) {
                // Handle error response
                console.error("Error deleting keranjang", error);
                // You can provide user feedback or perform additional actions as needed
            }
        });
    }
</script>
<script type="text/javascript">
  
    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");
    
    $.ajax({
      url: '<?=base_url()?>kasir/snap/token',
      cache: false,

      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });

</script>
</body>

</html>