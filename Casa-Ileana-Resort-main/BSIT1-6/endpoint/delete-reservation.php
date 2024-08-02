<?php
include ('../conn/conn.php');

if (isset($_GET['user'])) {
    $user = $_GET['user'];

    try {

        $query = "DELETE FROM `reservation` WHERE `id` = '$user'";

        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
            <script>
                alert('Reservation Deleted Successfully');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/reservationTable.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Reservation to Delete Subject');
                window.location.href = 'http://localhost/Casa-Ileana-Resort-main/BSIT1-6/reservationTable.php';
            </script>
            ";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>