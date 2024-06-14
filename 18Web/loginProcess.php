<?php
session_start();
include 'koneksi.php';

// Periksa apakah form login dikirimkan
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika email ditemukan, periksa password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password cocok, set session untuk user yang berhasil login
            $_SESSION['user_id'] = $user['user_id']; // Simpan ID pengguna di session
            $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Simpan nama lengkap pengguna di session

            // Cek apakah email customer atau admin @delapanbelas.com
            $emailDomain = substr(strrchr($email, "@"), 1);
            if ($emailDomain === 'delapanbelas.com') {
                header("Location: adminPage.php");
            } else {
                header("Location: protectedPage.php");
            }
            exit();
        } else {
            // Password tidak cocok
            echo '<script>alert("Password salah. Silakan coba lagi."); window.location = "loginRegister.php";</script>';
        }
    } else {
        // Email tidak ditemukan
        echo '<script>alert("Email tidak terdaftar. Silakan daftar terlebih dahulu."); window.location = "loginRegister.php";</script>';
    }

    $stmt->close();
    $conn->close();
}

?>
