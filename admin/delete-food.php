<?php
    ob_start();

    // Include constants page
    include("../config/constants.php");

    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        // Process to Delete
        
        // Get the Id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the image if available

        // Check whether the image is available or not and delete only if available
        if ($image_name != "") {
            // Image is available and need to remove

            // Get the image path
            $path = "../images/category/".$image_name;

            // Remove the image file from the folder
            $remove = unlink($path);

            // Check whether the image is removed or not
            if ($remove == FALSE) {
                // Failed to remove the image
                $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove the Food Image.</div>";
                // Redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process of deleteting food
                die();
            }
        }

        // Delete food from the database
        $sql = "DELETE FROM food WHERE id = $id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check whether the query executed or not and set the session message respectively
        if ($result == TRUE) {
            // Food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            // Redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
            ob_end_flush();
        } else {
            // Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed To Delete Food.</div>";
            // Redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
            ob_end_flush();
        }

        // Redirect to manage food with session message
    } else {
        // Redirect to manage-food page
        $_SESSION['unauthorized'] = "<div classs='error'>Unauthorized Access.</div>";
        header('loaction:'.SITEURL.'admin/manage-food.php');
        ob_end_flush();
    }
?>