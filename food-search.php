<?php
    include('partials-front/menu.php');

    // Get the search keyword
    $search = $_POST['search'];
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- Food Menu Section Starts Here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // SQL Query get food based on seach keyword
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Count rows to check whether the food is available or not
                $count = mysqli_num_rows($result);

                // Check Whether food available or not
                if ($count > 0) {
                    // Food available
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Get all the values from the database
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-item">
                            <div class="food-item-img">

                                <?php
                                    // Check whether the image is available or not
                                    if ($image_name == "") {
                                        // Image not available
                                        echo "<div class='error text-center'><h2>Image Not Found</h2></div>";
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
                                <p class="food-price"><?php echo $price; ?></p>
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
                    // Food not avaiable
                    echo "<div class='error text-center'><h2>Food Not Found</h2></div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food Menu Section End Here-->


    
<?php
    include('partials-front/footer.php');
?>