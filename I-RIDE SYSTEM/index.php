<?php 
// Start session
session_start();

// Database connection setup
$servername = "localhost";
$username = "root";
$password = ""; // Consider using a secure password in production
$database = "i-ride system"; // Correctly specifying the database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// The rest of your PHP code for handling form submissions, etc.

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize input data
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['User_id'] = $row['User_id']; // Assuming UserID is the primary key of the users table
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            switch ($row['role']) {
                case 'SUPER ADMIN':
                    header("Location:super-admin/super_admin_dashboard.php");
                    exit();
                case 'GENERAL ADMIN':
                    header("Location:general-admin/general-admin-dashboard.php");
                    exit();
                case 'ADMIN':
                    header("Location:admin/admin-dashboard.php");
                    exit();
                case 'RIDER': 
                    header("Location:rider/riders-profile-dashboard.php");
                    exit();
                default:
                    // Redirect to a default page if role is not recognized
                    header("Location:default_dashboard.php");
                    exit();
            }

        } else {
            // Password is incorrect
            $_SESSION['login_error'] = "Invalid username or password";
            header("Location: index.php"); // Redirect back to login page with error message
            exit();
        }
    } else {
        // Username not found
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: index.php"); // Redirect back to login page with error message
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #F94343;
            color: white;
        }

        header {
            text-align: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            margin-right: 10px;
        }

        main {
            padding: 20px;
        }

        .login-section {
            text-align: center;
            max-width: 400px;
            margin: 0 auto;
            position: relative;
        }

        h3 {
            width: 180px;
            margin: 10px auto;
        }

        .username-input, .password-input {
            width: calc(100% - 20px); /* Adjusted width to fit container */
            margin-bottom: 10px;
            padding: 10px;
            background-repeat: no-repeat; /* Prevent repeating */
            background-position: 10px center; /* Adjust position */
            background-size: 20px 20px; /* Adjust size */
            padding-left: 40px; /* Adjust padding to accommodate the image */
        }

        .username-input {
            background-image: url('image/user.png'); /* Set background image */
        }

        .password-input {
            background-image: url('image/lock.jpg'); /* Set background image */
        }

        .recover {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .recover {
            position: absolute;
            right: 30px;
            bottom: 110px; /* Adjust this value to fit your layout */
        }

        .login-section button {
            width: 70px;
            height: 60px;
            border-radius: 60%;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        .login-section button.signup {
            background-color: black;
        }

        footer {
            text-align: center;
            padding: 20px 0;
        }

        .tagline {
            margin-bottom: 10px;
        }

        .company-details {
            font-size: 12px;
        }

        /* Animation for the text "SERVICES" */
        @keyframes wiggle {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(-5deg); }
            10% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
            10% { transform: rotate(0deg); }
        }

        .wiggle {
            display: flex;
            animation: wiggle 0.5s infinite;
            color: #fbe8b7;
            font-weight: bolder;
        }

        .signup {
            color: black;
            font-weight: bolder;
        }

        .save-password {
            display: flex;
            align-items: center;
            margin-left: 40px;
            font-size: 14px;
            color: white;
        }

        .save-password-box {
            position: absolute;
            margin-right: 350px;
            margin-left: 15px;
            bottom: 43%;
        }

        .popup-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: blue;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
        }

        .popup-notification.show {
            display: flex;
        }

        .close-btn {
            border: none;
            background: none;
            font-size: 14px;
            position: absolute;
            top: 1px;
            right: 1px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="image/logo.png">
            <h2>I-RIDE MOTO TRANSPORT<br><span class="wiggle">SERVICES</span></h2>
        </div>
    </header>
    <main>
        <section class="login-section">
            <h3>LOGIN DETAILS</h3>
            <form action="" method="POST">
                <section class="login-password">
                    <input type="text" class="username-input" name="username" placeholder="&#xf007; Username" required>
                    <input type="password" class="password-input" name="password" id="password" placeholder="&#xf023; Password" required>
                    <div class="save-password">
                        <label id="save-password-checkbox">Remember Password?</label>
                    </div>
                    <div class="save-password-box">
                        <input type="checkbox" onchange="showPopup()">
                    </div>
                    <div id="popup-notification" class="popup-notification">
                        <span id="popup-message">Password Saved</span>
                    </div>
                </section>
                <p id="password-notification" style="color: blue;"></p> <!-- Notification area -->
                <a href="recovery.php" class="recover">Recover Account</a>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php" class="signup">Sign up</a></p>
        </section>
    </main>
    <footer>
        <div class="tagline">"PROMISE HATID LANG"</div>
        <div class="company-details">&copy; 2024 I-RIDE.PH.<br> All rights reserved.<br> Version 1.0.1001</div>
    </footer>
    <script>
        // Function to show the pop-up notification
        function showPopup() {
            document.getElementById("popup-notification").classList.add("show");
            // Save the password in localStorage when the checkbox is checked
            if (document.querySelector(".save-password-box input").checked) {
                localStorage.setItem("savedPassword", document.getElementById("password").value);
            }
        }

        // Function to close the pop-up notification
        function closePopup() {
            document.getElementById("popup-notification").classList.remove("show");
        }

        // Function to check if the saved password exists in localStorage
        window.onload = function() {
            var savedPassword = localStorage.getItem("savedPassword");
            if (savedPassword) {
                // Autofill the password field if the saved password exists
                document.getElementById("password").value = savedPassword;
            }
        }
    </script>
</body>
</html>
