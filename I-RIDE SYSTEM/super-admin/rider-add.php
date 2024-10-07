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
    // Collecting input data
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<p style='color: red;'>Passwords do not match!</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $fullname = $first_name . ' ' . $last_name;

        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO riders (fullname, mobile, address, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Check if prepare was successful
        if ($stmt === false) {
            die("MySQL prepare statement failed: " . $conn->error);
        }

        $stmt->bind_param("ssssss", $fullname, $mobile, $address, $email, $username, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: rider.php"); // Redirect back to the main page
            exit;
        } else {
            echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

mysqli_close($conn);
?>
