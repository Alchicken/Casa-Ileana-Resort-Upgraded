<?php
include ('../conn/conn.php');

// Sanitize and validate inputs
$updateUserID = filter_input(INPUT_POST, 'tbl_user_id', FILTER_VALIDATE_INT);
$updateFirstName = htmlspecialchars($_POST['first_name']);
$updateLastName = htmlspecialchars($_POST['last_name']);
$updateContactNumber = htmlspecialchars($_POST['contact_number']);
$updateEmail = htmlspecialchars($_POST['email']);
$updateUsername = htmlspecialchars($_POST['username']);
$updatePassword = htmlspecialchars($_POST['password']);

try {
    // Check if the user exists based on first name and last name
    $stmt = $conn->prepare("SELECT `first_name`, `last_name` FROM `tbl_user` WHERE `tbl_user_id` != :userID AND `first_name` = :first_name AND `last_name` = :last_name");
    $stmt->execute([
        'userID' => $updateUserID,
        'first_name' => $updateFirstName,
        'last_name' => $updateLastName
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        // Start transaction for atomicity
        $conn->beginTransaction();

        // Update user information
        $updateStmt = $conn->prepare("UPDATE `tbl_user` SET `first_name` = :first_name, `last_name` = :last_name, `contact_number` = :contact_number, `email` = :email, `username` = :username, `password` = :password WHERE `tbl_user_id` = :userID");
        $updateStmt->bindParam(':first_name', $updateFirstName, PDO::PARAM_STR);
        $updateStmt->bindParam(':last_name', $updateLastName, PDO::PARAM_STR);
        $updateStmt->bindParam(':contact_number', $updateContactNumber, PDO::PARAM_STR); // Assuming contact_number is stored as a string
        $updateStmt->bindParam(':email', $updateEmail, PDO::PARAM_STR);
        $updateStmt->bindParam(':username', $updateUsername, PDO::PARAM_STR);
        $updateStmt->bindParam(':password', $updatePassword, PDO::PARAM_STR); // Hash the password here if needed
        $updateStmt->bindParam(':userID', $updateUserID, PDO::PARAM_INT);
        $updateStmt->execute();

        // Commit transaction
        $conn->commit();

        // Redirect after successful update
        echo "
            <script>
                alert('Update Successfully.');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/home.php';
            </script>
        ";
        exit;
    } else {
        // User with the same name already exists
        echo "
            <script>
                alert('User with the same name already exists');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.php';
            </script>
        ";
    }
} catch (PDOException $e) {
    // Rollback the transaction if there's an error
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
