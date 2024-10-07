<?php
session_start();

if (!isset($_SESSION['rider_id'])) {
    header("Location: riderlogin.php");
    exit;
}

$host = "localhost";
$dbname = "i-ride system";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rider_id = $_SESSION['rider_id'];

// Check if the rider exists in the Riders table
$sql_rider_check = "SELECT * FROM riders WHERE rider_id = ?";
$stmt_rider_check = $conn->prepare($sql_rider_check);
$stmt_rider_check->bind_param("i", $rider_id);
$stmt_rider_check->execute();
$result_rider_check = $stmt_rider_check->get_result();

if ($result_rider_check->num_rows === 0) {
    echo "Error: Rider does not exist.";
    exit;
}

// Debug: Print rider_id to check if session value is correct
var_dump($rider_id);

// Check if the rider already has an ongoing booking
$sql_check = "SELECT * FROM Bookings WHERE rider_id = ? AND status = 'confirmed'";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $rider_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "You already have an ongoing booking. Please complete it before accepting a new one.";
} else {
    // Check if a booking has been accepted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];

        // Update the booking to mark it as accepted
        $sql_update = "UPDATE Bookings SET rider_id = ?, status = 'confirmed' WHERE booking_id = ? AND status = 'pending'";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $rider_id, $booking_id);

        if ($stmt_update->execute()) {
            echo "Booking accepted successfully.";
        } else {
            echo "Error: " . $stmt_update->error;
        }
    }

    // Retrieve all bookings that have not been accepted
    $sql = "SELECT * FROM Bookings WHERE status = 'pending'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form method='POST'>";
        echo "<table border='1'>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Booking Type</th>
                    <th>Booking Detail</th>
                    <th>Fare</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><input type='radio' name='booking_id' value='" . $row["booking_id"] . "' required></td>
                    <td>" . $row["booking_id"] . "</td>
                    <td>" . $row["booking_type"] . "</td>
                    <td>" . $row["booking_detail"] . "</td>
                    <td>" . $row["fare"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<input type='submit' value='Accept Booking'>";
        echo "</form>";
    } else {
        echo "No bookings available for acceptance.";
    }
}
?>