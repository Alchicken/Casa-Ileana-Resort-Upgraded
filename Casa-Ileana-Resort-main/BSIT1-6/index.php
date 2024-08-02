<?php include ('./conn/conn.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login System</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Logout on Refresh -->
    <script>
    window.onbeforeunload = function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "./endpoint/logout.php", false); // 'false' makes the request synchronous
        xhr.send();
    };
    </script>

    <!-- Background Image CSS -->
    <style>
        body {
            background-image: url('carousel.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

</head>
<body>
    
    <div class="main">

        <!-- Login Area -->
        <div class="login" id="loginForm">
            <h1 class="text-center">Login Form</h1>
            <div class="login-form">
                <form action="./endpoint/login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-success login-btn mb-3 form-control">Login</button>
                    <button type="button" class="btn btn-dark mb-3 mainPage" onclick="backToMainPage()">Back</button>
                    <!---<p class="registrationForm" onclick="showRegistrationForm()">No Account? Register Here.</p>-->
                </form>
            </div>
        </div>


        <!-- Registration Area -->
        <div class="registration" id="registrationForm">
            <h1 class="text-center">Registration Form</h1>
            <div class="registration-form">
            <form action="./endpoint/add-user.php" method="POST">
                <div class="form-group row">
                    <div class="col-6">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="first_name">
                    </div>
                    <div class="col-6">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-5">
                        <label for="contactNumber">Contact Number:</label>
                        <input type="number" class="form-control" id="contactNumber" name="contact_number" maxlength="11">
                    </div>
                    <div class="col-7">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="registerUsername">Username:</label>
                    <input type="text" class="form-control" id="registerUsername" name="username">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password:</label>
                    <input type="password" class="form-control" id="registerPassword" name="password">
                </div>
                <button type="button" class="btn btn-dark mb-3 showLoginForm" onclick="showLoginForm()">Back</button>
                <button type="submit" class="btn btn-success login-register form-control">Register</button>
            </form>

            </div>

        </div>

    </div>

    <script>
        // Constant variables
        const loginForm = document.getElementById('loginForm');
        const registrationForm = document.getElementById('registrationForm');

        // Hide registration form
        registrationForm.style.display = "none";


        function showRegistrationForm() {
            registrationForm.style.display = "";
            loginForm.style.display = "none";
        }

        function showLoginForm() {
            registrationForm.style.display = "none";
            loginForm.style.display = "";
        }
        
        function backToMainPage() {
            window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.html';
        }
    </script>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>