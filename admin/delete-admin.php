<?php
    // Include constansts.php file
    include('../config/constants.php');

    // Get the ID of the Admin to be deleted
    $id = $_GET['id'];

    // Create SQL Query to delete Admin
    $sql = "DELETE FROM admin WHERE id = $id";

    // Execute the Query
    $result = mysqli_query($conn, $sql);

    // Check whether the query executed sucessfully or not
    if ($result == TRUE) {
        // Query executed sucessfully and admin deleted
        // Create Session variable to display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        // Failed to delete Admin
        // Create Session variable to display Message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }


    // Redirect to Manage Admin Page (success/error)
?>