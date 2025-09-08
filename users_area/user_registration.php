<?php
session_start();
include('../includes/connect.php');
include('../functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -registration</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS file link -->
    <link rel="stylesheet" href="../assets/CSS/style.CSS" />

    <!-- font awesome link -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .card-container {
        min-height: 100vh;
    }
    
</style>

<body>
    <!-- first child     navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info ">
        <div class="container-fluid">
            <img src="../assets/images/logo.png" alt="" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../display_all.php">Products</a>
                    </li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='profile.php'>My Account</a>
                        </li>";
                    } else {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='user_registration.php'>Register</a>
                        </li>";
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price: <?php total_cart_price() ?>/-</a>
                    </li>

                </ul>
                <form class="d-flex" action="search_product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
                    <input type="submit" value="Search" class="btn btn-sm btn-outline-light" name="search_data_product">
                </form>
            </div>
        </div>
    </nav>
    <!-- calling cart function -->
    <?php
    cart();
    ?>
    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">

            <?php
            if (!isset($_SESSION['username'])) {
                echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guests</a>
                </li>";
            } else {
                echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
            }
            if (!isset($_SESSION['username'])) {
                echo "<li class='nav-item'>
                    <a class='nav-link' href='users_login.php'>Login</a>
                </li>";
            } else {
                echo "<li class='nav-item'>
                    <a class='nav-link' href='users_logout.php'>Logout</a>
                </li>";
            }
            ?>
        </ul>

    </nav>
    <!-- third child -->
    <div class="bg-light">
        <h3 class="text-center">Hidden Store</h3>
        <p class="text-center">Communication is at the heart of e-commerce and community</p>
    </div>
    <div class="container-fluid card-container d-flex align-items-center justify-content-center py-3">
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <div class="card shadow-lg rounded p-4" style="width: 500px;">
                    <h1 class="text-center mb-4">Register here</h1>
                    <!-- form -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- username     -->
                        <div class="mb-3">
                            <label for="user_username" class="form-label">Name</label>
                            <input type="text" id="user_username" name="user_username" class="form-control " required autocomplete="off" placeholder="Enter username">
                        </div>
                        <!-- email     -->
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" id="user_email" name="user_email" class="form-control " required autocomplete="off" placeholder="Enter email">
                        </div>
                        <!-- user image     -->
                        <div class="mb-3">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" id="user_image" name="user_image" class="form-control " required>
                        </div>
                        <!-- password     -->
                        <div class="mb-3">
                            <label for="user_password" class="form-label">User password</label>
                            <input type="password" id="user_password" name="user_password" class="form-control " required autocomplete="off" placeholder="Enter password">
                        </div>
                        <!-- confirm password     -->
                        <div class="mb-3">
                            <label for="conf_user_password" class="form-label">Confirm password</label>
                            <input type="password" id="conf_user_password" name="conf_user_password" class="form-control " required autocomplete="off" placeholder="Confirm password">
                        </div>
                        <!-- user address     -->
                        <div class="mb-3">
                            <label for="user_address" class="form-label">Address</label>
                            <input type="text" id="user_address" name="user_address" class="form-control " required autocomplete="off" placeholder="Enter address">
                        </div>
                        <!-- user contact     -->
                        <div class="mb-3">
                            <label for="user_contact" class="form-label">Contact</label>
                            <input type="text" id="user_contact" name="user_contact" class="form-control " required autocomplete="off" placeholder="Enter your mobile number">
                        </div>
                        <!-- Insert details     -->
                        <div class="text-center">
                            <input type="submit" name="user_register" class="btn btn-info w-100" value="Register">
                            <!-- Already have an account? -->
                            <p class="small fw-bold text-center mt-3">Already have an account?<a href="users_login.php" class="text-danger"> Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php

if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();


    // select_query
    $select_query = "select * from `user_table` where user_name='$user_username' or user_email='$user_email'";
    $select_result = mysqli_query($con, $select_query);
    $row = mysqli_num_rows($select_result);
    if ($row > 0) {
        echo "<script>alert('This username or email already exist in the record')</script>";
    } elseif ($user_password != $conf_user_password) {
        echo "<script>alert('Password and confirm Password are not matched')</script>";
    } else {
        // insert query
        move_uploaded_file($user_image_tmp, "./users_images/$user_image");
        $insert_query = "insert into `user_table` (user_name,user_email,user_password,user_image,user_ip,user_address,user_mobile)
        values('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
        $result_query = mysqli_query($con, $insert_query);
        // if ($result_query) {
        //     echo "<script>alert('Data inserted successfully')</script>";
        // }
    }
    // selecting cart items
    $select_cart_items = "Select * from `cart_details` where ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $row = mysqli_num_rows($result_cart);
    if ($row > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have some items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

?>
<!-- last child -->
<?php
include('../includes/footer.php')
?>