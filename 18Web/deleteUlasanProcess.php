<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Prepare and execute the delete statement
        $sql = "DELETE FROM ulasan WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                echo "Ulasan deleted successfully.";
            } else {
                echo "Error deleting Ulasan: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();

        // Redirect back to the admin page
        header("Location: adminPageUlasan.php");
        exit;
    } else {
        echo "ulasan not set.";
    }
} else {
    echo "Invalid request.";
}
