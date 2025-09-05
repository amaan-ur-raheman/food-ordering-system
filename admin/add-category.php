<?php
    include ('partials/menu.php');
?>


<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Add Category Page</h1>
        <br><br>

        <?php
            // Checking whether the Session is Set or Not
            if (isset($_SESSION['add'])) {
                echo "<h2 class='message text-center'>{$_SESSION['add']}</h2>";
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo "<h2 class='message text-center'>{$_SESSION['upload']}</h2>";
                unset($_SESSION['upload']); 
            }
        ?>

        <br><br>

        <!-- Add Category Starts Here-->
        <div class="form-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
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
                            <input type="submit" name="submit" value="Add Category">
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
    include('partials/footer.php');
?>



<?php
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Get the value from the category form
        $title = $_POST['title'];

        // For Radio input type, we need to check whether the radio the button is selected or not
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";

        // Check whether the image is selected or not and set the value for image name accordingly
        $image_name = "";
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            // Upload the image 
            $image_name = $_FILES['image']['name'];
            $extension = end(explode('.', $image_name));

            // Rename the image name
            $image_name = "Food_Category_".rand(000, 999).'.'.$extension;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            // Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == FALSE) {
                // Set the message
                $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                // Redirect to Add Category
                header('Location: '.SITEURL.'admin/add-category.php'); // Replace with your domain
                exit();
            }
        }

        // Create SQL Query to insert Category into Database
        $sql = "INSERT INTO category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
        ";

        // Execute the Query and save in database
        $result = mysqli_query($conn, $sql);

        // Check whether the query executed or not and data added or not
        if ($result == TRUE) {
            // Query Executed and category added
            $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
            header('Location:'.SITEURL.'admin/manage-category.php'); // Full URL for redirection
            exit();
        } else {
            // Failed to add category
            $_SESSION['add'] = "<div class='error'>Failed To Add Category</div>";
            header('Location: '.SITEURL.'add-category.php'); // Full URL for redirection
            exit();
        }
    }
?>
