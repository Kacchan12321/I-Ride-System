<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "i-ride system");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Prepare the query
$fetch_query = "SELECT * FROM users WHERE deleted_at IS NULL";
$result = mysqli_query($con, $fetch_query);

if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$row_count = mysqli_num_rows($result);

if ($row_count > 0) { 
    while ($res = mysqli_fetch_assoc($result)) {
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

mysqli_close($con);
?>
<script>
function confirmActivationDeactivation(form) {
    var message = form.querySelector('button[name="deactivate_user"]') ? 'Are you sure you want to deactivate this user?' : 'Are you sure you want to activate this user?';
    return confirm(message);
}
</script>