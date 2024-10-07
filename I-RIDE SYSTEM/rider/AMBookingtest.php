<?php
$host = "localhost";
$dbname = "i-ride system";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle booking creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_booking'])) {
    $booking_type = $_POST['booking_type'];
    $booking_detail = $_POST['booking_detail'];

    $sql = "INSERT INTO Bookings (booking_type, booking_detail, fare, status) VALUES (?, ?, 0.00(), 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $booking_type, $booking_detail);

    if ($stmt->execute()) {
        echo "Booking created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle marking a booking as completed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['complete_booking_id'])) {
    $booking_id = $_POST['complete_booking_id'];

    $sql = "UPDATE Bookings SET status = 'completed' WHERE booking_id = ? AND status = 'confirmed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        echo "Booking marked as completed.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Retrieve all bookings
$sql = "SELECT Bookings.*, Bookings.rider_id FROM Bookings LEFT JOIN Riders ON Bookings.rider_id = Riders.rider_id";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<h2>Create a New Booking</h2>
<form method="POST">
    Booking Type: <input type="text" name="booking_type" required><br>
    Booking Detail: <input type="text" name="booking_detail" required><br>
    <input type="submit" name="create_booking" value="Create Booking">
</form>

<h2>All Bookings</h2>
<?php
if ($result->num_rows > 0) {
    echo "<form method='POST'>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Booking Type</th>
                <th>Booking Detail</th>
                <th>Fare</th>
                <th>Status</th>
                <th>Rider</th>
                <th>Action</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["booking_id"] . "</td>
                <td>" . $row["booking_type"] . "</td>
                <td>" . $row["booking_detail"] . "</td>
                <td>" . $row["fare"] . "</td>
                <td>" . $row["status"] . "</td>
                <td>" . ($row["rider_name"] ? $row["rider_name"] : "N/A") . "</td>
                <td>";
        if ($row["status"] == "confirmed") {
            echo "<button type='submit' name='complete_booking_id' value='" . $row["booking_id"] . "'>Mark as Completed</button>";
        } else {
            echo "N/A";
        }
        echo "</td>
            </tr>";
    }
    echo "</table>";
    echo "</form>";
} else {
    echo "No bookings found.";
}
?>