<?php
    // Initialize the session
    session_start();

    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the home page (index.html)
    header("Location: http://localhost/Casa-Ileana-Resort-main/BSIT1-6/index.html");
    exit();
?>
