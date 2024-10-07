<?php
// Database connection
$host = "localhost";
$dbname = "i-ride system";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['edit_booking_id'];
    $booking_type = $_POST['edit_booking_type'];
    $booking_detail = $_POST['edit_booking_detail'];
    $fare = $_POST['edit_fare'];
    $comment = $_POST['edit_comment'];

    // SQL query to update booking in the database
    $sql = "UPDATE bookings SET 
            booking_type='$booking_type', 
            booking_detail='$booking_detail', 
            fare='$fare', 
            comment='$comment'
            WHERE booking_id='$booking_id'";

    // Execute query and handle result
    if ($conn->query($sql) === TRUE) {
        echo "Booking updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
