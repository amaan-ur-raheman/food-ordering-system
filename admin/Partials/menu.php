<?php
    include('../config/constants.php');
    include('login-check.php');
?>



<html>
    <head>
        <title>Food Order Website - Home page</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <!-- Menu Section Starts -->
        <section class="menu text-center">
            <div class="wrapper">
                <div class="logo">
                    <img src="../images/logo.png" alt="Restaurant Logo" class="img-responsive"> 
                </div>

                <div class="menu text-right">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="manage-admin.php">Admin</a>
                        </li>
                        <li>
                            <a href="manage-category.php">Category</a>
                        </li>
                        <li>
                            <a href="manage-food.php">Foods</a>
                        </li>
                        <li>
                            <a href="manage-order.php">Order</a>
                        </li>
                        <li>
                            <a href="logout.php" class="logout-button">Logout</a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>  
        </section>
        <!-- Menu Section Ends -->