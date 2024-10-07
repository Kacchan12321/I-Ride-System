<?
$con = mysqli_connect("localhost", "root", "", "i-ride system");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-RIDE DASHBOARD</title>
   
    <!-- Include Ionicons for icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {    
                event.preventDefault();
            }
        }
    </script>

     <!-- ======= Styles ====== -->
     <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
     
        .table-wrapper {
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
            color: #fff;
            background: #343a40;
            padding: 16px 30px;
            margin: -20px -20px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .form-group label {
            width: 100%;
        }
        .tooltip .icon {
            margin-left: 5px;
            cursor: pointer;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #6c757d;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
        .password-strength.weak { color: red; }
        .password-strength.moderate { color: orange; }
        .password-strength.strong { color: green; }
        .tooltip {
            position: relative;
            display: inline-block;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 250px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%; 
            left: 50%; 
            margin-left: -125px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
        .icon {
            cursor: pointer;
        }
    </style>
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="image/logo.png" alt="Logo">
                        </span>
                        <span class="title">I-Ride</span>
                    </a>
                </li>
                <li>
                    <a href="super_admin_dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="bookings.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="transaction.php">
                        <span class="icon">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </span>
                        <span class="title">Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="finance.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Finances</span>
                    </a>
                </li>
                <li>
                    <a href="rider.php">
                        <span class="icon">
                            <ion-icon name="bicycle-outline"></ion-icon>
                        </span>
                        <span class="title">Riders</span>
                    </a>
                </li>
                <li class="active">
                    <a href="user.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>
                <li>
                    <a href="T&C.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">T&C</span>
                    </a>
                </li>
                <br>
                <br>
                <li>
                    <a href="logout.php" onclick="confirmLogout(event);">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
   
    <!-- ========================= Main ==================== -->

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <img src="assets/imgs/customer01.jpg" alt="">
            </div>
        </div>
        <h1 class="completed-bookings-heading" style="color: red; text-align: center;">USERS</h1>

        <div class="container">
            <br/>
            <div class="box">
                <div class="form-group">
                    <select class="form-control" onchange="selectdata(this.options[this.selectedIndex].value)">
                        <option value="All">All</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="General Admin">General Admin</option>
                        <option value="CSR">CSR</option>
                    </select> 
                    <div class="col-sm-6">
                        <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
                    </div>
                </div>
            </div>
        </div>

        
        <table class="table table-bordered table-striped">
            <thead style="background-color:#e3a53a;">
                <tr>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="result">
            </tbody>
        </table>
    </div>

                                
        
<div id="addUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="modal-header">						
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
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
                        <input type="text" id="address" name="address" required placeholder="Enter your Address" maxlength="50" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required maxlength="40" placeholder="example@example.com" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required maxlength="14" placeholder="Choose a username" pattern="^\S+$" title="No spaces allowed" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" oninput="validateNoSpaces(this)">
                        <div id="username-error" style="color: red; display: none;">No spaces allowed in username.</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required maxlength="20" minlength="7" pattern="^\S{7,20}$" title="Password must be 7 to 20 characters long and contain no spaces" placeholder="Enter your password" oninput="validateNoSpaces(this)">
                        <div id="password-error" style="color: red; display: none;">No spaces allowed in password.</div>
                        <div class="tooltip">
                            <i class="fas fa-question-circle icon" onclick="showPasswordGuidelines()"></i>
                            <span class="tooltiptext">Examples of Strong Password (e.g., uppercase, lowercase, digits, special characters. Minimum of 8 characters).<br><br>Password example: @Rex2132</span>
                        </div>
                        <div id="password-strength" class="password-strength"></div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required maxlength="20" placeholder="Confirm your password" oninput="validatePasswordMatch()">
                        <div id="password-match" class="password-match"></div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="">Select Role</option>
                            <option value="SUPER ADMIN">SUPER ADMIN</option>
                            <option value="GENERAL ADMIN">GENERAL ADMIN</option>
                            <option value="CSR">CSR</option>
                        </select>
                    </div>			
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                    
                </div>
            </form>
        </div>
    </div>
</div>

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
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO users (fullname, mobile, address, email, username, password, role) 
            VALUES ('$fullname', '$mobile', '$address', '$email', '$username', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>User created successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}


// Close database connection
mysqli_close($conn);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function validateNoSpaces(input) {
        if (/\s/.test(input.value)) {
            input.nextElementSibling.style.display = 'block';
        } else {
            input.nextElementSibling.style.display = 'none';
        }
    }

    function preventSpace(e) {
        if (e.key === ' ') {
            e.preventDefault();
        }
    }

    document.getElementById('username').addEventListener('keydown', preventSpace);
    document.getElementById('password').addEventListener('keydown', preventSpace);

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
            var strength = 0;
            var lengthRequirement = password.length >= 8;
            var hasLower = /[a-z]/.test(password);
            var hasUpper = /[A-Z]/.test(password);
            var hasNumber = /[0-9]/.test(password);
            var hasSpecial = /[\W_]/.test(password);

            // Check if the password meets the length requirement first
            if (lengthRequirement) {
                if (hasLower) strength++;
                if (hasUpper) strength++;
                if (hasNumber) strength++;
                if (hasSpecial) strength++;
            } else {
                // If password length is less than 8 characters, it's weak
                return 'weak';
            }

            // Evaluate strength based on the number of criteria met
            if (strength === 0 || strength === 1) {
                return 'weak';
            } else if (strength === 2) {
                return 'moderate';
            } else if (strength >= 3) {
                return 'strong';
            }
        }
        function showPasswordGuidelines() {
            // This function is triggered when the icon is clicked, so you can put additional actions here if needed
        }
    </script>
</div>


<script type="text/javascript">
        $(document).ready(function() {
            showdata();
        });

        function showdata() {
            $.ajax({
                url: 'show-data.php',
                method: 'post',
                success: function(result) {
                    $("#result").html(result);
                }
            });
        }

        function selectdata(cat) {
            $.ajax({
                url: 'select-data.php',
                method: 'post',
                data: { cat_name: cat },
                success: function(result) {
                    $("#result").html(result);
                }
            });
        }
    </script>
</body>

</html>

