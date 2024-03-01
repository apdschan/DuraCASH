
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Add your editing form or content here -->
    <h2>Edit Informasi Akun</h2>
    <!-- Example input field (replace with your form elements) -->
    <form id="formeditakun" method="post" action="<?php echo base_url('admin/admin/editakun')?>">

    <input name="id" type="hidden" value="<?php echo $data_admin->UserID; ?>">

    <input name="nama" type="text" value="<?php echo $data_admin->NamaUser; ?>">

    <input name="email" type="email" value="<?php echo $data_admin->Email; ?>">

    <input name="jalan" type="text" value="<?php echo $data_admin->AlamatJalan; ?>">

    <input name="kelurahan" type="text" value= "<?php echo $data_admin->AlamatKelurahan; ?>">

    <input name="kecamatan" type="text" value= "<?php echo $data_admin->AlamatKecamatan; ?>">

    <input name="kabupatenkota" type="text" value= "<?php echo $data_admin->AlamatKabupatenKota; ?>">

    <input name="provinsi" type="text" value= "<?php echo $data_admin->AlamatProvinsi; ?>">

    <input name="kodepos" type="text" value= "<?php echo $data_admin->AlamatKodePos; ?>">

    <input name="telp" type="text" value="<?php echo $data_admin->NomorTelepon; ?>">

    <button type="submit" onclick="updateInformation()">Update</button>
    <button type="button" onclick="closeEditPopup()">Close</button>
    </form>