<?php
    include('Partials/menu.php');
?>



<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Update Admin Page</h1>
        <br><br>

        <?php
            // Get the ID of the selected Admin
            $id = $_GET['id'];

            // Create the SQL Query to get the details
            $sql = "SELECT * FROM admin WHERE id = $id";

            // Execute the Query
            $result = mysqli_query($conn, $sql);

            // Check whether the query is executed or not
            if ($result == TRUE) {
                // Check whether the data is available
                $count = mysqli_num_rows($result);

                // Check whether we have admin data or not
                if ($count == 1) {
                    // Get the details
                    $row = mysqli_fetch_assoc($result);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    // Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        

        <div class="form-wrapper">
            <form action="" method="POST">
                <table class="table-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="<?php echo $full_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="<?php echo $username; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>
<!-- Main Content Ends Here-->



<?php
    include('Partials/footer.php');
?>



<?php
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Get values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create a SQL Query to update admin
        $sql = "UPDATE admin SET 
            full_name = '$full_name',
            username = '$username'
            WHERE id = $id;
        ";

        // Execute the Query
        $result = mysqli_query($conn, $sql);

        // Check whether the query is executed or not
        if ($result == TRUE) {
            // Query executed and admin updated
            $_SESSION['update'] = "<div class='success'>Admin Upadted Successfully</div>";
            // Rediredt to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else {
            // Failed to update Admin
            $_SESSION['update'] = "<div class='error'>Failed to update Admin</div>";
            // Rediredt to update admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    }
?>