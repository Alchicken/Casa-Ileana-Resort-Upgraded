<?php

include './conn/conn.php';
// Query to fetch reservations
$query = "SELECT feedback_id, name, email, message, date_of_message FROM user_feedbacks";
$stmt = $conn->query($query);

// Fetch all rows as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>