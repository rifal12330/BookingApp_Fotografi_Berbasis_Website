<?php
include 'koneksi.php';

// Periksa apakah booking form dikirimkan
if(isset($_POST['pay'])){
    $atasNama = $_POST['atasNama'];
    $email = $_POST['email'];
    $package = $_POST['package'];
    $nomor = $_POST['whatsapp'];
    $address = $_POST['address'];
    $event_date = $_POST['event_date'];
    $note = $_POST['note'];
    $payment_method = $_POST['payment_method'];

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

    // Handle image upload
    if(isset($_FILES["bukti_Pembayaran"]) && $_FILES["bukti_Pembayaran"]["error"] == 0) {
        $target_dir = "uploads/bukti_pembayaran/";
        $target_file = $target_dir . basename($_FILES["bukti_Pembayaran"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["bukti_Pembayaran"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["bukti_Pembayaran"]["size"] > 5000000) { // 5mb max size
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["bukti_Pembayaran"]["tmp_name"], $target_file)) {
                // Insert booking data ke database
                $query_booking = "INSERT INTO bookingform (nama, email, paket, harga, nomor, alamat, tanggal, catatan, via, bukti_pembayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query_booking);
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("ssssssssss", $atasNama, $email, $package, $price, $nomor, $address, $event_date, $note, $payment_method, $target_file);

                if ($stmt->execute()) {
                    echo '<script>alert("Booking berhasil."); window.location = "protectedPage.php";</script>';
                } else {
                    echo "Error: " . htmlspecialchars($stmt->error);
                }

                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded or there was an error with the upload.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
