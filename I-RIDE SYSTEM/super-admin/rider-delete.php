<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "i-ride system";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $rider_id = mysqli_real_escape_string($conn, $_GET['id']);
    $stmt = $conn->prepare("DELETE FROM riders WHERE rider_id=?");
    $stmt->bind_param("i", $rider_id);

    if ($stmt->execute()) {
        header("Location: rider.php"); // Redirect back to the main page
        exit;
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

mysqli_close($conn);
?>
