<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Ride Navigation</title>
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/booking.css">

    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        }

        function updateDate() {
            const dateElement = document.getElementById('current-date');
            const currentDate = new Date().toLocaleDateString();
            dateElement.textContent = currentDate;
        }

        window.onload = updateDate;

        function openBookingForm() {
            document.getElementById('bookingForm').style.display = 'block';
            document.getElementById('newBooking_id').value = Math.floor(Math.random() * 1000000); // Generate a random booking number
        }

        function closeBookingForm() {
            document.getElementById('bookingForm').style.display = 'none';
        }

        function confirmBooking() {
            const confirmation = confirm("Do you want to continue the process of adding this booking?");
            if (confirmation) {
                document.getElementById('booking-form').submit(); // Submit the form if confirmed
            }
        }

        function searchBookings() {
            const input = document.getElementById("search-bar").value.toUpperCase();
            const table = document.getElementById("booking-table");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const tdArray = tr[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < tdArray.length; j++) {
                    const td = tdArray[j];
                    if (td) {
                        let textValue = td.textContent || td.innerText;
                        if (textValue.toUpperCase().indexOf(input) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = match ? "" : "none";
            }
        }
    </script>
</head>

<body>
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
                    <a href="Super_admin_dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
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
                    <a href="t&c.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">T&C</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <br><br>
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

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <img src="assets/imgs/customer01.jpg" alt="User Profile">
            </div>
        </div>

        <h1 class="completed-bookings-heading" style="color: red; text-align: center;">BOOKINGS</h1>
        <h2 id="current-date" style="text-align: center;"></h2>

        <?php
        // Database connection
        $host = "localhost";
        $dbname = "i-ride system";
        $username = "root";
        $password = "";

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect POST data from form
            $booking_id = $_POST['booking_id'];
            $booking_type = $_POST['booking_type'];
            $booking_detail = $_POST['booking_detail'];
            $fare = $_POST['fare'];
            $comment = $_POST['comment'];

            // SQL query to insert booking into database_
            $sql = "INSERT INTO bookings (booking_id, booking_type, booking_detail, fare, comment)
                    VALUES ('$booking_id', '$booking_type', '$booking_detail', '$fare', '$comment')";

            // Execute query and handle result
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Booking added successfully!'); window.location.href='bookings.php';</script>";
            } else {
                echo "<script>alert('Error: Unable to add booking');</script>";
            }
        }
        ?>

        <h1 style="text-align: center;">Bookings Dashboard</h1>

        <!-- Button to open the form modal -->
        <div class="add-booking-btn-container">
            <button onclick="openBookingForm()">Add Booking</button>
        </div>

        <!-- Table displaying current bookings -->
        <table id="booking-table">
            <thead>
                <tr>
                    <th>Booking No.</th>
                    <th>Booking Type</th>
                    <th>Booking Details</th>
                    <th>Fare</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM bookings");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = '';
                        switch ($row['status']) {
                            case 'Pending':
                                $statusClass = 'pending-status';
                                break;
                            case 'Confirmed':
                                $statusClass = 'confirmed-status';
                                break;
                            case 'Completed':
                                $statusClass = 'completed-status';
                                break;
                            case 'Cancelled':
                                $statusClass = 'cancelled-status';
                                break;
                        }

                        echo "<tr>
                        <td>{$row['booking_id']}</td>
                        <td>{$row['booking_type']}</td>
                        <td>{$row['booking_detail']}</td>
                        <td>₱{$row['fare']}</td>
                        <td>{$row['comment']}</td>
                        <td class='{$statusClass}'>{$row['status']}</td>
                        <td>
                            <button class='view-btn' onclick=\"viewBooking({$row['booking_id']})\">View</button>
                            <button class='edit-btn' 
                                onclick=\"openEditBookingForm(
                                    '{$row['booking_id']}', 
                                    '{$row['booking_type']}', 
                                    '{$row['booking_detail']}', 
                                    '{$row['fare']}', 
                                    '{$row['comment']}'
                                )\">Edit</button>
                            <button class='delete-btn' onclick=\"deleteBooking({$row['booking_id']})\">Delete</button>
                        </td>
                    </tr>";
                

                    }}
                ?>
            </tbody>
        </table>


        
       <!-- Modal for booking form -->
<div id="bookingForm" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeBookingForm()">&times;</span>
        <h2>Add New Booking</h2>
        <form id="booking-form" method="POST">
            <label for="booking_id">Booking No.</label>
            <input type="text" name="booking_id" id="booking_id" readonly>

            <label for="booking_type">Booking Type</label>
            <select name="booking_type" required>
                <option value="SAME-DAY-DELIVERY">SAME-DAY-DELIVERY</option>
                <option value="SAME-DAY-HATID">SAME-DAY-HATID</option>
                <option value="PET-TRANSPORTATION">PET-TRANSPORTATION</option>
            </select>

            <label for="booking_detail">Booking Details</label>
            <textarea name="booking_detail" required></textarea>

            <label for="fare">Booking Fare</label>
            <input type="number" name="fare" required>

            <label for="comment">Comment</label>
            <textarea name="comment"></textarea>

            <button type="button" onclick="confirmBooking()">Confirm</button>
            <button type="button" onclick="closeBookingForm()">Cancel</button>
        </form>
    </div>
</div>




<!-- Modal for editing booking form -->
<div id="editBookingForm" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditBookingForm()">&times;</span>
        <h2>Edit Booking</h2>
        <form id="edit-booking-form" method="POST" action="booking_edit.php">
            <label for="edit_booking_id">Booking No.</label>
            <input type="text" name="edit_booking_id" id="edit_booking_id" readonly>

            <label for="edit_booking_type">Booking Type</label>
            <select name="edit_booking_type" id="edit_booking_type" required>
                <option value="SAME-DAY-DELIVERY">SAME-DAY-DELIVERY</option>
                <option value="SAME-DAY-HATID">SAME-DAY-HATID</option>
                <option value="PET-TRANSPORTATION">PET-TRANSPORTATION</option>
            </select>

            <label for="edit_booking_detail">Booking Details</label>
            <textarea name="edit_booking_detail" id="edit_booking_detail" required></textarea>

            <label for="edit_fare">Booking Fare</label>
            <input type="number" name="edit_fare" id="edit_fare" required>

            <label for="edit_comment">Comment</label>
            <textarea name="edit_comment" id="edit_comment"></textarea>

            <button type="button" onclick="confirmEditBooking()">Update</button>
            <button type="button" onclick="closeEditBookingForm()">Cancel</button>
        </form>
    </div>
</div>



        <script>
            function viewBooking(bookingId) {
                // Logic to view booking details
                window.location.href = 'booking_view.php?id=' + bookingId;
            }

         

            function deleteBooking(bookingId) {
                if (confirm("Are you sure you want to delete this booking?")) {
                    // Logic to delete the booking
                    window.location.href = 'booking_delete.php?id=' + bookingId;
                }
            }

            function openEditBookingForm(bookingId, bookingType, bookingDetail, fare, comment) {
    document.getElementById('editBookingForm').style.display = 'block';
    document.getElementById('edit_booking_id').value = bookingId;
    document.getElementById('edit_booking_type').value = bookingType;
    document.getElementById('edit_booking_detail').value = bookingDetail;
    document.getElementById('edit_fare').value = fare;
    document.getElementById('edit_comment').value = comment;
}

function closeEditBookingForm() {
    document.getElementById('editBookingForm').style.display = 'none';
}

function confirmEditBooking() {
    const confirmation = confirm("Do you want to save the changes?");
    if (confirmation) {
        document.getElementById('edit-booking-form').submit(); // Submit the form if confirmed
    }
}
function confirmEditBooking() {
    const confirmation = confirm("Do you want to save the changes?");
    if (confirmation) {
        // Submit the form and redirect on success
        const form = document.getElementById('edit-booking-form');

        // Create a FormData object to handle the form submission
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert('Booking updated successfully!'); // Alert for success
            window.location.href = 'bookings.php'; // Redirect to bookings page
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error updating the booking.');
        });
    }
}


        </script>
         <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>
</html>
