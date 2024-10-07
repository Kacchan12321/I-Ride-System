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



// Fetch all riders
$riders = mysqli_query($conn, "SELECT * FROM riders");
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
                <li class="active">
                    <a href="rider.php">
                        <span class="icon">
                            <ion-icon name="bicycle-outline"></ion-icon>
                        </span>
                        <span class="title">Riders</span>
                    </a>
                </li>
                <li>
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

    <div class="container">
        <h1>Riders</h1>
        <a href="#addRiderModal" class="btn btn-success" data-toggle="modal">Add New Rider</a>

       <!-- Add Rider Modal -->
       <div class="modal fade" id="addRiderModal" tabindex="-1" role="dialog" aria-labelledby="addRiderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="rider-add.php">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Rider</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number:</label>
                                <input type="text" id="mobile" name="mobile" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Riders List -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Rider ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($riders)): ?>
                    <tr>
                        <td><?php echo $row['rider_id']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="#editRiderModal<?php echo $row['rider_id']; ?>" class="btn btn-warning" data-toggle="modal">Edit</a>
                            <a href="rider-delete.php?id=<?php echo $row['rider_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this rider?');">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Rider Modal -->
                    <div class="modal fade" id="editRiderModal<?php echo $row['rider_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRiderModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="rider-edit.php">
                                    <input type="hidden" name="rider_id" value="<?php echo $row['rider_id']; ?>">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Rider</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" id="first_name" name="first_name" value="<?php echo explode(' ', $row['fullname'])[0]; ?>" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" id="last_name" name="last_name" value="<?php echo explode(' ', $row['fullname'])[1]; ?>" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number:</label>
                                            <input type="text" id="mobile" name="mobile" value="<?php echo $row['mobile']; ?>" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-warning" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>