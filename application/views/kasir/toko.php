<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Toko</title>
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/StyleAll.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styleAll.css")?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
    <?php include('layout/sidebar.php') ?>
    <p>
    <div class="avatartoko">
        <!-- Replace the src attribute with the path to your avatar image -->
        <img src="<?php echo base_url("assets/img/store.png")?>" alt="Avatar" style="width: 100%; height:100%;">
    </div>

    <div class="info-container">
        <p><center><strong>Profil Toko</strong></center><br>
        <p><strong>Name : </strong><?php echo $data_toko->NamaToko; ?></p>
        <p><strong>Deskripsi Toko : </strong><?php echo $data_toko->DeskripsiToko; ?></p>
        <p><strong>Alamat : </strong><?php echo $data_toko->AlamatJalan . ", " . $data_toko->AlamatKelurahan . ", " . $data_toko->AlamatKecamatan . ", " . $data_toko->AlamatKabupatenKota . ", " . $data_toko->AlamatProvinsi .", " . $data_toko->AlamatKodePos; ?></p>
        <p><strong>Telepon : </strong><?php echo $data_toko->NomorTelepon; ?></p>
    </div>

    <?php include('layout/footer.php') ?>

<div id="overlay" class="overlay"></div>
<div id="editPopup" class="popup">
</div>
</body>
</html>