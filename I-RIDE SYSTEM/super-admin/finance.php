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

                <li class="active">
                    <a href="#">
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
                    <a href="t&c.php">
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

            <!-- ======================= Cards ================== -->
            <h1 class="completed-bookings-heading" style="color: red; text-align: center;">FINANCES</h1>     
            
            <br>
            <br>
            <br>
            <br>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                      
                        
                    </div>

                    <table>
                        
                            <tr>
                                <td>RIDER'S NAME</td>
                                <td>RIDER'S DELIVERY</td>
                                <td>COMMISION</td>
                                <td>I-RIDE INCOME</td>
                                <td>TOTAL INCOME</td>
                                
                            </tr>
                        

                        <tbody>
                            <tr>
                                <td>John Paulo Venturina</td>
                                <td>270</td>
                                <td>10%</td>
                                <td>27</td>
                                
                            </tr>

                            <tr>
                                <td>John Paulo Venturina</td>
                                <td>270</td>
                                <td>10%</td>
                                <td>27</td>
                              
                            </tr>

                            <tr>
                            <td>John Paulo Venturina</td>
                                <td>270</td>
                                <td>10%</td>
                                <td>27</td>
                                <td>135<td>
                                
                            </tr>

                            <tr>
                            <td>John Paulo Venturina</td>
                                <td>270</td>
                                <td>10%</td>
                                <td>27</td>
                            
                            </tr>

                            <tr>
                            <td>John Paulo Venturina</td>
                                <td>270</td>
                                <td>10%</td>
                                <td>27</td>
                               
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