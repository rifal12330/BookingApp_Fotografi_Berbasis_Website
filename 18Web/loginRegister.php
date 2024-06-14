<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELAPANBELAS project</title>
    
    <!-- icon -->
    <link rel="icon" type="image/png" href="img\logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Custom styles -->
    <link rel="stylesheet" href="loginRegister.css">
</head>

<body>
<br>
<br>

<!-- Navbar start -->
<nav class="navbar">
    <a href="index.php" class="navbar-logo"> 
        <img src="img/logo.png" alt="">
    </a>

    <div class="navbar-nav">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">Tentang kami</a>
        <a href="index.php#portofolio">Portofolio</a>
        <a href="index.php#ulasan">Ulasan</a>
    </div>

    <div class="navbar-extra">
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>
<!-- Navbar End -->

<!-- login -->
<div class="cont" >
    <div class="form sign-in" >
        <h2>Selamat Datang </h2>
        <form action="loginProcess.php" method="POST">
            <label>
                <span>Email</span>
                <input type="email" name="email">
            </label>
            <label>
                <span>Password</span>
                <input type="password" id="passwordInput" name="password">
                <span class="show-password" onclick="togglePasswordVisibility()">Show</span> 
            </label>
            <button type="submit" class="submit" name="login">Sign In</button>
        </form>
    </div>

    <!-- register -->
    <div class="sub-cont">
        <div class="img" >
            <div class="img__text m--up">
                <h3>Belum memiliki akun? ayo daftar!<h3>
            </div>
            <div class="img__text m--in">
                <h3>Jika Anda sudah memiliki akun, cukup masuk.<h3>
            </div>
            <div class="img__btn">
                <span class="m--up">Daftar</span>
                <span class="m--in">Masuk</span>
            </div>
        </div>
        <div class="form sign-up">
            <h2>Buat Akun Anda !</h2>
            <form action="registerProcess.php" method="POST">
                <label>
                    <span>full name</span>
                    <input type="text" name="nama">
                </label>
                <label>
                    <span>Phone number</span>
                    <input type="text" name="no_hp">
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email">
                </label>
                <label>
                    <span>Password</span>
                    <input type="text" name="password">
                </label>
                <button type="submit" class="submit" name="register">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //hide password
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("passwordInput");
        var showPassword = document.querySelector('.show-password');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPassword.innerText = "Hide";
        } else {
            passwordInput.type = "password";
            showPassword.innerText = "Show";
        }
    }

    //efek transisi login
    document.querySelector('.img__btn').addEventListener('click', function() {
        document.querySelector('.cont').classList.toggle('s--signup');
    });
</script>

</body>
</html>
