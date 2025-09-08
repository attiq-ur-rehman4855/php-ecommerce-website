<?php
include_once('includes/connect.php');
include_once('functions/common_functions.php');
session_start();

// ====== Update Quantity ======
if (isset($_POST['update_cart'])) {
    $get_ip_address = getIPAddress();
    foreach ($_POST['qty'] as $product_id => $qty) {
        if ($qty <= 0) {
            // agar qty 0 ho to item remove kar do
            $delete_query = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address' AND product_id=$product_id";
            mysqli_query($con, $delete_query);
        } else {
            $update_query = "UPDATE `cart_details` SET quantity=$qty WHERE ip_address='$get_ip_address' AND product_id=$product_id";
            mysqli_query($con, $update_query);
        }
    }
    echo "<script>window.open('cart.php','_self')</script>";
}

// ====== Remove Item ======
if (isset($_POST['remove_cart'])) {
    $remove_id = $_POST['remove_id'];
    $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
    $run_delete = mysqli_query($con, $delete_query);
    if ($run_delete) {
        echo "<script>window.open('cart.php','_self')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - Cart Details</title>
    <!-- bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS file -->
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <style>
        .cart_image {
            width: 80px;
            height: auto;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./assets/images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="./users_area/user_registration.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- cart function -->
        <?php cart(); ?>

        <!-- second navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guests</a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a></li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'><a class='nav-link' href='./users_area/users_login.php'>Login</a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='./users_area/users_logout.php'>Logout</a></li>";
                }
                ?>
            </ul>
        </nav>

        <!-- header -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <!-- cart table -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <?php
                            $get_ip_address = getIPAddress();
                            $total_price = 0;
                            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                            $result_query = mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result_query);

                            if ($result_count > 0) {
                                echo "
                                <thead>
                                    <tr>
                                        <th>Product Title</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>";

                                while ($row = mysqli_fetch_array($result_query)) {
                                    $product_id = $row['product_id'];
                                    $quantity = $row['quantity'];

                                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                                    $result_products = mysqli_query($con, $select_products);

                                    while ($row_product = mysqli_fetch_array($result_products)) {
                                        $price = $row_product['product_price'];
                                        $product_title = $row_product['product_title'];
                                        $product_image1 = $row_product['product_image1'];

                                        $item_total = $price * $quantity;
                                        $total_price += $item_total;
                            ?>
                                        <tr>
                                            <td><?php echo $product_title; ?></td>
                                            <td><img src="./admin_area/product_images/<?php echo $product_image1; ?>" class="cart_image"></td>
                                            <td><input type="number" name="qty[<?php echo $product_id; ?>]" value="<?php echo $quantity; ?>" class="form-input w-50"></td>
                                            <td><?php echo $item_total; ?>/-</td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="remove_id" value="<?php echo $product_id; ?>">
                                                    <input type="submit" name="remove_cart" value="Remove Cart" class="bg-info px-3 py-2 border-0">
                                                </form>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            } else {
                                echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- subtotal -->
                    <div class="d-flex mb-5">
                        <?php
                        if ($result_count > 0) {
                            echo "
                            <h4 class='mx-3'>Subtotal: <strong class='text-info'>$total_price</strong></h4>
                            <input type='submit' name='update_cart' value='Update Cart' class='bg-info px-3 py-2 border-0 mx-2'>
                            <input type='submit' name='continue_shopping' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-2'>
                            <input type='submit' name='checkout' value='Checkout' class='bg-secondary px-3 py-2 border-0 mx-2'>";
                        } else {
                            echo "<input type='submit' name='continue_shopping' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3'>";
                        }

                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        if (isset($_POST['checkout'])) {
                            echo "<script>window.open('./users_area/checkout.php','_self')</script>";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- footer -->
        <?php include('./includes/footer.php'); ?>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
