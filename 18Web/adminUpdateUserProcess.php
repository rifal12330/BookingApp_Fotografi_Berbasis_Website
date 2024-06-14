<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $user_id = $_POST['user_id'];
    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];

    // Query untuk update data pengguna
    $sql = "UPDATE user SET nama_lengkap = ?, email = ?, password = ?, no_hp = ? WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
        exit;
    }

    $stmt->bind_param("ssssi", $nama, $email, $password, $no_hp, $user_id);
    if ($stmt->execute() === true) {
        // Redirect kembali ke halaman user setelah berhasil update
        header("Location: adminPageUser.php");
        exit;
    } else {
        echo "Error updating record: " . htmlspecialchars($stmt->error);
    }
    
    $stmt->close();
}

$conn->close();
?>
