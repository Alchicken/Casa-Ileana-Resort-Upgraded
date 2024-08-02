<?php
include('./conn/conn.php'); // Include database connection

session_start();

// Check if user is not authenticated (no session user_id set)
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/user-registration-and-login-system/login.php");
    exit();
}

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM `tbl_user`");
$stmt->execute();
$result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration and Reservation Management</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ml-5" href="home.php">User Registration and Login System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.php">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="modal fade mt-5" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateUserForm" action="./endpoint/update-user.php" method="POST">
                        <input type="hidden" name="tbl_user_id" id="updateUserID">
                        <div class="form-group row">
                            <div class="col">
                                <label for="updateFirstName">First Name:</label>
                                <input type="text" class="form-control" id="updateFirstName" name="first_name">
                            </div>
                            <div class="col">
                                <label for="updateLastName">Last Name:</label>
                                <input type="text" class="form-control" id="updateLastName" name="last_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="updateContactNumber">Contact Number:</label>
                                <input type="text" class="form-control" id="updateContactNumber" name="contact_number" maxlength="11">
                            </div>
                            <div class="col">
                                <label for="updateEmail">Email:</label>
                                <input type="email" class="form-control" id="updateEmail" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateUsername">Username:</label>
                            <input type="text" class="form-control" id="updateUsername" name="username">
                        </div>
                        <div class="form-group">
                            <label for="updatePassword">Password:</label>
                            <input type="password" class="form-control" id="updatePassword" name="password">
                        </div>
                        <button type="submit" class="btn btn-dark form-control">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 mt-3 ml-5 bg-transparent">
                <button class="btn btn-primary mr-2" onclick="showListUsersTable()">List of Users</button>
                <button class="btn btn-primary" onclick="showListReserveTable()">List of Reservations</button>
                <button class="btn btn-primary" onclick="showListFeedbackTable()">Customers Feedback</button>
    </div>

    <div class="list-users ml-5" id="usersTable" style="margin-top: 5%;">
        <div class="content">
            <h4>List of users</h4>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= $row['tbl_user_id'] ?></td>
                            <td><?= $row['first_name'] ?></td>
                            <td><?= $row['last_name'] ?></td>
                            <td><?= $row['contact_number'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="update_user(<?= $row['tbl_user_id'] ?>)">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="delete_user(<?= $row['tbl_user_id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Update user function
        function update_user(id) {
            let user = <?= json_encode($result) ?>;
            let currentUser = user.find(item => item.tbl_user_id === id);

            $('#updateUserID').val(currentUser.tbl_user_id);
            $('#updateFirstName').val(currentUser.first_name);
            $('#updateLastName').val(currentUser.last_name);
            $('#updateContactNumber').val(currentUser.contact_number);
            $('#updateEmail').val(currentUser.email);
            $('#updateUsername').val(currentUser.username);
            $('#updateUserModal').modal('show');
        }

        // Delete user function
        function delete_user(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = `./endpoint/delete-user.php?user=${id}`;
            }
        }
    </script>
    <!--- FOR HIDING THE TABLES-->
    <script>
    // Constant variables
        const listUsersButton = document.getElementById('listUsersButton');
        const listReserveButton = document.getElementById('listReserveButton');

        function showListReserveTable() {
            window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/reservationTable.php';
        }

        function showListUsersTable() {
            window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/home.php';
        }
        function showListFeedbackTable() {
            window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/feedbackTable.php';
        }
        // Attach event listeners to the buttons
        listUsersButton.addEventListener('click', showListUsersTable);
        listReserveButton.addEventListener('click', showListReserveTable);
    </script>
</body>
</html>
