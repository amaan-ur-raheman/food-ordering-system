<?php
    include('../config/constants.php');
?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <!-- Login Form Starts Here-->
        <section class="login">
            <div class="wrapper" style="width: 90%;">
                <h1>Login</h1>
                <br><br>

                <?php
                    if (isset($_SESSION['login'])) {
                        echo "<h2 class='message text-center'>{$_SESSION['login']}</h2>"; // Displaying Session Message
                        unset($_SESSION['login']); // Removing Session Message
                    }

                    if (isset($_SESSION['no-login-message'])) {
                        echo "<h2 class='message text-center'>{$_SESSION['no-login-message']}</h2>"; // Displaying Session Message
                        unset($_SESSION['no-login-message']); // Removing Session Message
                    }
                ?>
                <br><br>

                <div class="form-wrapper">
                    <form action="" method="POST">
                        <table class="table-30">
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
                                    <input type="submit" name="submit" value="Login">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </section>
        <!-- Login Form Ends Here-->
    </body>
</html>



<?php
    

    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // Process for login
        // Get Data from the Login Form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Create the SQL Query to check whether the user with username or passowrd exists or not
        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

        // Execute the Query
        $result = mysqli_query($conn, $sql);

        // Check whether the query is executed or not
        if ($result == TRUE) {
            // Check whether the user exists or not
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // User available and Login Success
                $_SESSION['login'] = "<div class='success'>Login Successful</div>";
                $_SESSION['user'] = $username; // To check if the user is logged in or not and logut will unsetsit

                // Redirect to Home page/Dashboard
                header('location:'.SITEURL.'admin/index.php');
            } else {
                // User not available
                $_SESSION['login'] = "<div class='error'>Username or Password did not Match</div>";
                // Redirect to Home page/Dashboard
                header('location:'.SITEURL.'admin/login.php');
            }
        }
    }
?>