<?php
    include ('partials/menu.php');
?>


<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Add Admin Page</h1>
        <br><br>

        <?php
            // Checking whether the Session is Set or Not
            if (isset($_SESSION['add'])) {
                echo "<h2 class='message text-center'>{$_SESSION['add']}</h2>"; // Displaying Session Message
                unset($_SESSION['add']); // Removing Session Message
            }
        ?>
        <br><br>

        <div class="form-wrapper">
            <form action="" method="POST">
                <table class="table-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>
<!-- Main Content Ends Here-->


<?php
    include('partials/footer.php');
?>


<?php
    // Process the value from the form and save it in the database
    
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Button Clicked
        // 1. Get the data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password Encryption

        // 2. SQL Query to save the data into the Database
        $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        // 3. Executing Query and Saivng Data into database
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // 4. Check whether (Query is Executed) the data is inserted or not and Display appropriate message
        if ($result == TRUE) {
            // Data Inserted
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Succesfully</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        } else {
            // Falied to insert Data
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    } 
?>