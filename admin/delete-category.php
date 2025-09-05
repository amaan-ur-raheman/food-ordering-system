<?php
    // Include constants.php file
    include('../config/constants.php');

    // Check whether the Id and imag_name are set or not
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        // Get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        // First remove the physical image file if available
        if ($image_name != "") {
            // Image is available. So remove it
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            // If failed to remove an image then add an error message and stop the process
            if ($remove == FALSE) {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove the Category Image.</div>";
                // Redirect to Manage Category Page 
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from the database
        $sql = "DELETE FROM category WHERE id = $id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check whether the data is deleted from the database or not
        if ($result == TRUE) {
            // Set sucess message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            // Set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete the Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }  
    } else {
        // Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    
?>