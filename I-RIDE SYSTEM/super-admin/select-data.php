<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "i-ride system");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Get the role filter from POST request
$catname = isset($_POST['cat_name']) ? mysqli_real_escape_string($con, $_POST['cat_name']) : 'All';

// Determine the condition for the SQL query
$cond = $catname != 'All' ? $catname : '%';

// Prepare the SQL query with placeholders
$query = "SELECT * FROM users WHERE role LIKE ? AND deleted_at IS NULL";
$stmt = $con->prepare($query);

if (!$stmt) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}

// Bind the parameter to the placeholder
$stmt->bind_param('s', $cond);

// Execute the prepared statement
$stmt->execute();

// Get the result set
$fetch_query = $stmt->get_result();

// Get the number of rows
$row_count = $fetch_query->num_rows;

if ($row_count > 0) { 
    while ($res = $fetch_query->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($res['user_id']) . '</td>';
        echo '<td>' . htmlspecialchars($res['fullname']) . '</td>';
        echo '<td>' . htmlspecialchars($res['email']) . '</td>';
        echo '<td>' . htmlspecialchars($res['mobile']) . '</td>';
        echo '<td>' . htmlspecialchars($res['address']) . '</td>';
        echo '<td>' . htmlspecialchars($res['role']) . '</td>';
        
        // Button to toggle status
        echo '<td>';
        echo '<form action="code.php" method="POST" class="d-inline" onsubmit="return confirmActivationDeactivation(this);">';
        if ($res['status'] == 'active') {
            echo '<button type="submit" name="deactivate_user" value="' . htmlspecialchars($res['user_id']) . '" class="btn btn-warning btn-sm">Deactivate</button>';
        } else {
            echo '<button type="submit" name="activate_user" value="' . htmlspecialchars($res['user_id']) . '" class="btn btn-primary btn-sm">Activate</button>';
        }
        echo '</form>';
        echo '</td>';
        
    // Actions: View, Edit, Delete
echo '<td>';
echo '<a href="user-view.php?id=' . htmlspecialchars($res['user_id']) . '" class="btn btn-info btn-sm">View</a>'; 
echo '<a href="user-edit.php?id=' . htmlspecialchars($res['user_id']) . '" class="btn btn-success btn-sm">Edit</a>'; 
echo '<form action="coded.php" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">';
echo '<button type="submit" name="delete_user" value="' . htmlspecialchars($res['user_id']) . '" class="btn btn-danger btn-sm">Delete</button>';
echo '</form>';
echo '</td>';

        
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No records found</td></tr>'; 
}

// Close the statement and the database connection
$stmt->close();
mysqli_close($con);
?>

<script>
function confirmActivationDeactivation(form) {
    var message = form.querySelector('button[name="deactivate_user"]') ? 'Are you sure you want to deactivate this user?' : 'Are you sure you want to activate this user?';
    return confirm(message);
}
</script>