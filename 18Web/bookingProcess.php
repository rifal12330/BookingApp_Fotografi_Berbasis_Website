<?php
include 'koneksi.php';

// Periksa apakah booking form dikirimkan
if(isset($_POST['booking'])){
    $atasNama = $_POST['atasNama'];
    $email = $_POST['email'];
    $package = $_POST['package'];
    $nomor = $_POST['whatsapp'];
    $address = $_POST['address'];
    $event_date = $_POST['event_date'];
    $note = $_POST['note'];

    // Mengambil harga dari paket yang dipilih
    $query_price = "SELECT product_price FROM product_list WHERE product_name = ?";
    $stmt = $conn->prepare($query_price);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $package);
    $stmt->execute();
    $result = $stmt->get_result();
    $price = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row['product_price'];
    }

    $stmt->close();

    // Insert booking data ke database
    $query_booking = "INSERT INTO bookingform (nama, email, paket, harga, nomor, alamat, tanggal, catatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query_booking);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ssssssss", $atasNama, $email, $package, $price, $nomor, $address, $event_date, $note);

    if ($stmt->execute()) {
        echo '<script>alert("Booking berhasil."); window.location = "loginRegister.php";</script>';
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
    