<?php
// delete_booking.php

$host = "localhost";
$dbname = "i-ride system";
$username = "root";
$password = "";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_id = $_GET['id'];

// Delete booking
$sql = "DELETE FROM bookings WHERE booking_id='$booking_id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Booking deleted successfully!'); window.location.href='bookings.php';</script>";
} else {
    echo "<script>alert('Error deleting booking');</script>";
}

$conn->close();
?>
