<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Prepare and execute the delete statement
        $sql = "DELETE FROM user WHERE user_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $user_id);

            if ($stmt->execute()) {
                echo "user deleted successfully.";
            } else {
                echo "Error deleting user: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();

        // Redirect back to the admin page
        header("Location: adminPageUser.php");
        exit;
    } else {
        echo "user ID not set.";
    }
} else {
    echo "Invalid request.";
}
