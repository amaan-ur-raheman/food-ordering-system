<?php
    // Include constants.php for SITEURL
    include('../config/constants.php');

    // Destroy the session
    session_destroy(); // Destroys $_SESSION['user]

    // Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>