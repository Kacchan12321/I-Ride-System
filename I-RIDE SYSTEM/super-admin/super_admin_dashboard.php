<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-RIDE DASHBOARD</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        }
    </script>
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

                <li class="active">
                    <a href="#">
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
<h1 class="completed-bookings-heading" style="color: red; text-align: center;">COMPLETED BOOKINGS</h1>

<div class="cardBox">
   <?php


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
    // Fetch booking details from the database
    $sql = "SELECT SUM(same_day_hatid) AS same_day_hatid_total, 
                   SUM(same_day_delivery) AS same_day_delivery_total, 
                   SUM(pet_transpo) AS pet_transpo_total, 
                   SUM(same_day_hatid + same_day_delivery + pet_transpo) AS total_bookings 
            FROM csr_details";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="card">
                <div>
                    <div class="numbers">' . $row["same_day_hatid_total"] . '</div>
                    <div class="cardName">SAME-DAY HATID</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="people-outline"></ion-icon>
                </div>
            </div>';

        echo '<div class="card">
                <div>
                    <div class="numbers">' . $row["same_day_delivery_total"] . '</div>
                    <div class="cardName">SAME-DAY DELIVERY</div>
                </div>
                <div class="iconBx">    
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>';

        echo '<div class="card">
                <div>
                    <div class="numbers">' . $row["pet_transpo_total"] . '</div>
                    <div class="cardName">PET-TRANSPO</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="paw-outline"></ion-icon>
                </div>
            </div>';

        echo '<div class="card">
                <div>
                    <div class="numbers">' . $row["total_bookings"] . '</div>
                    <div class="cardName">TOTAL BOOKINGS</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>';
    } else {
        echo '<p>No booking details found</p>';
    }

    $conn->close();
    ?>
</div>


        <!-- ========================= Main ==================== -->
       
            <!-- Main content -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader"> 
                        <h2>I-RIDE BOOKINGS</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>CSR NAME</th>
                                <th>SAME-DAY HATID</th>
                                <th>SAME-DAY DELIVERY</th>
                                <th>PET-TRANSPO</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection parameters
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "iride_database";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch CSR details from the database
                            $sql = "SELECT csr_name, same_day_hatid, same_day_delivery, pet_transpo FROM csr_details";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $total = $row["same_day_hatid"] + $row["same_day_delivery"] + $row["pet_transpo"];
                                    echo '<tr>
                                            <td>' . $row["csr_name"] . '</td>
                                            <td>' . $row["same_day_hatid"] . '</td>
                                            <td>' . $row["same_day_delivery"] . '</td>
                                            <td>' . $row["pet_transpo"] . '</td>
                                            <td>' . $total . '</td>
                                        </tr>';
                                        
                                }
                            } else {
                                echo '<tr><td colspan="5">No CSR details found</td></tr>';
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
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
