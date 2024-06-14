<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];

        // Prepare and execute the delete statement
        $sql = "DELETE FROM bookingform WHERE booking_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $booking_id);

            if ($stmt->execute()) {
                echo "Booking deleted successfully.";
            } else {
                echo "Error deleting booking: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();

        // Redirect back to the admin page
        header("Location: adminPage.php");
        exit;
    } else {
        echo "Booking ID not set.";
    }
} else {
    echo "Invalid request.";
}
