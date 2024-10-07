<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <!-- Font Awesome for info circle icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: red;
        }
        .container {
            max-width: 400px;
            margin: 120px auto; /* Center the container horizontally */
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            position: relative;
        }
        .logo {
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
        }
        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Make the image circular */
            border: 2px solid white; /* Add a white border */
        }
        h2 {
            color: #ff4d4d; /* Red color for the header */
        }
        .form-group {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            position: relative; /* Ensure relative positioning for child elements */
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .btn {
            padding: 10px 20px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
          .tooltip {
            position: relative;
            display: inline-block;
            left: 20%;
           bottom: 10px;
        }
        /* Style for information icon */
        .tooltip .tooltiptext {
            
            visibility: hidden;
            width: 200px;
            background-color: #555;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 1%;
            left: 100%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
            content: "";
          
            top: 100%;
            left: 100%%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }
        
        /* Show the tooltip text when hovering over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="../assets/imgs/logo.png" alt="i-RIDE Logo">
    </div>
    <h2>Password Recovery</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group info-icon-container">
            <label for="username_or_email">Username or Email:</label>
            <input type="text" id="username_or_email" name="username_or_email" required>
            <!-- Info icon for password policy -->
            <div class="tooltip">
    <i class="fas fa-question-circle icon" onclick="showPasswordGuidelines()"></i>
    <span class="tooltiptext">Password Should have (e.g., uppercase, lowercase, digits, special characters.Minimum of 8 characters). <br><br> Password example: @Rex2132</span>
</div>
        </div>
        <!-- Error message for weak password -->
        <div id="password-strength-message" style="display: none; color: red;"></div>
        <!-- Your existing form fields and buttons -->
        <button type="submit" name="search_user" class="btn">Search User</button>
        <div class="form-group">
            <button type="button" onclick="location.href='index.php';" class="btn login-button">Go Back</button>
        </div>
    </form>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "iride_database";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if password_history column exists, if not, add it to the users table
    $check_column_sql = "SHOW COLUMNS FROM users LIKE 'password_history'";
    $check_column_result = mysqli_query($conn, $check_column_sql);

    if (mysqli_num_rows($check_column_result) == 0) {
        // Add password_history column to users table
        $add_column_sql = "ALTER TABLE users ADD COLUMN password_history TEXT DEFAULT NULL";
        if (mysqli_query($conn, $add_column_sql)) {
            echo "<p style='color: green;'>Added 'password_history' column to 'users' table.</p>";
        } else {
            echo "<p style='color: red;'>Error adding 'password_history' column: " . mysqli_error($conn) . "</p>";
        }
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_user"])) {
        // Retrieve form data
        $username_or_email = $_POST["username_or_email"];

        // Sanitize input data
        $username_or_email = mysqli_real_escape_string($conn, $username_or_email);

        // Query to fetch user data based on username or email
        $sql = "SELECT username, security_question FROM users WHERE username = '$username_or_email' OR email = '$username_or_email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $username = $row["username"];
            $security_question = $row["security_question"];

            // Display the security question and form to reset password
            echo "<p>Security Question: $security_question</p>";
            echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
            echo "<input type='hidden' name='username' value='$username'>";
            echo "<input type='hidden' name='security_question' value='$security_question'>";
            echo "<div class='form-group'>";
            echo "<label for='security_answer'>Security Answer:</label>";
            echo "<input type='text' id='security_answer' name='security_answer' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='new_password'>New Password:</label>";
            echo "<input type='password' id='new_password' name='new_password' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='confirm_password'>Confirm Password:</label>";
            echo "<input type='password' id='confirm_password' name='confirm_password' required>";
            echo "</div>";
            echo "<input type='submit' name='reset_password' value='Reset Password' class='btn'>";
            echo "</form>";
        } else {
            echo "<p style='color: red;'>User not found or multiple users found with the provided username/email!</p>";
        }
    }

   // Handle password reset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_password"])) {
    // Retrieve form data
    $username = $_POST["username"];
    $security_question = $_POST["security_question"];
    $security_answer = $_POST["security_answer"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Sanitize input data
    $username = mysqli_real_escape_string($conn, $username);
    $security_question = mysqli_real_escape_string($conn, $security_question);
    $security_answer = mysqli_real_escape_string($conn, $security_answer);

    // Query to fetch user data and verify security answer
    $sql = "SELECT security_answer, password_history FROM users WHERE username = '$username' AND security_question = '$security_question'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_security_answer = $row["security_answer"];
        $password_history = unserialize($row["password_history"]);

        // Compare provided security answer with stored answer
        if ($security_answer === $stored_security_answer) {
            // Check if new password matches confirm password
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Hash the new password for password history
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Check if the password history array exists and hash each password in it
                if (is_array($password_history)) {
                    $hashed_password_history = array_map(function($password) {
                        return password_hash($password, PASSWORD_DEFAULT);
                    }, $password_history);
                } else {
                    $hashed_password_history = [];
                }

                // Add the hashed new password to the password history
                $hashed_password_history[] = $hashed_new_password;

                // Serialize the hashed password history array
                $serialized_password_history = serialize($hashed_password_history);

                // Update password and password history in the database
                $update_sql = "UPDATE users SET password = '$hashed_password', password_history = '$serialized_password_history' WHERE username = '$username'";
                if (mysqli_query($conn, $update_sql)) {
                    echo "<p style='color: green;'>Password reset successfully!</p>";
                } else {
                    echo "<p style='color: red;'>Error updating password: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p style='color: red;'>New password and confirm password do not match!</p>";
            }
        } else {
            echo "<p style='color: red;'>Incorrect security answer!</p>";
        }
    } else {
        echo "<p style='color: red;'>User not found or security question does not match!</p>";
    }
}


    // Close database connection
    mysqli_close($conn);
    ?>
</div>

<!-- JavaScript for password strength feedback -->
<script>
    // Function to display password policy information
    function showPasswordGuidelines() {
        // This function is triggered when the icon is clicked, so you can put additional actions here if needed
    }

    // Function to check password strength and provide feedback
    document.getElementById('new_password').addEventListener('input', function () {
        var password = this.value;
        var strengthMessage = document.getElementById('password-strength-message');

        // Regular expressions to check for password complexity criteria
        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasNumbers = /\d/.test(password);
        var hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        // Calculate password strength based on criteria met
        var strength = 0;
        if (hasUpperCase) strength++;
        if (hasLowerCase) strength++;
        if (hasNumbers) strength++;
        if (hasSpecialChars) strength++;

        // Display strength message based on strength level
        if (password.length < 8 || strength < 3) {
            strengthMessage.textContent = "Password should contain at least 8 characters and include uppercase letters, lowercase letters, numbers, and special characters                              Example :@Rex1315.";
            strengthMessage.style.display = 'block';
        } else {
            strengthMessage.style.display = 'none';
        }
    });
</script>

</body>
</html>
