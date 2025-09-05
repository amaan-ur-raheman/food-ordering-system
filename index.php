<?php
    include('partials-front/menu.php');
?>


    <!-- Food Search Section Starts Here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for food ....">
                <input type="submit" name="submit" value="Search" class="button button-primary">
            </form>
        </div>    
    </section>
    <!-- Food Search Section End Here-->
     <br><br>

    <?php
        if (isset($_SESSION['order'])) {
            echo "<h2 class='message text-center'>{$_SESSION['order']}</h2>"; 
            unset($_SESSION['order']); 
        }
    ?>

    <br><br>
    <!-- Categories Section Starts Here-->
    <section class="categories">
        <div class="container">
           <h2 class="text-center">Explore Foods</h2>

           <?php
                // Create the sql query to display the categories from the database
                $sql = "SELECT * FROM category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Count the rows in the database to check whether the category is available or not
                $count = mysqli_num_rows($result);

                if ($count > 0) {
                    // Category is available
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Get the values 
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">    
                            <div class="box-3 float-container">
                                    <?php
                                        // Check whether the image name is available or not
                                        if ($image_name == "") {
                                            echo "<div class='error'> Image Not Available </div>";
                                        } else {
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curved">
                                            <?php
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                } else {
                    // Category not available
                    echo "<div class='error text-center'><h2>Category Not Available</h2></div>";
                }
           ?>

           <div class="clearfix"></div>
        </div>  
    </section>
    <!-- Categories Section End Here-->


    <!-- Food Menu Section Starts Here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // Getting foods from the database the are active and featured
                // Create SQL query
                $sql2 = "SELECT * FROM food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

                // Execute the query
                $result2 = mysqli_query($conn, $sql2);

                // Count the rows in the database to check whether the food is available or not
                $count2 = mysqli_num_rows($result2);

                // Check whether food available or not
                if ($count2 > 0) {
                    // Food available
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        // Get all the values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="food-item">
                            <div class="food-item-img">
                                <?php
                                    // Check whether image available or not
                                    if ($image_name == "") {
                                        // Image not available
                                        echo "<div class='error'>Image Not Available </div>";
                                    } else {
                                        // Image availble
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Vegetable Pizza" class="img-responsive img-curved">

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
                    // Food not available
                    echo "<div class='error text-center'><h2>Food Not Available</h2></div>";
                }

            ?>

            

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- Food Menu Section End Here-->


<?php
    include('partials-front/footer.php');
?>