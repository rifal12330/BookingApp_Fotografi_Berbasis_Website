<?php
include 'koneksi.php';

// Periksa apakah form pendaftaran dikirimkan
if (isset($_POST['register'])) {
    $fullname = $_POST['nama'];
    $phone = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password sebelum menyimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data pengguna ke dalam database
    $query = "INSERT INTO user (nama_lengkap, email, password, no_hp) VALUES ('$fullname', '$email', '$hashed_password', '$phone')";

    if ($conn->query($query) === TRUE) {
        echo '<script>alert("Registrasi berhasil. Silakan login."); window.location = "loginRegister.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '"); window.location = "loginRegister.php";</script>';
    }
}
?>



