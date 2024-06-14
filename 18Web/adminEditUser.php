<?php
include 'koneksi.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Ambil data pengguna dari database berdasarkan user_id
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
} else {
    echo "Invalid user ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELAPANBELAS project</title>
    
    <!-- icon -->
    <link rel="icon" type="image/png" href="img\logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Custom styles -->
    <link rel="stylesheet" href="admineditUser.css">
</head>

<body>

<!-- Navbar start -->
<nav class="navbar">
        <a href="#" class="navbar-logo"> 
            <img src="img/logo.png" alt="">
        </a>
        <div class="navbar-nav">
            <a href="adminPage.php">Booking</a>
            <a href="adminPageUser.php">Users</a>
            <a href="adminPageUlasan.php">Ulasan</a>
        </div>
        <div class="navbar-extra">
            <a href="logout.php" onclick="confirmLogout(event)" id="log-out"><i data-feather="log-out"></i></a>
        </div>
    </nav>
<!-- Navbar End -->

<!-- update form Start -->
<h2>BOOKING <span>FORM</span></h2>
<form action="adminUpdateUserProcess.php" method="POST">
    <fieldset>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>" />

        <label for="nama_lengkap">Nama Lengkap :</label>
        <input type="text" id="nama" name="nama_lengkap" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" required />
        <br/>
        <br />

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />
        <br />
        <br />

        <label for="password">Password :</label>
        <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required />
        <br />
        <br />

        <label for="whatsapp">nomor Hp :</label>
        <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>" required />
        <br/>
        <br />
        <br/>
    </fieldset>
    <input type="submit" name="update" value="Simpan Perubahan" />
</form>
<!-- EditUserForm end -->

<!-- Feather icons -->
<script>
    feather.replace();

    function confirmLogout(event) {
        event.preventDefault(); 
        const userConfirmed = confirm("Are you sure you want to log out?");
        if (userConfirmed) {
            window.location.href = 'logout.php'; 
        }
    }
</script>

<script src="js/script.js"></script>
</body>
</html>

<!-- Update Form end -->


    
<!-- Feather icons -->
    <script>
        feather.replace();

        function confirmLogout(event) {
            event.preventDefault(); 
            const userConfirmed = confirm("Are you sure you want to log out?");
            if (userConfirmed) {
                window.location.href = 'logout.php'; 
            }
        }
    </script>

    <script src="js/script.js"></script>
</body>
</html>