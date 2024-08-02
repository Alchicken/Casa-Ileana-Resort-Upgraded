<?php include('./conn/conn.php'); // Include database connection
    include('./feedbackFolder/feed.php');
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

    <div class="mb-3 mt-3 ml-5 bg-transparent">
                <button class="btn btn-primary mr-2" onclick="showListUsersTable()">List of Users</button>
                <button class="btn btn-primary" onclick="showListReserveTable()">List of Reservations</button>
                <button class="btn btn-primary" onclick="showListFeedbackTable()">Customers Feedback</button>
    </div>
    
    <!--- TABLE LIST FOR FEEDBACKS--->
    <div class="list-feedback ml-5" id="feedbackTable" style="margin-top: 5%;">
        <div class="content">
            <h4>Customers Feedback</h4>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Feedback ID</th> 
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date of Message</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= $row['feedback_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['message'] ?></td>
                            <td><?= $row['date_of_message'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="delete_feedback(<?= $row['feedback_id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

                        <!--- FOR Action Buttons -->
    <script>
        // Delete user function
        function delete_feedback(id) {
            if (confirm("Are you sure you want to delete this reservation?")) {
                window.location.href = `./endpoint/delete-feedback.php?user=${id}`;
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
     <!-- JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>


