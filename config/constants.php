<?php
    // Start Session
    session_start();

    // Create Constants
    define('SITEURL', 'http://localhost/Food-Order-System/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    // 3. Execute Query and Save Data in Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $db_select = mysqli_select_db($conn, DB_NAME);
    if (!$db_select) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>