<?php
    include('partials-front/menu.php');
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="button button-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



 <!-- Food Menu Section Starts Here-->
 <section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            // Display that are active
            $sql = "SELECT * FROM food WHERE active = 'Yes'";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Count the rows to check whether the foods are available or not
            $count = mysqli_num_rows($result);

            // Check whether the foods are available or not
            if ($count > 0) {
                // Food is available
                while ($row = mysqli_fetch_assoc($result)) {
                    // Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-item">
                        <div class="food-item-img">
                            <?php
                                // Check whether the image available or not
                                if ($image_name == "") {
                                    // Image not available
                                    echo "<div class='error text-center'><h2>Image Not Available</h2></div>";
                                } else {
                                    // Image available
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curved">

                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-item-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs <?php echo $price; ?></p>
                            <p class="food-description">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="button button-primary">Order Now</a>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <?php
                }
            } else {
                // Food is not available
                echo "<div class='error text-center'><h2>Food Not Available</h2></div>";
            }
        ?>



        

        <div class="clearfix"></div>
    </div>
</section>
<!-- Food Menu Section End Here-->


<?php
    include('partials-front/footer.php');
?>