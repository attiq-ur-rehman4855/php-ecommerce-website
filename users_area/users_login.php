<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
@session_start(); // '@' sign is liye lgaya hy q k session others page b start hy or is page mein b lakin @ sign lgaane se ye faida ho ga k is page pe session tab hi start ho ga jab ye page active ho ga otherwise nh ho ga 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -Login</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS file link -->
    <link rel="stylesheet" href="../assets/CSS/style.CSS" />

    <!-- font awesome link -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body {
        overflow-x: hidden;
    }

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
    <div class="container-fluid card-container d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <div class="card shadow-lg rounded p-4" style="width: 500px;">
                    <h1 class="text-center mb-4">Login here</h1>
                    <!-- form -->
                    <form action="" method="POST">
                        <!-- username     -->
                        <div class="mb-3">
                            <label for="user_username" class="form-label">Name</label>
                            <input type="text" id="user_username" name="user_username" class="form-control " required autocomplete="off" placeholder="Enter username">
                        </div>
                        <!-- email    -->
                        <!-- <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" id="user_email" name="user_email" class="form-control " required autocomplete="off" placeholder="Enter email">
                        </div> -->
                        <!-- password     -->
                        <div class="mb-3">
                            <label for="user_password" class="form-label">User password</label>
                            <input type="password" id="user_password" name="user_password" class="form-control " required autocomplete="off" placeholder="Enter password">
                        </div>

                        <!-- Insert details     -->
                        <div class="text-center">
                            <input type="submit" name="user_login" class="btn btn-info w-100" value="Login">
                            <!-- Already have an account? -->
                            <p class="small fw-bold text-center mt-3">Don't have an account ?<a href="user_registration.php" class="text-danger"> Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $select_query = "select * from `user_table` where user_name='$user_username'";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_num_rows($result_query);
    $row_data = mysqli_fetch_assoc($result_query);
    $user_ip = getIPAddress();

    // cart item
    $select_query_cart = "select * from `cart_details` where ip_address='$user_ip'";
    $result_query_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($result_query_cart);

    if ($row > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $row_data['user_password'])) {
            // echo "<script>alert('Login successfully')</script>";
            if ($row == 1 and $row_count_cart == 0) // $row mean user have an account but $row_count_cart mean user does not have cart items
            {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Failed to Login')</script>";
        }
    } else {
        echo "<script>alert('Failed to Login')</script>";
    }
}

?>

<!-- last child -->
<?php
include('../includes/footer.php')
?>