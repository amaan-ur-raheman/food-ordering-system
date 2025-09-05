<?php
include('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Orders</h1>

        <br><br>

        <?php 
            // Display update message if exists
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <table class="table-full manage-order-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer Email</th>
                    <th>Customer Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Create SQL query - ensure the table name is correct
                $sql = "SELECT * FROM `order` ORDER BY id DESC";

                // Execute query
                $result = mysqli_query($conn, $sql);

                // Check if query was successful
                if (!$result) {
                    die("Database query failed: " . mysqli_error($conn));
                }

                // Count rows
                $count = mysqli_num_rows($result);

                if ($count > 0) {
                    $sn = 1; // Initialize serial number
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Sanitize output data
                        $id = htmlspecialchars($row['id']);
                        $food = htmlspecialchars($row['food']);
                        $price = number_format($row['price'], 2); // Format price
                        $qty = intval($row['qty']); // Ensure qty is an integer
                        $total = number_format($row['total'], 2); // Format total
                        $order_date = date("Y-m-d H:i:s", strtotime($row['order_date'])); // Format date
                        $status = htmlspecialchars($row['status']);
                        $customer_name = htmlspecialchars($row['customer_name']);
                        $customer_contact = htmlspecialchars($row['customer_contact']);
                        $customer_email = htmlspecialchars($row['customer_email']);
                        $customer_address = htmlspecialchars($row['customer_address']);
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td>Rs <?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>Rs <?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <span class="status-badge status-<?php echo strtolower($status); ?>">
                                    <?php echo $status; ?>
                                </span>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11">
                            <div class="error text-center">
                                <h2>No Orders Found</h2>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<!-- Main Content Section Ends -->

<?php
include('partials/footer.php');
?>