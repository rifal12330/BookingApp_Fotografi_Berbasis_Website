<?php 
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELAPANBELAS Project - Payment Form</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

        <!-- Feather icons -->
        <script src="https://unpkg.com/feather-icons"></script>

        <!-- Custom styles -->
        <link rel="stylesheet" href="Payment.css">
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
            <a href="logout.php" onclick="confirmLogout(event)" id="log-out"><i data-feather="log-out"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- PaymentForm Start -->
    <div class="container">
        <h2>PAYMENT <span>FORM</span></h2>
        
        <?php
            // Retrieve data from POST
            $atasNama = $_POST['atasNama'];
            $email = $_POST['email'];
            $package = $_POST['package'];
            $whatsapp = $_POST['whatsapp'];
            $address = $_POST['address'];
            $event_date = $_POST['event_date'];
            $note = $_POST['note'];

            // Fetch the price of the selected package from the database
            $query = "SELECT product_price FROM product_list WHERE product_name = ?";
            $stmt = $conn->prepare($query);

            // Check if the prepare statement was successful
            if ($stmt === false) {
                echo "<p>Error preparing statement: " . htmlspecialchars($conn->error) . "</p>";
            } else {
                $stmt->bind_param("s", $package);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if the query was successful and fetch the price
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Get the price as float
                    $package_price = floatval($row['product_price']);
                } else {
                    echo "<p>Error: No matching package found.</p>";
                    $package_price = 0;
                }
            }
        ?>
        
        <form action="paymentProcess.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <label for="cardholder_name">Atas Nama :</label>
                <input type="text" id="cardholder_name" name="atasNama" value="<?php echo htmlspecialchars($atasNama); ?>" readonly />

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly />

                <label for="package">Jenis :</label>
                <input type="text" id="package" name="package" value="<?php echo htmlspecialchars($package); ?>" readonly />

                <label for="whatsapp">Whatsapp :</label>
                <input type="tel" id="whatsapp" name="whatsapp" value="<?php echo htmlspecialchars($whatsapp); ?>" readonly />

                <label for="address">Alamat Lengkap :</label>
                <textarea id="address" name="address" readonly><?php echo htmlspecialchars($address); ?></textarea>

                <label for="event_date">Hari, Tanggal & Jam Acara :</label>
                <input type="datetime-local" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event_date); ?>" readonly />
                <br>
                <br>
                <label for="note">Catatan Tambahan untuk kami :</label>
                <br/>
                <textarea id="note" name="note" value="" readonly><?php echo htmlspecialchars($note); ?></textarea>
                <br/>
                
                <input type="radio" id="DANA" name="payment_method" value="DANA">
                <img src="img/Gambar14.png" alt="" class="dana">
                <h3>083806123055 a/n <br>Muhammad Rifal Rifdiansyah</h3>
                <br>
                <input type="radio" id="BRI" name="payment_method" value="BRI">
                <img src="img/Gambar15.png" alt="" class="BRI">
                <h3>326001001730502 a/n <br>Muhammad Rifal Rifdiansyah</h3>
                <br>
                <input type="radio" id="BTN" name="payment_method" value="BTN">
                <img src="img/Gambar16.png" alt="" class="BTN">
                <h3>326001001730502 a/n <br>Muhammad Rifal Rifdiansyah</h3>
                <br>

                <!-- Total Harga -->
                <label for="total">Total Harga</label>
                <h1>Rp. <?php echo number_format($package_price, 2, ',', '.'); ?></h1>
                <br>
                <p>Upload Bukti Pembayaran: <br><br><input type="file" name="bukti_Pembayaran" accept="uploads/bukti_pembayaran/*"></p><br>
            </fieldset>

            <input type="submit" name="pay" value="Konfirmasi Pembayaran" />
    </form>
</div>
<!-- PaymentForm end -->

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
        <p>Created by <a href="">delapanBelas</a>. | &copy; 2024.</p>
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
