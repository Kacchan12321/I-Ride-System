<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "i-ride system");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Check if the user ID is set in the URL
if (isset($_GET['user_id'])) {
    // Sanitize the user ID
    $id = mysqli_real_escape_string($con, $_GET['user_id']);

    // Soft delete the user by updating the is_deleted column
    $soft_delete_query = "UPDATE users SET is_deleted = 1 WHERE user_id = $id";
    if (mysqli_query($con, $soft_delete_query)) {
        echo "<script>
                alert('User deleted successfully!');
                window.location.href = 'user.php';
              </script>";
    } else {
        echo "Error: " . $soft_delete_query . "<br>" . mysqli_error($con);
    }
} else {
    echo "<script>
            alert('No user ID specified!');
            window.location.href = 'user.php';
          </script>";
}

// Close the database connection
mysqli_close($con);
?>
