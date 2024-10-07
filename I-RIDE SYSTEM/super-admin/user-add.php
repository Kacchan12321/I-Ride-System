<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "i-ride system");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get form data
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $fullname = $first_name . ' ' . $last_name;
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    // Insert data into the database using prepared statement
    $insert_query = "INSERT INTO users (name, Address, mobile, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($stmt, "sssssss", $fullname, $address, $mobile, $email, $username, $password, $role);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('User added successfully!');
                window.location.href = 'user.php';
              </script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
    }
    
    // Close prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($con);
?>
