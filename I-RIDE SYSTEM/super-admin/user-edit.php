<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>edit</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: rgb(156,131,33);
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }
    </style>
    <script>
        function showEditedValues() {
            var fullname = document.querySelector('input[fullname="fullname"]').value;
            var email = document.querySelector('input[fullname="email"]').value;
            var address = document.querySelector('input[fullname="address"]').value;
            var mobile = document.querySelector('input[fullname="mobile"]').value;
            var username = document.querySelector('input[fullname="username"]').value;
            var password = document.querySelector('input[fullname="password"]').value;

            var message = `
                <p><strong>Name:</strong> ${fullname}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Address:</strong> ${address}</p>
                <p><strong>Mobile:</strong> ${mobile}</p>
                <p><strong>Username:</strong> ${username}</p>
                <p><strong>Password:</strong> ${password}</p>
            `;

            document.getElementById('editedValuesContent').innerHTML = message;
            $('#editedValuesModal').modal('show');

            return false; // Prevent form submission for now
        }

        function submitForm() {
            var form = document.getElementById('editForm');
            form.action = 'user.php'; // Redirect to user.php after form submission
            form.submit();
        }
    </script>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "i-ride system");

    if (!$con) {
        die('Connection Failed: ' . mysqli_connect_error());
    }

    // Fetch user data for update
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $update = "SELECT * FROM users WHERE user_id = $id";
    $updatequery = mysqli_query($con, $update);

    if (!$updatequery) {
        die('Query Failed: ' . mysqli_error($con));
    }

    $result = mysqli_fetch_assoc($updatequery);

    if (!$result) {
        die('User not found');
    }

    if (isset($_POST['submit'])) {
        $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $updatequery = "UPDATE users SET 
                        fullname ='$fullname', 
                        email ='$email', 
                        address ='$address', 
                        mobile='$mobile', 
                        username='$username', 
                        password='$password' 
                        WHERE user_id = $id";

        if (mysqli_query($con, $updatequery)) {
            echo "<script>alert('Data has been successfully updated');</script>";
            echo "<script>window.location.replace('user.php');</script>";
        } else {
            echo 'Not Updated: ' . mysqli_error($con);
        }
    }

    mysqli_close($con);
    ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" id="editForm" onsubmit="return showEditedValues();">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data</h4>
                    <a href="user.php" class="close" aria-hidden="true">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($result['fullname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($result['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($result['address']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="<?php echo htmlspecialchars($result['mobile']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($result['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($result['password']); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="user.php" class="btn btn-default" onclick="return confirm('Are you sure you want to cancel? Any unsaved changes will be lost.');">Cancel</a>
                    <input type="submit" name="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>

    <!-- Edited Values Modal HTML -->
    <div id="editedValuesModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edited Values</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="editedValuesContent">
                    <!-- Populated by JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info" onclick="submitForm();">Confirm Save</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
