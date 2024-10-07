<?php
session_start(); // ACTIVATE/DEACTIVATE

$con = mysqli_connect("localhost", "root", "", "beta-i-ride");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

if(isset($_POST['activate_user'])) {
    $userId = $_POST['activate_user'];
    $query = "UPDATE users SET status = 'active' WHERE UserID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success_message'] = "User activated successfully.";
}

if(isset($_POST['deactivate_user'])) {
    $userId = $_POST['deactivate_user'];
    $query = "UPDATE users SET status = 'inactive' WHERE UserID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success_message'] = "User deactivated successfully.";
}

mysqli_close($con);

// Redirect back to the page where the form was submitted
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>

























