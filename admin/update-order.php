<?php
    include('partials/menu.php');
?>



<!-- Main Content Starts Here-->
<section class="main-content">
    <div class="wrapper">
        <h1>Update Order Page</h1>
        <br><br>

        <?php
            // Check whether the id is et or not
            if (isset($_GET['id'])) {
                // Get the order details
                $id = $_GET['id'];

                // Get all the other details based on id
                $sql = "SELECT * FROM order WHERE id = $id";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // COunt rows
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    // Detail available
                    $row = mysqli_fetch_assoc($result);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {
                    // Detail not available
                    // Redirect to manage order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            } else {
                // Redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>


        <!-- Update Food Starts Here-->
        <div class="form-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table-30">

                    <tr>
                        <td>Food Name:</td>
                        <td><input type="text" name="food" placeholder="Category Title" value="<?php echo ""; ?>"></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"</td>
                    </tr>

                    <tr>
                        <td>Quantity: </td>
                        <td><input type="number" name="quantity"</td>
                    </tr>

                    <tr>
                        <td>Status: </td>
                        <td>
                            <select name="status">
                                <option value="Ordered">Ordered</option>
                                <option value="On Delivery">On Delivery</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td><input type="text" name="customer_name" placeholder="Customer Name" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td><input type="tel" name="customer_contact" placeholder="Customer Contact" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td><input type="email" name="customer_email" placeholder="Customer Email" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td><textarea name="customer_address" cols="30" rows="5" placeholder="Customer Address"></textarea></td>
                    </tr>

                    </tr>

                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Order">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
        <!-- Update Food Ends Here-->
    </div>
</section>
<!-- Main Content Ends Here-->



<?php
    include('partials/menu.php');
?>