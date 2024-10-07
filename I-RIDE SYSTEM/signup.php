<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Link to Font Awesome CSS -->
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
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Make the image circular */
            border: 2px solid white; /* Add a white border */
            margin-right: 10px; /* Add some space between the logo and company name */
        }
        .logo h1 {
            font-size: 24px;
            margin: 0;
            color:red;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            background-color:RED;
            color: white;
            cursor: pointer;
        }
        .login-button{
            background-color:black;
            color: white;
            cursor: pointer;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
           padding: 10px 20px;
           background-color: #007bff;
           color: #fff;
           border: none;
           border-radius: 5px;
           cursor: pointer;
           transition: background-color 0.3s;
           margin-bottom: 10px;
       }

       .btn:hover {
          background-color: #0056b3;
       }

       .login-button {
         background-color: red;
       }
       .password-strength {
           margin-top: 5px;
           font-size: 12px;
       }
       .weak {
           color: red;
       }
       .moderate {
           color: orange;
       }
       .strong {
           color: green;
       }
       .info-icon-container {
            position: relative;
        }
        .icon {
            position: absolute;
            top: 10px;
            right: 200px;
            transform: translate(-50%, -50%);
            cursor: pointer;
            color: green; /* Adjust icon color */
        }
       
        
        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: green;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 120%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
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
        <img src="image/logo.png" alt="i-RIDE Logo">
        <h1>I-RIDE </h1>
    </div>
   
    <h2 style="text-align: center; margin-bottom: 20px;">Signup Details</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required placeholder="Enter your First Name" maxlength="50" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required placeholder="Enter your Last Name" maxlength="50" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
        </div>

        <div class="form-group">
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" required maxlength="11" placeholder="09-18*******" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']; ?>">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" id="address" name="address" required placeholder="Enter your Address" maxlength="50" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">                </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required maxlength="40" placeholder="example jay@email.com" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required maxlength="14" placeholder="Choose a username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required maxlength="20" minlength="7" pattern=".{7,20}" title="Password must be 7 to 20 characters long" placeholder="Enter your password">
            <!-- Question icon -->
            <div class="tooltip">
    <i class="fas fa-question-circle icon" onclick="showPasswordGuidelines()"></i>
    <span class="tooltiptext"> Examples of Strong Password  (e.g., uppercase, lowercase, digits, special characters.Minimum of 8 characters). <br><br> Password example: @Rex2132</span>
</div>
            <div id="password-strength" class="password-strength"></div>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required maxlength="15" placeholder="Confirm your password">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="SUPER ADMIN">SUPER ADMIN</option>
                <option value="GENERAL ADMIN">GENERAL ADMIN</option>
                <option value="CSR">CSR</option>
                    
            </select>
        </div>
      
        <input type="submit" value="CREATE" class="btn login-button">
        <button type="button" onclick="location.href='index.php';" class="btn login-button">Login Now</button>
    </form>

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
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];

    // Concatenate first name and last name
    $fullname = $first_name . ' ' . $last_name;

    // Sanitize input data
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $address = mysqli_real_escape_string($conn, $address);
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);
    $role = mysqli_real_escape_string($conn, $role);

    // Check for password match
    if ($password != $confirm_password) {
        echo "<p style='color: red;'>Passwords do not match!</p>";
        exit(); // Stop further execution
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO Users (fullname, mobile, address, email, username, password, role) 
            VALUES ('$fullname', '$mobile', '$address', '$email', '$username', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>User created successfully!</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php'; // Redirect to index.php after 2 seconds
                }, 2000);
              </script>";
    } else {
        echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

// Close database connection
mysqli_close($conn);
?>

<script>
    document.getElementById('password').addEventListener('input', function (e) {
        var input = e.target;
        var strength = checkPasswordStrength(input.value);
        var strengthIndicator = document.getElementById('password-strength');
        if (strength === 'weak') {
            strengthIndicator.textContent = 'Weak';
            strengthIndicator.className = 'password-strength weak';
        } else if (strength === 'moderate') {
            strengthIndicator.textContent = 'Moderate';
            strengthIndicator.className = 'password-strength moderate';
        } else if (strength === 'strong') {
            strengthIndicator.textContent = 'Strong';
            strengthIndicator.className = 'password-strength strong';
        }
    });

    function checkPasswordStrength(password) {
        if (password.length < 6) {
            return 'weak';
        } else if (password.length >= 6 && password.length <= 10) {
            return 'moderate';
        } else {
            return 'strong';
        }
    }

    function showPasswordGuidelines() {
        // This function is triggered when the icon is clicked, so you can put additional actions here if needed
    }
</script>


</body>
</html>
