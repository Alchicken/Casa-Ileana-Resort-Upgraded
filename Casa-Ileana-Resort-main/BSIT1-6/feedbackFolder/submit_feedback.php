<?php
include ('../conn/conn.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];




try {
        $conn->beginTransaction();

        $insertStmt = $conn->prepare("INSERT INTO `user_feedbacks` (`feedback_id`, `name`, `email`, `message`) VALUES (NULL, :name, :email, :message)");
        $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $insertStmt->bindParam(':message', $message, PDO::PARAM_STR);
        $insertStmt->execute();


        echo "
        <script>
            alert('Feedback Sent Successfully');        
            window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.html';
        </script>
        ";

        $conn->commit();
    }
catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
}


?>  