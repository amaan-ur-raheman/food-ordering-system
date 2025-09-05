<?php
    ob_start();
    include('partials/menu.php')
?>



<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Add Food Page</h1>
        <br><br>

        <?php
            if (isset($_SESSION['upload'])) {
                echo "<h2 class='message text-center'>{$_SESSION['upload']}</h2>"; 
                unset($_SESSION['upload']); 
            }

            if (isset($_SESSION['add'])) {
                echo "<h2 class='message text-center'>{$_SESSION['add']}</h2>";
                unset($_SESSION['add']);
            }
        ?>

         <!-- Add Category Starts Here-->
         <div class="form-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Food Title"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description"  cols="30" rows="5" placeholder="Description of the food..."></textarea><td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
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
                                                $id = $row['id'];
                                                $title = $row['title'];
                                                ?>

                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td class="radio-options">
                            <label><input type="radio" name="featured" value="Yes"> Yes</label>
                            <label><input type="radio" name="featured" value="No"> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td class="radio-options">
                            <label><input type="radio" name="active" value="Yes"> Yes</label>
                            <label><input type="radio" name="active" value="No"> No</label>
                        </td>
                    </tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- Add Category Ends Here-->
    </div>
</section>
<!-- Main Content Ends Here-->



<?php
    include('partials/footer.php')
?>



<?php
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Add food to the database

        // Get the data from the form

        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        
        // Check whether the radio button for featured and active are checked or not
        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        } else {
            $featured = "No";
        }

        if (isset($_POST['active'])) {
            $active = $_POST['active'];
        } else {
            $active = "No";
        }

        // Upload the image if selected
        if (isset($_FILES['image']['name'])) {
            // Get the details of the selected image
            $image_name = $_FILES['image']['name'];

            // Check whether the image is selected or not and upload image only if selected
            if ($image_name != "") {
                // Image is selected

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
                    header('location:'.SITEURL.'admin/add-food.php');
                    // Stop the Process
                    die();
                }
            } 
        } else {
            $image_name = "";
        }

        // Insert into database

        // Create the SQL Query to save or add food
        $sql2 = "INSERT INTO food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active' 
        ";

        // Execute the query
        $result2 = mysqli_query($conn, $sql2);

        // Check whether the sql query is executed or not
        if ($result2 == TRUE) {
            // Data is inserted successfully
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
            header('Location:'.SITEURL.'admin/manage-food.php');
            ob_end_flush();
        } else {
            // Failed to insert the data
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
            // Redirect Page to Manage Admin
            header('Location:'.SITEURL.'admin/add-food.php');
            ob_end_flush();
        }   
    }
?>