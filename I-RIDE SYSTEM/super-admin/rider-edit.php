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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    $fullname = $first_name . ' ' . $last_name;

    $stmt = $conn->prepare("UPDATE riders SET fullname=?, mobile=?, address=?, email=?, username=? WHERE rider_id=?");
    $stmt->bind_param("sssssi", $fullname, $mobile, $address, $email, $username, $rider_id);

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
