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
                <li class="">
                    <a href="riders-profile-dashboard.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>
                <li class="active">
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
                    <img src="assets/imgs/user.jpg" alt="">
                </div>
            </div>
<h1 class="completed-bookings-heading" style="color: red; text-align: center;">TERMS & CONDITIONS</h1>
                    
                <!-- Terms and Conditions -->

                    <div class="terms">
            <h2>Welcome to I-Ride! Please read these terms carefully before using our services.</h2>
          

            <h3>1. Usage Agreement</h3>
            <p>By accessing or using our services, you agree to abide by these terms and conditions.</p>

            <h3>2. Privacy Policy</h3>
            <p>We value your privacy. Our <a href="privacy-policy.html">Privacy Policy</a> outlines how we collect, use, and protect your personal information.</p>

            <h3>3. Service Limitations</h3>
            <p>We provide our services "as is" and disclaim any warranties or guarantees regarding their suitability or reliability for your purposes.</p>

            <h3>4. Acceptance of Terms</h3>
            <p>Your continued use of our services constitutes your acceptance of these terms and any future modifications.</p>

            <h3>5. Contact Us</h3>
            <p>If you have any questions or concerns about these terms, please contact us at <a href="mailto:info@i-ride.com">info@i-ride.com</a>.</p>
       
        </div>

        <button class="copy-btn" onclick="copyTerms()">Copy</button>

            </div>	
    
 <!-- =========== Scripts =========  -->
 <script src="assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    function copyTerms() {
        const termsContent = document.querySelector('.terms').innerText;
        navigator.clipboard.writeText(termsContent).then(function () {
            alert('Terms & Conditions copied to clipboard!');
        }).catch(function (err) {
            console.error('Unable to copy: ', err);
            alert('Copy failed. Please try again.');
        });
    }
</script>
</body>

</html>