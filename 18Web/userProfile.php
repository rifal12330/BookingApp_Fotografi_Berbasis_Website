<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: loginRegister.php");
    exit;
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$sql = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

// Ambil data gambar dari database
$sql_images = "SELECT * FROM images WHERE user_id = ?";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->bind_param("i", $user_id);
$stmt_images->execute();
$result_images = $stmt_images->get_result();

$images = [];
if ($result_images->num_rows > 0) {
    while ($row = $result_images->fetch_assoc()) {
        $images[] = $row;
    }
}

$stmt_images->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    
    <!-- icon -->
    <link rel="icon" type="image/png" href="img/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Custom styles -->
    <link rel="stylesheet" href="userProfile.css">
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

<!-- Profile Section Start -->
<div class="profile-section">
    <h2>User <span>Profile</span></h2>
    <div class="profile-card">
        <div class="uploaded-images">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $image): ?>
                    <div class="image-card">
                        <img src="<?php echo htmlspecialchars($image['file_path']); ?>" alt="Uploaded Image">
                        <p><?php echo htmlspecialchars($image['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No images uploaded yet.</p>
            <?php endif; ?>
        </div>

        <div class="profile-details">
            <form action="updateChange.php" method="POST" enctype="multipart/form-data">
                <p><strong>Nama Lengkap:</strong> <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>"></p>
                <p><strong>Email:</strong> <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"></p>
                <p><strong>Nomor Telepon:</strong> <input type="text" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>"></p>
                <p><strong>Profile Picture:</strong> <input type="file" name="profile_picture" accept="uploads/*"></p>
                <button type="submit" name="save_changes">Simpan Perubahan</button>
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            </form>
        </div>
    </div>
</div>

<!-- Feather icons -->
<script>
    feather.replace();
</script>

<script src="js/script.js"></script>
</body>
</html>
