    <title>Customer</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <div class="modal-content">
            <!-- Content for Edit Pop-up -->
            <h3>Edit Pelanggan</h3>
            <div id="editContent">
            <form id="formedit" method="post" action="<?php echo base_url('kasir/kasir/editcustomer')?>">
                
            <input name="id" type="hidden" id="editName" value="<?php echo $datacustomerbyid->PelangganID; ?>">

            <label for="editName">Nama :</label>
            <input name="namapelanggan" type="text" id="editName" value="<?php echo $datacustomerbyid->NamaPelanggan; ?>">

            <label for="editAddress">Alamat</label><br>
            <div class="address-container-customer">
            <label for="editAddress">Jalan :</label>
            <input name="jalan" type="text" id="editAddress" value="<?php echo $datacustomerbyid->AlamatJalan; ?>">
            
            <label for="customerAddres">Kelurahan : </label>
            <input type="text" id="customerAddres" name="kelurahan" required  value="<?php echo $datacustomerbyid->AlamatKelurahan; ?>">
                
            <label for="customerAddres">Kecamatan :</label>
            <input type="text" id="customerAddres" name="kecamatan" required  value="<?php echo $datacustomerbyid->AlamatKecamatan; ?>">

            <label for="customerAddres">Kabupaten / Kota :</label>
                <input type="text" id="customerAddres" name="kabupatenkota"  value="<?php echo $datacustomerbyid->AlamatKabupatenKota; ?>">
                
            <label for="customerAddres">Provinsi :</label>
            <input type="text" id="customerAddres" name="provinsi" required  value="<?php echo $datacustomerbyid->AlamatProvinsi; ?>">

            <label for="customerAddres">KodePos :</label>
            <input type="text" id="customerAddres" name="kodepos" required  value="<?php echo $datacustomerbyid->AlamatKodePos; ?>">
            </div>

            <label for="editTelephone">Telephone :</label>
            <input name="nomortelepon" type="text" id="editTelephone" value="<?php echo $datacustomerbyid->NomorTelepon; ?>">
            </div>
            <center>
            <button onclick="confirmEdit()" type="submit">Ubah</button>
            <button onclick="closeEditModal()">Batal</button>
            </center>
            </form>
        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url("assets/js/cust.js")?>"></script>