<?php
    ob_start();
    include('partials/menu.php');
?>



<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Update Category Page</h1>
        <br><br>

        <?php
            // Check whether the ID is set or not
            if (isset($_GET['id'])) {
                // Get all the details
                $id = $_GET['id'];

                // Create SQL Query to get all other details
                $sql = "SELECT * FROM category WHERE id = $id";

                // Execute the Query
                $result = mysqli_query($conn, $sql);

                // Check whether the query is executed or not
                if ($result == TRUE) {
                    // Check whether the data is available
                    $count = mysqli_num_rows($result);

                    // Check whether we have admin data or not
                    if ($count == 1) {
                        // Get all the details
                        $row = mysqli_fetch_assoc($result);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    } else {
                        // Redirect to manage category page with session manage
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        ob_end_flush();
                    }
                }
            } else {
                // Redirect to manage-category page
                header('location:'.SITEURL.'admin/manage-category.php');
                ob_end_flush();
            }
        ?>

        <!-- Update Category Starts Here-->
        <div class="form-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table-30">

                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if ($current_image != "") {
                                    // Display The Image
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">

                                    <?php
                                } else {
                                    // Display the message
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td class="radio-options">
                            <label><input  <?php if ($featured == "Yes") {echo "checked";}?> type="radio" name="featured" value="Yes"> Yes</label>
                            <label><input <?php if ($featured == "No") {echo "checked";}?>  type="radio" name="featured" value="No"> No</label>
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td class="radio-options">
                            <label><input <?php if ($active == "Yes") {echo "checked";}?> type="radio" name="active" value="Yes"> Yes</label>
                            <label><input <?php if ($active == "No") {echo "checked";}?> type="radio" name="active" value="No"> No</label>
                        </td>
                    </tr>

                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Category">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
        <!-- Update Category Ends Here-->
    </div>
</section>
<!-- Main Content Ends Here-->



<?php
    include('partials/footer.php');
?>


<?php
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Get all the values from our from
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // Upadating new image if selected

        // Check whether the image is selected or not and set the value for image name acoordingly
        if (isset($_FILES['image']['name'])) {

            // Upload the image 
            // To upload the image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            // Upload image only if image is selected
            if ($image_name != "") {
                // Auto rename our image
                // Get the extensionof our image (jpg, png, gif, etc)
                $extension = end(explode('.', $image_name));

                // Rename the image name
                $image_name = "Food_Category_".rand(000, 999).'.'.$extension;

                $source_path = $_FILES['image']['tmp_name'];
                
                $destination_path = "../images/category/".$image_name;

                // Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);


                // Check whether the image is uploaded or not
                // And if the image is not uploaded then we will stop the process and redirect with error message
                if ($upload == FALSE) {
                    // Set the message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                    // Redirect to Add Category
                    header('location:'.SITEURL.'admin/update-category.php');
                    ob_end_flush();
                    // Stop the Process
                    die();
                }

                // Remove the current image if available

                if ($current_image != "") {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                    // Check whether the image is removed or not
                    // if failed to remove then display the message and stop process
                    if ($remove == FALSE) {
                        // Failed to remove the image
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to upload the image</div>";
                        // Redirect to Add Category
                        header('location:'.SITEURL.'admin/manage-category.php');
                        ob_end_flush();
                        // Stop the Process
                        die();
                    }
                }   
            } else {
                $image_name = $current_image;
            }       
        } else {
            // Don't upload the image name value a blank
            $image_name = $current_image;
        }
        

        // Update the database
        $sql2 = "UPDATE category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = $id
        ";

        // Execute the Query
        $result2 = mysqli_query($conn, $sql2);

        // Redirect to manage category with mesaage

        // Check whether the query is executed or not
        if ($result2 == TRUE) {
            // Category updated
            $_SESSION['update'] = "<div class='success'>Updated Category Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            ob_end_flush();
        } else {
            // Failed to update to category
            $_SESSION['update'] = "<div class='error'>Failed To Update Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            ob_end_flush();
        }
    }
?>