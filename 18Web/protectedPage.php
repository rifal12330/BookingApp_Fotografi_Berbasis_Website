<?php 
session_start();
include 'koneksi.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: loginRegister.php");
    exit();
}

// Ambil data pengguna dan gambar dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT user.nama_lengkap, images.file_name FROM user LEFT JOIN images ON user.user_id = images.user_id WHERE user.user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $file_name = $user['file_name'] ? 'uploads/' . $user['file_name'] : 'img/default_profile.png';
    $nama_lengkap = $user['nama_lengkap'];
} else {
    // Jika tidak ditemukan, gunakan gambar default atau lakukan penanganan kesalahan
    $file_name = 'img/default_profile.png';
    $nama_lengkap = 'Guest';
}

$stmt->close();
?>

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
    <link rel="stylesheet" href="Style.css">
</head>

<body>
<!-- Navbar start -->
<nav class="navbar">
    <a href="#" class="navbar-logo"> 
        <img src="img/logo.png" alt="">
    </a>

    <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang kami</a>
        <a href="#portofolio">Portofolio</a>
        <a href="#ulasan">Ulasan</a>
    </div>

    <div class="navbar-extra">
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        <a href="userProfile.php" id="profile">
            <img src="<?php echo htmlspecialchars($file_name); ?>" alt="Profile Picture" class="profile-icon">
        </a>
        <a href="logout.php" onclick="confirmLogout(event)" id="log-out"><i data-feather="log-out"></i></a>
    </div>


</nav>
<!-- Navbar End -->

<!-- Hero section start-->
<section class="hero" id="home">
    <main class="content">
        <h1>Welcome </h1>
        <h1><span><?php echo htmlspecialchars($nama_lengkap); ?></span></h1>
        <p>Ayo Booking Sekarang!</p>
        <a href="bookingForm.php" class="cta">Booking Now</a>
    </main>
</section>
<!-- Hero section end-->

<!-- about section start -->
<section id="about" class="about">
    <h2><span>Tentang</span> Kami</h2>
    <div class="row">
        <div class="about-img">
            <img src="img/Gambar2.jpg" alt="Tentang Kami">
        </div>
        <div class="content">
            <h3>Kenapa memilih jasa kita?</h3>
            <p>Kami merupakan sebuah Vendor / Tim yang bergerak di bidang fotografi dan Videografi. 
                kami bertempat di Cikampek, Kab. Karawang, Jawa Barat. sejak 2020, kami masih setia 
                untuk memberikan layanan yang terbaik kepada Client. DelapanBelas Project percaya, bahwa
                tidak semua orang dapat merasakan sensasi kamera Foto profesional. maka dari itu, kami 
                DelapanBelas Project ada disini. kami menyediakan jasa fotografi dan Videografi profesional yang
                akan menghasilkan gambar yang tajam, rapih, dan tentunya mengikuti trend masakini. ditopang oleh
                keahlian fotografer dan Videografer kami yang andal dan berpengalaman
            </p>
        </div>
    </div>
</section>
<!-- about section end -->

<!-- portofolio section start-->
<section id="portofolio" class="portofolio">
    <h2><span>Portofolio</span> Kami</h2>
    <p>Lorem ipsum dolor sit amet.</p>
    <div class="row">
        <div class="list-card">
            <img src="img/Gambar3.jpg" alt="wedding" class="list-card-img">
            <a href="weddingPage.php" class="cta-wedding">-Wedding photo & Video-</a>
        </div>
        <div class="list-card">
            <img src="img/Gambar5.jpg" alt="CP" class="list-card-img">
            <a href="companyProfile.php" class="cta-CP">-Company Profile-</a>
        </div>
        <div class="list-card">
            <img src="img/Gambar4.jpg" alt="CP" class="list-card-img">
            <a href="engagement.php" class="cta-engagement">-Engagement-</a>
        </div>
        <div class="list-card">
            <img src="img/Gambar6.jpg" alt="product-ads" class="list-card-img">
            <a href="productAds.php" class="cta-ads">-Product Ads-</a>
        </div>
    </div>
</section>
<!-- portofolio section end -->

<!-- ulasan section start -->
<section id="ulasan" class="ulasan">
    <h2>Berikan <span>Ulasan</span></h2> q  
    <p>Berikan ulasan untuk kami</p>
    <div class="row">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d495.6296505274485!2d107.46655214369089!3d-6.38920090863258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69730ab65cfca1%3A0x8f89fb7f7070f29f!2sCikampek%20berseri%20blok%20A2!5e0!3m2!1sid!2sid!4v1692196886375!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
        
        <form action="ulasan.php" method="POST">
            <div class="input-group">
                <i data-feather="user"></i>
                <input type="text" name="email" placeholder="email" required>
            </div>
            <div class="input-group">
                <i data-feather="message-circle"></i>
                <textarea name="ulasan" id="ulasan" cols="50" rows="10" placeholder="Ulas disini" required></textarea>
            </div>
            
            <button type="submit" class="btn" name="submit">Kirim Ulasan</button>
        </form>
    </div>
</section>
<!-- ulasan section end -->

<!-- Ulasan yang Masuk -->
<section id="ulasan-masuk" class="ulasan-masuk">
    <h2>Ulasan <span>Terbaru</span></h2>
    <br>
    <div class="ulasan-container">
        <?php
            // Query untuk mengambil ulasan terbaru dari database
            $sql = "SELECT * FROM ulasan ORDER BY email DESC LIMIT 10"; // ambil 5 ulasan terbaru
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data dari setiap baris hasil query
                while($row = $result->fetch_assoc()) {
                    echo "<div class='ulasan-item'>";
                    echo "<p>" . $row['email'] . "</p>";
                    
                    echo "<h3>" . $row['ulasan'] . "</h3>";
                    echo "<br>";
                    echo "</div>";
                }
            } else {
                echo "<p>Tidak ada ulasan yang tersedia.</p>";
            }
        ?>
    </div>
</section>
<!-- Ulasan yang Masuk end -->

<!-- footer start -->
<footer>
    <div class="socials">
        <a href="https://www.instagram.com/delapanbelas.project?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i data-feather="instagram"></i></a>
        <a href="#"><i data-feather="message-circle"></i></a>
    </div>
    <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#portofolio">Portofolio</a>
        <a href="#ulasan">Ulasan</a>
    </div>
    <div class="credit">
        <p>Created by <a href="">RifalRifdiansyah</a>. | &copy; 2024.</p>
    </div>
</footer>
<!-- footer end -->

<!-- Feather icons -->
<script>
    feather.replace();

        function confirmLogout(event) {
            event.preventDefault(); 
            const userConfirmed = confirm("Are you sure you want to log out?");
            if (userConfirmed) {
                window.location.href = 'logout.php'; 
            }
        }
</script>

<!-- Custom JavaScript -->
<script src="js/script.js"></script>
</body>
</html>
