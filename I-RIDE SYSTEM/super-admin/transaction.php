<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beta-i-ride";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch transactions
$sql = "SELECT transaction_id, date, type, total_fare FROM transactions";
$result = $conn->query($sql);

// Arrays to hold different types of transactions
$samedayhatid = [];
$samedaydelivery = [];
$samedaypet = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        switch ($row["type"]) {
            case 'samedayhatid':
                $samedayhatid[] = $row;
                break;
            case 'samedaydelivery':
                $samedaydelivery[] = $row;
                break;
            case 'samedaypet':
                $samedaypet[] = $row;
                break;
        }
    }
}

$conn->close();
?>
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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .transactions-column {
            width: 30%;
            float: left;
            margin-right: 3%;
        }

        .transactions-column:last-child {
            margin-right: 0;
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
                <li class="active">
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
                    <a href="#">
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

        <button class="top-left" onclick="window.history.back();">Back</button>
        <h1 class="completed-bookings-heading" style="color: red; text-align: center;">TRANSACTION HISTORY</h1>
        <br><br><br>

        <div class="transactions-column">
            <h2>Sameday Hatid</h2>
            <table>
                <thead>
                    <tr>
                        <th>TRANSACTION ID</th>
                        <th>DATE</th>
                        <th>TYPE</th>
                        <th>TOTAL FARE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($samedayhatid) > 0) {
                        foreach ($samedayhatid as $transaction) {
                            echo '<tr>
                                    <td>' . $transaction["transaction_id"] . '</td>
                                    <td>' . $transaction["date"] . '</td>
                                    <td>' . $transaction["type"] . '</td>
                                    <td>' . $transaction["total_fare"] . '</td>
                                </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">No Transactions found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="transactions-column">
            <h2>Sameday Delivery</h2>
            <table>
                <thead>
                    <tr>
                        <th>TRANSACTION ID</th>
                        <th>DATE</th>
                        <th>TYPE</th>
                        <th>TOTAL FARE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($samedaydelivery) > 0) {
                        foreach ($samedaydelivery as $transaction) {
                            echo '<tr>
                                    <td>' . $transaction["transaction_id"] . '</td>
                                    <td>' . $transaction["date"] . '</td>
                                    <td>' . $transaction["type"] . '</td>
                                    <td>' . $transaction["total_fare"] . '</td>
                                </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">No Transactions found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="transactions-column">
            <h2>Sameday Pet Transpo</h2>
            <table>
                <thead>
                    <tr>
                        <th>TRANSACTION ID</th>
                        <th>DATE</th>
                        <th>TYPE</th>
                        <th>TOTAL FARE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($samedaypet) > 0) {
                        foreach ($samedaypet as $transaction) {
                            echo '<tr>
                                    <td>' . $transaction["transaction_id"] . '</td>
                                    <td>' . $transaction["date"] . '</td>
                                    <td>' . $transaction["type"] . '</td>
                                    <td>' . $transaction["total_fare"] . '</td>
                                </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">No Transactions found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======= Scripts ====== -->
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script>
        // JavaScript to toggle the navigation menu
        document.querySelector('.toggle').addEventListener('click', function () {
            document.querySelector('.navigation').classList.toggle('hidden');
            document.querySelector('.main').classList.toggle('full-width');
        });
    </script>
</body>

</html>
