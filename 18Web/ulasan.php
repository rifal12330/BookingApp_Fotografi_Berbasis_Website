<?php
    include 'koneksi.php';
    
    // Ambil data ulasan
    $email = !empty($_POST['email']) ? $_POST['email'] : '';
    $ulasan = !empty($_POST['ulasan']) ? $_POST['ulasan'] : '';


    // Simpan data ulasan ke dalam database
    $sql = "INSERT INTO ulasan (email, ulasan) VALUES ('$email', '$ulasan')";

    if ($conn->query($sql) === TRUE) {

        //redirect kembali ke halaman
        echo "<script>window.addEventListener('load', function(){ window.location.href = 'index.php#home'; });</script>";

    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
?>