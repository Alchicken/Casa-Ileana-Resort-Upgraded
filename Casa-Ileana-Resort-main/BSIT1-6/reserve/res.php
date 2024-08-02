<?php

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];

// Connection to the Database

include('../conn/conn.php');

try {
    // Example: Inserting data into the database
    $insertQuery = "INSERT INTO reservation(first_name, last_name, email, phone, date) VALUES (:first_name, :last_name, :email, :phone, :date)";
    $stmt = $conn->prepare($insertQuery);
    
    // Bind parameters
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':date', $date);
    
    // Execute the query
    $stmt->execute();

     // Success message
     echo '<script>alert("Reservation Success!");</script>';
     echo '<script>window.location.href = "http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.html";</script>';
     exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
