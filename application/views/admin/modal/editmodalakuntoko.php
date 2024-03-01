
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Add your editing form or content here -->
    <h2>Edit Informasi Toko</h2>
    <!-- Example input field (replace with your form elements) -->
    <form id="formeditakun" method="post" action="<?php echo base_url('admin/admin/editakuntoko')?>">

    <input name="id" type="hidden" value="<?php echo $data_toko->TokoID; ?>">

    <input name="nama" type="text" value="<?php echo $data_toko->NamaToko; ?>">

    <input name="deskripsi" type="text" value="<?php echo $data_toko->DeskripsiToko; ?>">

    <input name="jalan" type="text" value="<?php echo $data_toko->AlamatJalan; ?>">

    <input name="kelurahan" type="text" value= "<?php echo $data_toko->AlamatKelurahan; ?>">

    <input name="kecamatan" type="text" value= "<?php echo $data_toko->AlamatKecamatan; ?>">

    <input name="kabupatenkota" type="text" value= "<?php echo $data_toko->AlamatKabupatenKota; ?>">

    <input name="provinsi" type="text" value= "<?php echo $data_toko->AlamatProvinsi; ?>">

    <input name="kodepos" type="text" value= "<?php echo $data_toko->AlamatKodePos; ?>">

    <input name="telp" type="text" value="<?php echo $data_toko->NomorTelepon; ?>">

    <button type="submit" onclick="updateInformation()">Update</button>
    <button type="button" onclick="closeEditPopup()">Close</button>
    </form>