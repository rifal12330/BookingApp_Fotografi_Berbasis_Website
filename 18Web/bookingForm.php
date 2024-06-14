<?php include 'koneksi.php'; ?>

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
    <link rel="stylesheet" href="booking.css">
</head>

<body>
<!-- Navbar start -->
<nav class="navbar">
    <a href="protectedPage.php" class="navbar-logo"> 
        <img src="img/logo.png" alt="">
    </a>

    <div class="navbar-nav">
        <a href="protectedPage.php#home">Home</a>
        <a href="protectedPage.php#about">Tentang kami</a>
        <a href="protectedPage.php#portofolio">Portofolio</a>
        <a href="protectedPage.php#ulasan">Ulasan</a>
    </div>

    <div class="navbar-extra">
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>
<!-- Navbar End -->

<!-- BookingForm Start -->
<h2>BOOKING <span>FORM</span></h2>
<form action="payment.php" method="POST">
<fieldset>
    <label for="atasNama">Atas Nama :</label>
    <br/>
    <input type="text" id="nama" name="atasNama" required />
    <br/>
    
    <label for="email">Email :</label>
    <br />
    <input type="email" id="email" name="email" required />
    <br />
    
    <label for="package">Jenis :</label>
    <br/>
    <select id="package" name="package" required>
    <?php
        $query_produk = "SELECT * FROM product_list";
        $result_produk = $conn->query($query_produk);

        if ($result_produk->num_rows > 0) {
            while ($row_produk = $result_produk->fetch_assoc()) {
                echo '<option value="' . $row_produk['product_name'] . '" data-price="' . $row_produk['product_price'] . '">' . $row_produk['product_name'] . '</option>';
            }
        }
    ?>
    </select>
    <br/>
    
    <label for="whatsapp">Whatsapp :</label>
    <br />
    <input type="tel" id="whatsapp" name="whatsapp" value="+62" required />
    <br/>

    <label for="address">Alamat Lengkap :</label>
    <br />
    <textarea id="address" name="address" required></textarea>
    <br/>
    
    <label for="event_date">Hari, Tanggal & Jam Acara :</label>
    <br/>
    <input type="datetime-local" id="event_date" name="event_date" required />
    <br/>
    
    <label for="note">Catatan Tambahan untuk kami :</label>
    <br/>
    <textarea id="note" name="note" required></textarea>
    <br/>
  </fieldset>
  <input type="submit" name="" value="Kirim ke DelapanBelas" />
</form>
<!-- BookingForm end -->

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
</script>
<script src="js/script.js"></script>
</body>
</html>