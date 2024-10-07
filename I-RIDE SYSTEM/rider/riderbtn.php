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

        function goBack() {
            window.history.back();
        }

        // Toggle Rider Account Form
        function toggleRiderForm() {
            const form = document.getElementById('riderForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        // Populate Form with Rider Data
        function populateForm(data) {
            document.getElementById('firstname').value = data.firstname || '';
            document.getElementById('lastname').value = data.lastname || '';
            document.getElementById('age').value = data.age || '';
            document.getElementById('address').value = data.address || '';
            document.getElementById('mobile').value = data.mobile || '';
            document.getElementById('moto').value = data.moto || '';
            document.getElementById('orcr').value = data.orcr || '';
            document.getElementById('license').value = data.license || '';
            document.getElementById('insurance').value = data.insurance || '';
            document.getElementById('username').value = data.username || '';
            document.getElementById('password').value = data.password || '';
            document.getElementById('comment').value = data.comment || '';
        }

        // Handle "Update Rider Account" Click
        function handleUpdateClick() {
            // Sample data - in a real application, this data would come from a database or API
            const riderData = {
                firstname: 'John',
                lastname: 'Doe',
                age: 30,
                address: '123 Main St',
                mobile: '555-1234',
                moto: 'Honda CB500',
                orcr: '12345',
                license: 'D1234567',
                insurance: 'ABC Insurance',
                username: 'johndoe',
                password: 'password123',
                comment: 'No comments'
            };

            // Show the form and populate it with data
            document.getElementById('riderForm').style.display = 'block';
            populateForm(riderData);
        }

        // Handle "Search Rider Account" Click
        function handleSearchClick() {
            document.getElementById('searchResults').style.display = 'block';
        }

        function closeSearchResults() {
            document.getElementById('searchResults').style.display = 'none';
        }

        // Sample rider data for demonstration
        const riders = [
            { username: 'johndoe', riderId: 'R001', mobile: '555-1234', status: 'Active' },
            { username: 'janedoe', riderId: 'R002', mobile: '555-5678', status: 'Blocked' },
            // Add more riders as needed
        ];

        function searchRiders() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const filteredRiders = riders.filter(rider =>
                rider.username.toLowerCase().includes(input) ||
                rider.mobile.includes(input)
            );
            renderRiderList(filteredRiders);
        }

        function renderRiderList(riders) {
            const tableBody = document.getElementById('riderList');
            tableBody.innerHTML = ''; // Clear previous results

            riders.forEach(rider => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${rider.username}</td>
                    <td>${rider.riderId}</td>
                    <td>${rider.mobile}</td>
                    <td>${rider.status}</td>
                    <td class="action-buttons">
                        <button class="${rider.status === 'Active' ? 'block-button' : 'unblock-button'}" onclick="toggleStatus('${rider.username}')">
                            ${rider.status === 'Active' ? 'Block' : 'Unblock'}
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function toggleStatus(username) {
            const rider = riders.find(r => r.username === username);
            if (rider) {
                rider.status = rider.status === 'Active' ? 'Blocked' : 'Active';
                searchRiders(); // Refresh the list
            }
        }
    </script>
    <style>
        .profile-container {
            background-color: #f94343;
            color: #fff;
            padding: 20px;
            margin: 20px auto;
            width: 60%;
            border-radius: 10px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-section {
            background-color: #fff;
            color: #000;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
        }

        .profile-buttons {
            display: flex;
            justify-content: space-between;
        }

        .profile-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-button {
            background-color: #333;
            color: #fff;
            border: none;
        }

        .info-button {
            background-color: black;
            color: #fff;
            border: none;
        }

        .account-actions {
            margin-top: 20px;
        }

        .account-actions {
            display: flex;
            justify-content: space-between;
        }

        .account-actions-column {
            flex-basis: 48%;
        }

        .account-actions ul {
            list-style: none;
            padding: 0;
        }

        .account-actions li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .account-actions li button {
            background-color: #fdc5b8;
            color: black;
            padding: 15px 15px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            flex-grow: 1;
            display: flex;
            align-items: center;
        }

        .account-actions li button:hover {
            background-color: #0056b3;
        }

        .account-actions li button ion-icon {
            margin-right: 10px;
        }

        /* Form Styling */
        #riderForm {
            display: none;
            background-color: #ffff;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #fff;
            margin-top: 20px;
        }

        #riderForm label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        #riderForm input,
        #riderForm textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        #riderForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #riderForm button:hover {
            background-color: #0056b3;
        }

        /* Search Results Styling */
        #searchResults {
            display: none;
            
            padding: 20px;
            border-radius: 10px;
            border: 4px solid black;
            margin-top: 20px;
        }

        #searchResults h2 {
            margin-top: 0;
        }

        #searchResults table {
            width: 100%;
            border-collapse: collapse;
        }

        #searchResults table th,
        #searchResults table td {
            padding: 20px;
            text-align: left;
            border: 11px solid black;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .block-button {
            background-color: #f44336;
            color: white;
        }

        .unblock-button {
            background-color: #4caf50;
            color: white;
        }

        .block-button:hover {
            background-color: #c62828;
        }

        .unblock-button:hover {
            background-color: black;
        }
        #searchResults table th {
    background-color: black;
    color: white;
    padding: 10px;
    text-align: left;
}
/* Styling for the search bar */
#searchResults input[type="text"] {
    width: 90%;
    height: 40px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    font-size: 16px;
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
                    <a href="general-admin-dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
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
                <li class="active">
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

            <!-- ======================= Rider's Profile ================== -->
            <div class="profile-container">
                <div class="profile-header">
                    <h1>RIDER'S ACCOUNT SETTINGS</h1>
                </div>

                <!-- Additional Rider Actions -->
                <div class="account-actions">
                    <!-- Column 1 -->
                    <div class="account-actions-column">
                        <ul>
                            <li>
                                <button onclick="toggleRiderForm()">
                                    <ion-icon name="add-circle-outline"></ion-icon> Create Rider Account
                                </button>
                            </li>
                            <li>
                                <button onclick="handleUpdateClick()">
                                    <ion-icon name="pencil-outline"></ion-icon> Update Rider Account
                                </button>
                            </li>
                            <li>
                                <button onclick="handleSearchClick()">
                                    <ion-icon name="search-outline"></ion-icon> Search Rider Account
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Column 2 -->
                    <div class="account-actions-column">
                        <ul>
                            <li>
                                <button>
                                    <ion-icon name="ban-outline"></ion-icon> Block Rider Account
                                </button>
                            </li>
                            <li>
                                <button>
                                    <ion-icon name="trash-outline"></ion-icon> Delete Rider Account
                                </button>
                            </li>
                            <li>
                                <button>
                                    <ion-icon name="document-text-outline"></ion-icon> Generate Report
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Rider Form (Hidden by Default) -->
                <form id="riderForm">
                    <h2>Create or Update Rider Account</h2>

                    <div>
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>

                    <div>
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>

                    <div>
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" required>
                    </div>

                    <div>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div>
                        <label for="mobile">Mobile Number</label>
                        <input type="text" id="mobile" name="mobile" required>
                    </div>

                    <div>
                        <label for="moto">Moto Details</label>
                        <input type="text" id="moto" name="moto" required>
                    </div>

                    <div>
                        <label for="orcr">OR/CR</label>
                        <input type="text" id="orcr" name="orcr" required>
                    </div>

                    <div>
                        <label for="license">Driver's License</label>
                        <input type="text" id="license" name="license" required>
                    </div>

                    <div>
                        <label for="insurance">Insurance</label>
                        <input type="text" id="insurance" name="insurance" required>
                    </div>

                    <div>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div>
                        <label for="comment">Comment</label>
                        <textarea id="comment" name="comment"></textarea>
                    </div>

                    <button type="submit">Submit</button>
                </form>

                <!-- Search Results Section -->
                <div id="searchResults">
                    <h2>Search Results</h2>
                    <input type="text" id="searchInput" placeholder="Search by username or mobile number" onkeyup="searchRiders()">
                    <button onclick="closeSearchResults()">Close</button>
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Rider ID</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="riderList">
                            <!-- Rider data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =============== Ionicons ================ -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
