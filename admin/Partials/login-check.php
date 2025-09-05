<?php
    // Authorization - Access Control
    // Check whether the user is logged in or not

    if (!isset($_SESSION['user'])) {
        // User is not logged in
        // Redirect to login page
        $_SESSION['no-login-message'] = "<div class='error'>Login To Access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    } 
?>