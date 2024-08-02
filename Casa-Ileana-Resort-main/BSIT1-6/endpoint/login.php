<?php
session_start();

include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve password hash
    $stmt = $conn->prepare("SELECT `tbl_user_id`, `password` FROM `tbl_user` WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Check if user exists
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stored_password = $row['password'];

        // Verify password
        if ($password === $stored_password) {
            // Login successful, set session variables
            $_SESSION['user_id'] = $row['tbl_user_id'];

            // Redirect to home.php or any other authenticated page
            require_once("redirect.php"); // Perform server-side redirection
            exit();
        } else {
            // Incorrect password
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.php';
            </script>
            ";
            exit(); // Ensure no further PHP execution
        }
    } else {
        // User not found
        echo "
        <script>
            alert('Login Failed, User Not Found!');
            window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.php';
        </script>
        ";
        exit(); // Ensure no further PHP execution
    }
}
?>
