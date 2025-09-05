<?php
    include ('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Food Page</h1>
        <br>
        <br>

        <?php
            if (isset($_SESSION['add'])) {
                echo "<h2 class='message text-center'>{$_SESSION['add']}</h2>"; 
                unset($_SESSION['add']); 
            }

            if (isset($_SESSION['delete'])) {
                echo "<h2 class='message text-center'>{$_SESSION['delete']}</h2>"; 
                unset($_SESSION['delete']); 
            }

            if (isset($_SESSION['failed-remove'])) {
                echo "<h2 class='message text-center'>{$_SESSION['failed-remove']}</h2>"; 
                unset($_SESSION['failed-remove']); 
            }

            if (isset($_SESSION['unauthorized'])) {
                echo "<h2 class='message text-center'>{$_SESSION['unauthorized']}</h2>"; 
                unset($_SESSION['unauthorized']); 
            }

            if (isset($_SESSION['no-food-found'])) {
                echo "<h2 class='message text-center'>{$_SESSION['no-food-found']}</h2>"; 
                unset($_SESSION['no-food-found']); 
            }

            if (isset($_SESSION['update'])) {
                echo "<h2 class='message text-center'>{$_SESSION['update']}</h2>"; 
                unset($_SESSION['update']); 
            }
        ?>

        <!-- Button to Add Food-->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="button-primary">Add Food</a>
        <br>
        <br>
        <br>

        <table class="table-full"
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                // Create SQL Query to get all the food details
                $sql = "SELECT * FROM food";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Count the rows to check whether we have foods or not
                $count = mysqli_num_rows($result);

                // Create a variable and assing the value for serial no
                $sn = 1;

                if ($count > 0) {
                    // We have food in the database
                    // Get the food from the database

                    while ($row = mysqli_fetch_assoc($result)) {
                        // Get the values from the indiviual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title ?></td>
                            <td>Rs <?php echo $price; ?></td>
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
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="button-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="button-danger">Delete Food</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // We do not have food in the database
                    echo "<tr colspan='7' class='error'><td>Food not added yet.</td></tr>";
                }
            ?>

            
        </table>
</section>
<!-- Main Content Section Ends -->

<?php
    include('partials/footer.php');
?>