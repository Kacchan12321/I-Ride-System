<?php
// DElETE
$con = mysqli_connect("localhost", "root", "", "i-ride system");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

if (isset($_POST['delete_user'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_user']);
    
    // Soft delete the user from the database by setting deleted_at to the current timestamp
    $delete_query = "UPDATE users SET deleted_at = NOW() WHERE user_id = $id";
    if (mysqli_query($con, $delete_query)) {
        echo "<script>alert('User deleted successfully');</script>";
        echo "<script>window.location.href = 'user.php';</script>";
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
} else {
    echo "<script>alert('No user ID specified');</script>";
    echo "<script>window.location.href = 'user.php';</script>";
}

// Close the database connection 
mysqli_close($con);
?>



