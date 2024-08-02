<?php
include ('../conn/conn.php');

// Sanitize and validate inputs
$updateReservationID = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$updateFirstName = htmlspecialchars($_POST['first_name']);
$updateLastName = htmlspecialchars($_POST['last_name']);
$updateContactNumber = htmlspecialchars($_POST['phone']); // Ensure this matches the form field name
$updateEmail = htmlspecialchars($_POST['email']);
$updateDate = htmlspecialchars($_POST['date']);

try {
    // Check if the user exists based on first name and last name
    $stmt = $conn->prepare("SELECT `first_name`, `last_name` FROM `reservation` WHERE `id` != :userID AND `first_name` = :first_name AND `last_name` = :last_name");
    $stmt->execute([
        'userID' => $updateReservationID,
        'first_name' => $updateFirstName,
        'last_name' => $updateLastName
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        // Start transaction for atomicity
        $conn->beginTransaction();

        // Update user information
        $updateStmt = $conn->prepare("UPDATE `reservation` SET `first_name` = :first_name, `last_name` = :last_name, `phone` = :phone, `email` = :email, `date` = :date WHERE `id` = :userID");
        $updateStmt->bindParam(':first_name', $updateFirstName, PDO::PARAM_STR);
        $updateStmt->bindParam(':last_name', $updateLastName, PDO::PARAM_STR);
        $updateStmt->bindParam(':phone', $updateContactNumber, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $updateEmail, PDO::PARAM_STR);
        $updateStmt->bindParam(':date', $updateDate, PDO::PARAM_STR);
        $updateStmt->bindParam(':userID', $updateReservationID, PDO::PARAM_INT);
        $updateStmt->execute();

        // Commit transaction
        $conn->commit();

        // Redirect after successful update
        echo "
            <script>
                alert('Update Successfully.');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/reservationTable.php';
            </script>
        ";
        exit;
    } else {
        // User with the same name already exists
        echo "
            <script>
                alert('User with the same name already exists');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/reservationTable.php';
            </script>
        ";
    }
} catch (PDOException $e) {
    // Rollback the transaction if there's an error
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
