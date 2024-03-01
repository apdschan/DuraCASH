
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Add your editing form or content here -->
    <h2>Edit Informasi Akun</h2>
    <!-- Example input field (replace with your form elements) -->
    <form id="formeditakun" method="post" action="<?php echo base_url('kasir/kasir/editakun')?>">

    <input name="id" type="hidden" value="<?php echo $data_kasir->UserID; ?>">

    <input name="nama" type="text" value="<?php echo $data_kasir->NamaUser; ?>">

    <input name="email" type="email" value="<?php echo $data_kasir->Email; ?>">

    <input name="jalan" type="text" value="<?php echo $data_kasir->AlamatJalan; ?>">

    <input name="kelurahan" type="text" value= "<?php echo $data_kasir->AlamatKelurahan; ?>">

    <input name="kecamatan" type="text" value= "<?php echo $data_kasir->AlamatKecamatan; ?>">

    <input name="kabupatenkota" type="text" value= "<?php echo $data_kasir->AlamatKabupatenKota; ?>">

    <input name="provinsi" type="text" value= "<?php echo $data_kasir->AlamatProvinsi; ?>">

    <input name="kodepos" type="text" value= "<?php echo $data_kasir->AlamatKodePos; ?>">

    <input name="telp" type="text" value="<?php echo $data_kasir->NomorTelepon; ?>">

    <button type="submit" onclick="updateInformation()">Update</button>
    <button type="button" onclick="closeEditPopup()">Close</button>
    </form>