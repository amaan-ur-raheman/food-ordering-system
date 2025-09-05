<?php
    include('Partials/menu.php');
?>



<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Change Password Page</h1>
        <br><br>

        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>

        <div class="form-wrapper">
            <form action="" method="POST">
                <table class="table-30">
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="new_password" placeholder="New password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password">
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
    // Check whether the submit is clicked or not
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_passowrd = md5($_POST['confirm_password']);

        // Check whether the user current ID and current password exists
        $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";

        // Execute Query
        $result = mysqli_query($conn, $sql);

        // Check whether the query is executed or not
        if ($result == TRUE) {
            // Check whether the data is available or not
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // User Exists and Password can be changed
                // Check whether the new password and confirm password match
                if ($new_password == $confirm_passowrd) {
                    // Update the password
                    $sql2 = "UPDATE admin SET 
                        password = '$new_password'
                        WHERE id = $id    
                    ";

                    // Execute the Query
                    $result2 = mysqli_query($conn, $sql2);

                    // Check whether the query is executed or not
                    if ($result2 == TRUE) {
                        // Redirect to manange admin page with success messsage
                        $_SESSION['pwd-change'] = "<div class='success'>Password Change Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    } else {
                        // Redirect to manange admin paage with error messsage
                        $_SESSION['pwd-change'] = "<div class='error'>Failed To Change Password</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                } else {
                    // Redirect to manange admin paage with error messsage
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                
            } else {
                // User does not exists and Redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        
        // Change password if all above is true
    }
?>