<?php
include ('../conn/conn.php');

if (isset($_GET['user'])) {
    $user = $_GET['user'];

    try {

        $query = "DELETE FROM `user_feedbacks` WHERE `feedback_id` = '$user'";

        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
            <script>
                alert('Feedback Deleted Successfully');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/feedbackTable.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Feedback to Delete Subject');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/feedbackTable.php';
            </script>
            ";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>