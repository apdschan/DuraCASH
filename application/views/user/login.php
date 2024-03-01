<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DuraPOS</title>
  <!-- Web page CSS -->
  <link rel="stylesheet" href= '<?php echo base_url("assets/css/login.css")?>' >
  <!-- Font Awesome library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>


<body>
  <form method ="post" action="<?php echo base_url("user/login/autentifikasi")?>" id="login-form">
        <div class="left">
            <div class="container">
                <img class="logo" src="<?php echo base_url("assets/img/logo.png")?>" alt="logo.png">
            </div>
        </div>
        <div class="right">
            <div class="connect">Selamat Datang Kembali</div>
            <div class="headings">
              <div class="heading">Log In ke Akun Anda</div>
            </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <div class="password-input-container">
                        <input type="password" name="password" id="password" />
                        <i class="toggle-password fa fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>

            <div class="input-group">
              <input type="checkbox" name="remember-me" id="remember-me" />
              <label for="remember-me">Remember Me</label>
            </div>

            <div class="submit">
                <button type="submit">Log In</button>
            </div>

            <div class="register">
              <p>Tidak Punya Akun? <a href='<?php echo base_url("user/register")?>'>Sign Up!</a></p>
            </div>
        </div>
    </form>
    <?php if ($this->session->flashdata('error')) { ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Kesalahan Saat Login...',
          text: '<?php echo $this->session->flashdata('error'); ?>',
          confirmButtonColor: '#d33', // Set button color to red
          confirmButtonText: 'OK' // Customize the confirmation button text
        });
        </script>
    <?php } ?>
  </body>
<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.querySelector("i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}
</script>
</html>