<?php
// Database connection settings
$host = "localhost"; 
$dbname = "i-ride system"; 
$username = "root"; 
$password = ""; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$bookingNumber = $_POST['bookingNumber'];
$bookingType = $_POST['bookingType'];
$bookingDetails = $_POST['bookingDetails'];
$bookingFare = $_POST['bookingFare'];
$riderName = $_POST['riderName'];
$csrName = $_POST['csrName'];
$comment = $_POST['comment'];

// Insert new booking into the database
$sql = "INSERT INTO bookings (booking_number, booking_type, booking_details, booking_fare, rider_name, csr_name, comment)
        VALUES ('$bookingNumber', '$bookingType', '$bookingDetails', '$bookingFare', '$riderName', '$csrName', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Booking added successfully!";
    header("Location: index.php"); // Redirect back to the main page
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
