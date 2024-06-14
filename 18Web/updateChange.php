<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: loginRegister.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['save_changes'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Perbarui data pengguna di database
        $sql = "UPDATE user SET nama_lengkap = ?, email = ?, no_hp = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama_lengkap, $email, $no_hp, $user_id);
        $stmt->execute();

        // Jika pengguna mengunggah gambar profil baru
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            // Periksa apakah file gambar adalah gambar asli atau palsu
            $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        
            // Periksa apakah file sudah ada
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
        
            // Batasi ukuran file
            if ($_FILES["profile_picture"]["size"] > 5000000) { // 5MB limit
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
        
            // Batasi format file yang diizinkan
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        
            // Periksa apakah $uploadOk adalah 0 karena kesalahan
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                    
            // Jika semua oke, coba upload file
            } else {
                // Periksa apakah user sudah memiliki gambar sebelumnya
                $sql = "SELECT file_path FROM images WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $old_file_path = $row['file_path'];
                    
                    // Hapus gambar lama dari server
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                    
                    // Hapus entri lama dari database
                    $delete_sql = "DELETE FROM images WHERE user_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $user_id);
                    $delete_stmt->execute();
                    $delete_stmt->close();
                }
                $stmt->close();
        
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                    // Masukkan informasi gambar ke database
                    $stmt = $conn->prepare("INSERT INTO images (file_name, file_path, description, user_id) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("sssi", $file_name, $file_path, $description, $user_id);
        
                    $file_name = basename($_FILES["profile_picture"]["name"]);
                    $file_path = $target_file;
                    $description = 'Profile picture'; // You can adjust this description as needed
        
                    if ($stmt->execute()) {
                        header("Location: userProfile.php");
                    } else {
                        echo "Error: " . $stmt->error;
                    }
        
                    $stmt->close();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Commit transaksi
        $conn->commit();
        header("Location: userProfile.php");
        exit;

    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
$conn->close();
