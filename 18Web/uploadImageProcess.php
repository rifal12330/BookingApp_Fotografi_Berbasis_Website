<?php
session_start();
include 'koneksi.php';

if (isset($_POST['upload'])) {
    $description = $_POST['description'];
    $user_id = $_POST['user_id']; // Ambil user_id dari form
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file gambar adalah gambar asli atau palsu
    $check = getimagesize($_FILES["image"]["tmp_name"]);
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
    if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
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

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Masukkan informasi gambar ke database
            $stmt = $conn->prepare("INSERT INTO images (file_name, file_path, description, user_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $file_name, $file_path, $description, $user_id);

            $file_name = basename($_FILES["image"]["name"]);
            $file_path = $target_file;

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

    $conn->close();
}
?>
