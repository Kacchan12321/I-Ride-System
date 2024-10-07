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

        .completed-bookings-heading {
            color: black;
            text-align: center;
            margin-top: 20px;
        }

        .transactions-table {
            margin: 20px auto;
            width: 80%;
            border-collapse: collapse;
        }

        .transactions-table th,
        .transactions-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .transactions-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .transactions-table td {
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
                <li class="active">
                    <a href="riders-transaction.php">
                        <span class="icon">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </span>
                        <span class="title">Transactions</span>
                    </a>
                </li>
                <li>
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

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                    <img src="assets/imgs/user.jpg" alt="">
                </div>
            </div>

           
            <!-- ======================= Transaction History ================== -->
            <h1 class="completed-bookings-heading" style="color: red; text-align: center;">Transaction History</h1>
            <div class="box">
                <div class="form-group">
                    <select class="form-control" onchange="selectdata(this.options[this.selectedIndex].value)">
                        <option value="All">All</option>
                        <option value="Same-day-Hatid">Same-day-Hatid</option>
                        <option value="Same-day-Delivery">Same-day-Delivery</option>
                        <option value="Same-day-Pet-Transpo">Same-day-Pet-Transpo</option>
                      
                    </select> 
                </div>
            <table class="transactions-table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Type of Transaction</th>
                        <th>Total Fare</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12345</td>
                        <td>2024-05-21</td>
                        <td>Same-Day Hatid</td>
                        <td>$100</td>
                    </tr>
                    <tr>
                        <td>12346</td>
                        <td>2024-05-21</td>
                        <td>Same-Day Delivery</td>
                        <td>$200</td>
                    </tr>
                    <tr>
                        <td>12347</td>
                        <td>2024-05-20</td>
                        <td>Pet Transpo</td>
                        <td>$50</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
