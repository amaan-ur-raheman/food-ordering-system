<?php
    include ('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Admin Page</h1>
        <br><br>

        <?php
            // Checking whether the Session is Set or Not
            if (isset($_SESSION['add'])) {
                echo "<h2 class='message text-center success'>{$_SESSION['add']}</h2>"; // Displaying Session Message
                unset($_SESSION['add']); // Removing Session Message
            }

            if (isset($_SESSION['delete'])) {
                echo "<h2 class='message text-center'>{$_SESSION['delete']}</h2>"; 
                unset($_SESSION['delete']); 
            }

            if (isset($_SESSION['update'])) {
                echo "<h2 class='message text-center'>{$_SESSION['update']}</h2>"; 
                unset($_SESSION['update']); 
            }

            if (isset($_SESSION['user-not-found'])) {
                echo "<h2 class='message text-center'>{$_SESSION['user-not-found']}</h2>"; 
                unset($_SESSION['user-not-found']); 
            }

            if (isset($_SESSION['pwd-not-match'])) {
                echo "<h2 class='message text-center'>{$_SESSION['pwd-not-match']}</h2>"; 
                unset($_SESSION['pwd-not-match']); 
            }

            if (isset($_SESSION['pwd-change'])) {
                echo "<h2 class='message text-center'>{$_SESSION['pwd-change']}</h2>"; 
                unset($_SESSION['pwd-change']); 
            }
        ?>
        <br><br><br>

        <!-- Button to Add Admin-->
        <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="button-primary">Add Admin</a>
        <br><br><br>

        <table class="table-full"
            <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                // Query to get all admin
                $sql = "SELECT * FROM admin";

                // Execute the Query
                $result = mysqli_query($conn, $sql);

                // Check whether the Query is Executed or not
                if ($result == TRUE) {
                    // Count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($result);

                    $sn = 1; // Create a variable and assing the value for serial no

                    // Check the number of rows
                    if ($count > 0) {
                        // We have data in Database
                        while ($rows = mysqli_fetch_assoc($result)) {
                            // Using while loop to get all the data from database
                            // And while loop will run as long as we have data in database
                            
                            // Get indiviual data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            // Display the value in table
                            ?>

                                <tr>
                                    <td><?php echo $sn++ ?> </td>
                                    <td><?php echo $full_name ?></td>
                                    <td><?php echo $username ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="button-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="button-danger">Delete Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="button-ternary">Change Password</a>
                                    </td>
                                </tr>

                            <?php

                        }
                    } else {
                        // We do not have data in Database
                    }

                }

            ?>

        </table>
</section>
<!-- Main Content Section Ends -->

<?php
    include('partials/footer.php');
?>