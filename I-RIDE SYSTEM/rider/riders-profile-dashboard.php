<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-RIDE DASHBOARD</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Link to Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        }
    </script>
    <style>
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .refresh-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .refresh-icon {
            font-size: 2.5em;
            color: red;
        }

        .refresh-icon:hover {
            color: darkred;
        }

        .profile-container,
        .motorcycle-container,
        .requirements-container {
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-container h2,
        .motorcycle-container h2,
        .requirements-container h2 {
            text-align: center;
            color: #333;
        }

        .detail {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .detail i {
            margin-right: 10px;
            color: #555;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
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
                    <a href="riders-booking.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Bookings</span>
                    </a>
                </li>
                
                <li>
                    <a href="riders-transaction.php">
                        <span class="icon">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </span>
                        <span class="title">Transactions</span>
                    </a>
                </li>
                <li class="active">
                    <a href="riders-profile-dashboard.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="riders-t&C.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>

                        </span>
                        <span class="title">T&C</span>
                    </a>
                </li>

                
                <br><br><br><br><br><br><br><br><br><br><br><br>
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

            <!-- ======================= Cards ================== -->
            <h1 class="completed-bookings-heading" style="color: black; text-align: center;">
                <i class="fas fa-user"></i> PROFILE
            </h1>

            <!-- ================ Profile Details ================= -->
            <div class="profile-container">
                <h1 style="color: red; text-align: center;">
                    <i class="fas fa-id-card"></i> Profile Details
                </h1>
                <div class="detail">
                    <i class="fas fa-user"></i>
                    <strong>Name:</strong> Rex cinco
                </div>
                <div class="detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <strong>Address:</strong> 9921 Mabalacat City Pampanga
                </div>
                <div class="detail">
                    <i class="fas fa-mobile-alt"></i>
                    <strong>Mobile:</strong> (555) 123-4567
                </div>
                <div class="detail">
                    <i class="fas fa-envelope"></i>
                    <strong>Email:</strong> rexcinco100@gmail.com
                </div>
            </div>

            <!-- ================ Motorcycle Details ================= -->
            <div class="motorcycle-container">
                <h1 style="color: red; text-align: center;">
                    <i class="fas fa-motorcycle"></i> Motorcycle Details
                </h1>
                <div class="detail">
                    <i class="fas fa-file-alt"></i>
                    <strong>OR/CR:</strong> OR123456789
                </div>
                <div class="detail">
                    <i class="fas fa-car"></i>
                    <strong>Plate Number:</strong> ABC1234
                </div>
                <div class="detail">
                    <i class="fas fa-motorcycle"></i>
                    <strong>Motorcycle Brand:</strong> Honda
                </div>
                <div class="detail">
                    <i class="fas fa-palette"></i>
                    <strong>Color:</strong> Red
                </div>
                <div class="detail">
                    <i class="fas fa-user-shield"></i>
                    <strong>Ownership:</strong> Owned
                </div>
                <div class="detail">
                    <i class="fas fa-id-card"></i>
                    <strong>Licenses:</strong> Valid until 2025
                </div>
            </div>

            <!-- ================ Requirements ================= -->
            <div class="requirements-container">
                <h1 style="color: red; text-align: center;">
                    <i class="fas fa-file-alt"></i> Requirements
                </h1>
                <div class="detail">
                    <i class="fas fa-id-card"></i>
                    <strong>Submit ID proof</strong>
                </div>
                <div class="detail">
                    <i class="fas fa-file-contract"></i>
                    <strong>Submit Insurance documents</strong>
                </div>
            </div>

        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
