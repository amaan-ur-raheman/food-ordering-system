<?php
    include ('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Category Page</h1>
        <br>
        <br>

        <?php
            
            if (isset($_SESSION['add'])) {
                echo "<h2 class='message text-center'>{$_SESSION['add']}</h2>"; 
                unset($_SESSION['add']); 
            }

            if (isset($_SESSION['remove'])) {
                echo "<h2 class='message text-center'>{$_SESSION['remove']}</h2>"; 
                unset($_SESSION['remove']); 
            }

            if (isset($_SESSION['delete'])) {
                echo "<h2 class='message text-center'>{$_SESSION['delete']}</h2>"; 
                unset($_SESSION['delete']); 
            }

            if (isset($_SESSION['no-category-found'])) {
                echo "<h2 class='message text-center'>{$_SESSION['no-category-found']}</h2>"; 
                unset($_SESSION['no-category-found']); 
            }

            if (isset($_SESSION['update'])) {
                echo "<h2 class='message text-center'>{$_SESSION['update']}</h2>"; 
                unset($_SESSION['update']); 
            }

            if (isset($_SESSION['upload'])) {
                echo "<h2 class='message text-center'>{$_SESSION['upload']}</h2>"; 
                unset($_SESSION['upload']); 
            }

            if (isset($_SESSION['failed-remove'])) {
                echo "<h2 class='message text-center'>{$_SESSION['failed-remove']}</h2>"; 
                unset($_SESSION['failed-remove']); 
            }
        ?>

        <br><br>

        <!-- Button to Add Admin-->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="button-primary">Add Category</a>
        <br>
        <br>
        <br>

        <table class="table-full"
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                // Create a SQl Query to get all data from database
                $sql = "SELECT * FROM category";

                // Execute the Query
                $result = mysqli_query($conn, $sql);

                // Check whether the Query is executed or not
                if ($result == TRUE) {
                    $count = mysqli_num_rows($result);

                    // Create a variable and assing the value for serial no
                    $sn = 1;

                    /// Count rows to check whether we have data in database or not
                    if ($count > 0) {
                        // We have data in the database
                        // get data and display
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                                
                            <tr>
                                <td><?php echo $sn++; ?> </td>
                                <td><?php echo $title; ?> </td>
                                <td>
                                    <?php 
                                        // Check whether the image name is available or not
                                        if ($image_name != "") {
                                            // Display the image
                                            ?>
                                             
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name ;?>" alt="" width="100px">

                                            <?php
                                        } else {
                                            // Display the message
                                            echo "<div class='error'>Image Not Added</div>";
                                        }
                                    ?>
                                 </td>
                                <td><?php echo $featured; ?> </td>
                                <td><?php echo $active; ?> </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="button-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="button-danger">Delete Category</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        // We do not have the data in the database
                        // We will display the message inside the table
                        ?>

                        <tr>
                            <td colspan="6">
                                <div class="error text-center"><h2>No Category Added</h2></div>
                            </td>
                        </tr>

                        <?php
                    }

                }
            ?>

        </table>
</section>
<!-- Main Content Section Ends -->

<?php
    include('partials/footer.php');
?>