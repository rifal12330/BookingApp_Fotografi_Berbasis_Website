<?php include 'koneksi.php'; ?>

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
    <link rel="stylesheet" href="adminpage.css">
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
    
<!-- user card start -->
<div class="user-card">
        <br>
        <h1>ULASAN <span>CUSTOMER</span></h1><br>
        <div class="data-table">

            <?php
            // SQL query to select all data from table
            $sql = "SELECT * FROM ulasan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>";

                // mengambil baris nama pada tabel untuk dijadikan head
                while ($fieldinfo = $result->fetch_field()) {
                    echo "<th>" . htmlspecialchars($fieldinfo->name) . "</th>";
                }
                echo "<th>Delete</th>"; //menambahkan header action untuk kolom delete

                echo "</tr>";

                //ambil data dan tampilkan sebagai tabel row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    // tambahkan tombol delete untuk masing masing baris
                    echo "<td>
                            <form action='deleteUlasanProcess.php' method ='POST'>
                            <input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "' />
                            <button type='submit' name='submit' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this feedback?\");'>Delete</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
            
        </div>
    </div>
<!-- user card end -->


<!-- card section start -->
    <div class="small-1-card">
        <h1>
            <?php
                include 'adminProcess.php';
                $lastUserId = LastCust();
                echo htmlspecialchars($lastUserId);
            ?>
        </h1>
        <h6>CUSTOMER</h6>
    </div>
    <div class="small-2-card">
        <h1>
            <?php
                $lastBookId = LastOrder();
                echo htmlspecialchars($lastBookId);
            ?>
        </h1>
        <h6>ORDER</h6>
    </div>
    <div class="small-3-card">
        <h1>
            <?php
                $lastUlasan = LastUlasan();
                echo htmlspecialchars($lastUlasan);
            ?>
        </h1>
        <h6>FEEDBACK</h6>
    </div>
<!-- card section end -->

    
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