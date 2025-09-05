<?php
ob_start();
include('partials-front/menu.php');

// Initialize variables
$food_id = $title = $price = $image_name = '';
$errors = [];

// Validate and sanitize food_id
if (isset($_GET['food_id'])) {
    $food_id = filter_input(INPUT_GET, 'food_id', FILTER_VALIDATE_INT);
    if ($food_id === false || $food_id === null) {
        header('location: ' . SITEURL);
        exit();
    }

    // Prepare and execute query using prepared statement
    $sql = "SELECT * FROM food WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $food_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $title = htmlspecialchars($row['title']);
        $price = (float)$row['price'];
        $image_name = htmlspecialchars($row['image_name']);
    } else {
        header('location: ' . SITEURL);
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    header('location: ' . SITEURL);
    exit();
}
?>

<!-- Food Search Section -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-item-img">
                    <?php if (empty($image_name)): ?>
                        <div class='error text-center'><h2>Image Not Found</h2></div>
                    <?php else: ?>
                        <img src="<?php echo SITEURL . 'images/category/' . htmlspecialchars($image_name); ?>" 
                             alt="<?php echo $title; ?>" 
                             class="img-responsive img-curved">
                    <?php endif; ?>
                </div>

                <div class="food-item-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">Rs <?php echo number_format($price, 2); ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min="1" max="99" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name"  
                       placeholder="E.g. Amaan ur Raheman" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" 
                       placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" 
                       placeholder="E.g. hi@amaan.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" 
                          placeholder="E.g. Street, City, Country" 
                          class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="button button-primary">
            </fieldset>
        </form>
    </div>
</section>

<?php
include('partials-front/footer.php');

if (isset($_POST['submit'])) {
    // Validate and sanitize input
    $food = filter_var($_POST['food'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 99]]);
    $customer_name = filter_var($_POST['full-name'], FILTER_SANITIZE_STRING);
    $customer_contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
    $customer_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $customer_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

    // Validate all inputs
    if (!$food || !$price || !$qty || !$customer_name || !$customer_contact || 
        !$customer_email || !$customer_address) {
        $_SESSION['order'] = "<div class='error'>Invalid input data.</div>";
        header('location: ' . SITEURL);
        exit();
    }

    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";

    // Prepare the INSERT statement
    $sql2 = "INSERT INTO `order` (food, price, qty, total, order_date, status, 
             customer_name, customer_contact, customer_email, customer_address) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt2 = mysqli_prepare($conn, $sql2);
    if ($stmt2) {
        mysqli_stmt_bind_param($stmt2, "sdddssssss", 
            $food, $price, $qty, $total, $order_date, $status,
            $customer_name, $customer_contact, $customer_email, $customer_address
        );

        if (mysqli_stmt_execute($stmt2)) {
            $_SESSION['order'] = "<div class='success'>Food Ordered Successfully.</div>";
        } else {
            $_SESSION['order'] = "<div class='error'>Failed To Order Food.</div>";
        }

        mysqli_stmt_close($stmt2);
    } else {
        $_SESSION['order'] = "<div class='error'>Database Error.</div>";
    }

    header('location: ' . SITEURL);
    exit();
}

ob_end_flush();
?>