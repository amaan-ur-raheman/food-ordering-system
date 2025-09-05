<?php
    ob_start();
    include('partials/menu.php');
?>



<?php
    // Check whether the ID is set or not
    if (isset($_GET['id'])) {
        // Get all the details
        $id = $_GET['id'];

        // Create SQL Query to get all other details
        $sql2 = "SELECT * FROM food WHERE id = $id";

        // Execute the Query
        $result2 = mysqli_query($conn, $sql2);

        // Check whether the query is executed or not
        if ($result2 == TRUE) {
            // Check whether the data is available
            $count = mysqli_num_rows($result2);

            // Check whether we have admin data or not
            if ($count == 1) {
                // Get all the details
                $row2 = mysqli_fetch_assoc($result2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                // Redirect to manage category page with session manage
                $_SESSION['no-food-found'] = "<div class='error'>Food Not Found</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                ob_end_flush();
            }
        }
    } else {
        // Redirect to manage-category page
        header('location:'.SITEURL.'admin/manage-category.php');
        ob_end_flush();
    }
?>




<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Update Food Page</h1>
        <br><br>


        <!-- Update Food Starts Here-->
        <div class="form-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table-30">

                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description"  cols="30" rows="5" placeholder="Description of the food..."><?php echo $description; ?></textarea><td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if ($current_image != "") {
                                    // Display The Image
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" alt="<?php echo $title; ?>">

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
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php
                                    // Create PHP code to display the categories from the category page
                                    $sql = "SELECT * FROM category WHERE active = 'Yes'";

                                    // Execute the Query
                                    $result = mysqli_query($conn, $sql);

                                    // Check whether the Query is executed or not

                                    if ($result == TRUE) {
                                        // Count rows to check whether we have categories or not
                                        $count = mysqli_num_rows($result);

                                        // If count is greater than zero we have categories else we do not have categories
                                        if ($count > 0) {
                                            // We have categories
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Get the details of categories 
                                                $category_id = $row['id'];
                                                $category_title = $row['title'];
                                                ?>

                                                <option <?php if ($current_category == $category_id) {echo "selected";}; ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                                <?php

                                            }
                                        } else {
                                            // We do not have categories
                                            ?>

                                            <option value="0">No Categories Found</option>

                                            <?php
                                        }
                                    }

                                ?>

                            </select>
                        </td>

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
                            <input type="submit" name="submit" value="Update Food">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
        <!-- Update Food Ends Here-->
    </div>
</section>
<!-- Main Content Ends Here-->



<?php
    include('partials/footer.php');
?>



<?php
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Get all the details from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // Upload the image if selected

        // Check whether the upload button is uploaded or not
        if (isset($_FILES['image']['name'])) {
            // Upload button clicked
            $image_name = $_FILES['image']['name'];

            // Check whether the file is available or not
            if ($image_name != "") {
                // Image is available
                // Auto rename our image
                // Get the extensionof our image (jpg, png, gif, etc)
                $extension = end(explode('.', $image_name));

                // Rename the image name
                $image_name = "Food-Name-".rand(000, 999).'.'.$extension;

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
                    header('location:'.SITEURL.'admin/manage-food.php');
                    ob_end_flush();
                    // Stop the Process
                    die();
                }

                // Remove the current image if available

                // Remove current image if available
                if ($current_image != "") {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                    if ($remove == FALSE) {
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        exit();
                    }
                }
            } else {
                $image_name = $current_image;
            }
        } else {
            $image_name = $current_image;
        }

        // Update the food in the database
        $sql3 = "UPDATE food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            WHERE id = $id
        ";

        // Execute the sql query
        $result3 = mysqli_query($conn, $sql3);

        // Check whether the query is executed or not
        if ($result3 == TRUE) {
            // Query executed and food updated
            $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
            // Redirect to manage fodd
            header('location:'.SITEURL.'admin/manage-food.php');
            ob_end_flush();
        } else {
            // Failed to update food
            $_SESSION['update'] = "<div class='error'>Failed To Update Food.</div>";
            // Redirect to manage fodd
            header('location:'.SITEURL.'admin/manage-food.php');
            ob_end_flush();
        }
    }
?>