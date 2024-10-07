<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-RIDE DASHBOARD</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rdrbooking.css">
    <!-- Link to Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        }

     
    </script>
</head>

<body>
    <?php
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Database connection
    $host = "localhost";
    $dbname = "i-ride system";
    $username = "root";
    $password = "";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("<script>alert('Connection failed: " . $conn->connect_error . "');</script>");
    }

    // Handle form submission for adding a new booking
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBooking'])) {
        $bookingNumber = $_POST['bookingNumber'];
        $bookingType = $_POST['bookingType'];
        $bookingDetails = $_POST['bookingDetails'];
        $bookingFare = $_POST['bookingFare'];
        $riderName = $_POST['riderName'];
        $csrName = $_POST['csrName'];
        $comment = $_POST['comment'];

        // Prepare and bind to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO bookings (booking_number, booking_type, booking_details, booking_fare, rider_name, csr_name, comment) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $bookingNumber, $bookingType, $bookingDetails, $bookingFare, $riderName, $csrName, $comment);

        if ($stmt->execute()) {
            echo "<script>alert('Booking added successfully!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to add booking');</script>";
        }

        $stmt->close();
    }
    ?>

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
                    <a href="dashboard.php">
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
                <img src="assets/imgs/customer01.jpg" alt="User Profile">
            </div>
        </div>

        <!-- ======================= Booking Details Section ================== -->
        <h1 class="completed-bookings-heading">
            <ion-icon name="list-outline"></ion-icon> Active Booking List
        </h1>
        <h2 id="current-date" style="text-align: center; color: red;">BOOKINGS</h2>

        <div class="button-container">
            <button class="refresh-button" onclick="displayCompletedBooking();">
                <i class="fas fa-sync-alt refresh-icon"></i> Refresh
            </button>
        </div>

        <!-- Search Bar -->
        <input type="text" id="search-bar" onkeyup="searchBookings()" placeholder="Search for bookings..">

        <!-- Table displaying current bookings -->
        <div class="search-results">
            <table id="booking-table">
                <thead>
                    <tr>
                        <th>Booking Type</th>
                        <th>Booking Details</th>
                        <th>Fare</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM bookings ORDER BY booking_id DESC");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['booking_type']}</td>
                                    <td>{$row['booking_detail']}</td>
                                    <td>₱{$row['fare']}</td>
                                    <td>
                                        <button class='view-button' onclick='viewBooking(this);'>View</button>
                                        <button class='accept-button' onclick='acceptBooking(this, {$row['booking_id']});'>Accept</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No bookings found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script>
        function displayCompletedBooking() {
            fetch('URL_TO_FETCH_BOOKINGS') // Specify the URL to fetch booking data
                .then(response => response.json())
                .then(data => {
                    const bookingList = document.getElementById('bookingList'); // Make sure you have a container with this ID
                    bookingList.innerHTML = ''; // Clear existing bookings
                    data.forEach(booking => {
                        const bookingElement = document.createElement('div');
                        bookingElement.textContent = `Booking ID: ${booking.id}, Status: ${booking.status}`;
                        bookingList.appendChild(bookingElement);
                    });
                })
                .catch(error => console.error('Error fetching bookings:', error));
        }

        function viewBooking(button) {
            const bookingContainer = button.closest('tr');
            alert("View details functionality is not implemented yet.");
        }

        function confirmBooking() {
            const confirmation = confirm("Do you want to continue the process of adding this booking?");
            if (confirmation) {
                document.getElementById('booking-form').submit(); // Submit the form if confirmed
            }
        }

        // Search functionality for all columns
        function searchBookings() {
            const input = document.getElementById("search-bar").value.toUpperCase();
            const table = document.getElementById("booking-table");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const tdArray = tr[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < tdArray.length; j++) {
                    const textValue = tdArray[j].textContent || tdArray[j].innerText;
                    if (textValue.toUpperCase().indexOf(input) > -1) {
                        match = true;
                        break;
                    }
                }
                tr[i].style.display = match ? "" : "none"; // Show/hide rows
            }
        }
        function acceptBooking(button, bookingId) {
    if (confirm("Are you sure you want to accept this booking?")) {
        // Remove the corresponding row from the table
        const row = button.closest('tr'); // Find the closest table row
        row.remove(); // Remove the row from the table

        alert("Booking " + bookingId + " accepted."); // Placeholder for actual implementation
        // You can refresh the booking list here if needed
    }
}

    </script>

        
    </script>
      <!-- ====== ionicons ======= -->
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
