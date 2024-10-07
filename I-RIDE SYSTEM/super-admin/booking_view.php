<?php
// view_booking.php

$host = "localhost";
$dbname = "i-ride system";
$username = "root";
$password = "";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get booking ID from URL
$booking_id = $_GET['id'];

// Fetch booking details
$sql = "SELECT * FROM bookings WHERE booking_id = '$booking_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Booking Details</h2>";
    echo "Booking ID: " . $row['booking_id'] . "<br>";
    echo "Booking Type: " . $row['booking_type'] . "<br>";
    echo "Booking Details: " . $row['booking_detail'] . "<br>";
    echo "Fare: " . $row['fare'] . "<br>";
    echo "Comment: " . $row['comment'] . "<br>";
    echo "Status: " . $row['status'] . "<br>";
} else {
    echo "Booking not found.";
}

$conn->close();
?>
