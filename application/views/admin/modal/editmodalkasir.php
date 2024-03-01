<title>Customer</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <div class="modal-content">
            <!-- Content for Edit Pop-up -->
            <h3>Edit Kasir</h3>
            <div id="editContent">
            <form id="formeditkasir" method="post" action="<?php echo base_url('admin/admin/editkasir')?>">
                
            <input name="id" type="hidden" id="editName" value="<?php echo $datakasirbyid->UserID; ?>">

            <label for="editName">Nama :</label>
            <input name="namakasir" type="text" id="editName" value="<?php echo $datakasirbyid->NamaUser; ?>">

            <label for="editAddress">Alamat</label><br>
            <div class="address-container-customer">
            <label for="editAddress">Jalan :</label>
            <input name="jalan" type="text" id="editAddress" value="<?php echo $datakasirbyid->AlamatJalan; ?>">
            
            <label for="customerAddres">Kelurahan : </label>
            <input type="text" id="customerAddres" name="kelurahan" required  value="<?php echo $datakasirbyid->AlamatKelurahan; ?>">
                
            <label for="customerAddres">Kecamatan :</label>
            <input type="text" id="customerAddres" name="kecamatan" required  value="<?php echo $datakasirbyid->AlamatKecamatan; ?>">

            <label for="customerAddres">Kabupaten / Kota :</label>
                <input type="text" id="customerAddres" name="kabupatenkota"  value="<?php echo $datakasirbyid->AlamatKabupatenKota; ?>">
                
            <label for="customerAddres">Provinsi :</label>
            <input type="text" id="customerAddres" name="provinsi" required  value="<?php echo $datakasirbyid->AlamatProvinsi; ?>">

            <label for="customerAddres">KodePos :</label>
            <input type="text" id="customerAddres" name="kodepos" required  value="<?php echo $datakasirbyid->AlamatKodePos; ?>">
            </div>

            <label for="editTelephone">Telephone :</label>
            <input name="nomortelepon" type="text" id="editTelephone" value="<?php echo $datakasirbyid->NomorTelepon; ?>">
            </div>
            <center>
            <button onclick="confirmEditKasir()" type="submit">Ubah</button>
            <button onclick="closeEditModalKasir()">Batal</button>
            </center>
            </form>
        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url("assets/js/cust.js")?>"></script>