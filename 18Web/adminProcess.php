<?php

function LastCust() {
    include 'koneksi.php';

    // SQL query to count the total number of rows in the user table
    $sql = "SELECT COUNT(*) as total_users FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalUsers = $row['total_users'];
    } else {
        $totalUsers = 0; // No records found
    }

    $conn->close();
    return $totalUsers;
}


function LastOrder() {
    include 'koneksi.php';

    // SQL query to count the total number of rows in the bookingform table
    $sql = "SELECT COUNT(*) as total_orders FROM bookingform";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalOrders = $row['total_orders'];
    } else {
        $totalOrders = 0; // No records found
    }

    $conn->close();
    return $totalOrders;
}


function Lastulasan() {
    include 'koneksi.php';

    // SQL query to count the total number of rows in the bookingform table
    $sql = "SELECT COUNT(*) as total_ulasan FROM ulasan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalUlasan = $row['total_ulasan'];
    } else {
        $totalUlasan = 0; // No records found
    }

    $conn->close();
    return $totalUlasan;
}

?>
