<?php

include './conn/conn.php';
// Query to fetch reservations
$query = "SELECT id, first_name, last_name, email, phone, date FROM reservation";
$stmt = $conn->query($query);

// Fetch all rows as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>