<?php
include ('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo "<h2 class='message text-center'>{$_SESSION['login']}</h2>"; // Displaying Session Message
            unset($_SESSION['login']); // Removing Session Message
        }
        ?>
        <br><br>

        <div class="col-4 text-center">

            <?php
            $sql = "SELECT * FROM category"; // Fixed the table name to `category`
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            ?>

            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">

            <?php
                $sql2 = "SELECT * FROM food"; 
                $result2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($result2);
            ?>

            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>
        <div class="col-4 text-center">
            <?php
                $sql3 = "SELECT * FROM `order`"; 
                $result3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($result3);
            ?>
            <h1><?php echo $count3; ?></h1> 
            <br>
            Orders
        </div>
        <div class="col-4 text-center">
            <?php
            $sql4 = "SELECT SUM(total) AS Total FROM `order`"; // Fixed table name
            $result4 = mysqli_query($conn, $sql4);

            // Check if the query was successful
            if ($result4) {
                // Get the value
                $row = mysqli_fetch_assoc($result4);
                $total_revenue = $row['Total']; // Corrected variable name
            } else {
                $total_revenue = 0; // Default to 0 if no revenue found
            }
            ?>

            <h1>Rs <?php echo number_format($total_revenue, 2); ?></h1> <!-- Format revenue to two decimal places -->
            <br>
            Revenue Generated
        </div>

        <div class="clearfix"></div>
    </div>  
</section>
<!-- Main Content Section Ends -->

<?php
include('partials/footer.php');
?>