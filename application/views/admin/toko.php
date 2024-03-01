<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Toko</title>
    <!-- Ikon untuk favicon -->
    <link rel="icon" type="image/x-icon" sizes="196x196" href="<?php echo base_url("assets/img/favicon.ico")?>">
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
        <button class="edit-acc" onclick="openEditPopup(<?php echo $data_toko->TokoID; ?>)">
            <i class="ion-edit"></i> Edit
        </button>
        <p><strong>Name : </strong><?php echo $data_toko->NamaToko; ?></p>
        <p><strong>Deskripsi Toko : </strong><?php echo $data_toko->DeskripsiToko; ?></p>
        <p><strong>Address : </strong><?php echo $data_toko->AlamatJalan . ", " . $data_toko->AlamatKelurahan . ", " . $data_toko->AlamatKecamatan . ", " . $data_toko->AlamatKabupatenKota . ", " . $data_toko->AlamatProvinsi .", " . $data_toko->AlamatKodePos; ?></p>
        <p><strong>Telephone : </strong><?php echo $data_toko->NomorTelepon; ?></p>
    </div>

    <?php include('layout/footer.php') ?>

<div id="overlay" class="overlay"></div>
<div id="editPopup" class="popup">
</div>

<script>
    // Function to open the edit popup
    function openEditPopup(id) {
            $.ajax({
                type: 'POST', // or 'POST' depending on your needs
                url: '<?= base_url() ?>admin/admin/editmodalakuntoko/' +id, // Replace with the actual ID
                data: {
                    id: id,
                },
                success: function(response) {
                    $("#editPopup").html(response);
                    document.getElementById('editPopup').classList.add('show');
                    document.getElementById('overlay').classList.add('show');
                    //document.getElementById("editModal").style.display = "flex";
                    //$("#editModal").html(response).modal('show');
                    // $(response).modal("show");
                    // $('body').removeClass('modal-backdrop');
                    // $('.modal-backdrop').remove();
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                }
            });
    }
    // Function to confirm the Edit action
    function updateInformation() {
        // Add your logic here to handle the edit action
        $("#formeditakun").submit();
        closeEditModal();
    }

    // Function to close the edit popup
    function closeEditPopup() {
        document.getElementById('editPopup').classList.remove('show');
        document.getElementById('overlay').classList.remove('show');
    }
</script>
</body>
</html>