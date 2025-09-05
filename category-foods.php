<?php
    ob_start();

    include('partials-front/menu.php');

    // Check whether the id is passed or not
    if (isset($_GET['category_id'])){
        // Category id is set
        $category_id = $_GET['category_id'];
        // Get the category title
        $sql = "SELECT title FROM category WHERE id = $category_id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Get the value from the database
        $row = mysqli_fetch_assoc($result);

        // Get the title
        $category_title = $row['title'];
    } else {
        // Category id is not selected
        header('location:'.SITEURL);
        ob_end_flush();
    }
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

        <!-- Food Menu Section Starts Here-->
        <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // SQL Query get food based on selected category
                $sql2 = "SELECT * FROM food WHERE category_id = $category_id";

                // Execute the query
                $result2 = mysqli_query($conn, $sql2);

                // Count rows to check whether the food is available or not
                $count2 = mysqli_num_rows($result2);

                // Check Whether food available or not
                if ($count2 > 0) {
                    // Food available
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        // Get all the values from the database
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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