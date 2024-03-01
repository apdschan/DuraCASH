<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuraPOS</title>
    <!-- Web page CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/register.css")?>" >
    <!-- Font Awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <form  method ="post" action="<?php echo base_url("user/login/register_user_baru")?>" id="login-form">
        <div class="left">
            <div class="container">
                <img style="max-width: 80%; height: auto; display: block; margin: auto;" src="<?php echo base_url("assets/img/logo.png")?>" alt="">
            </div>
        </div>
        <div class="right">
            <div class="heading">Sign Up</div>
            <div class="connect">Masukkan detail anda untuk membuat akun</div>

            <div class="input-group">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="username" id="name" />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                </div>
            </div>

            <div class="input-group">
                <div>
                    <label for="password">Password</label>
                    <div class="password-input-container">
                        <input type="password" name="password" id="password" />
                        <i class="toggle-password fa fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>
                <div>
                    <label for="password">Confirm Password</label>
                    <div class="password-input-container">
                        <input type="password" name="password" id="password" />
                        <i class="toggle-password fa fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>
            </div>

            <div>
                <label for="phone">Telepon</label>
                <input type="number" name="phone" id="phone" />
            </div>

            <div class="submit">
                <button type="submit">Sign Up</button>
            </div>

            <div class="login">
              <p>Sudah Punya Akun? <a href="<?php echo base_url("user/login")?>">Log In!</a></p>
            </div>
        </div>
    </form>
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