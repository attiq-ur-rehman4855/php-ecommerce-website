<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
@session_start();// '@' sign is liye lgaya hy q k session others page b start hy or is page mein b lakin @ sign lgaane se ye faida ho ga k is page pe session tab hi start ho ga jab ye page active ho ga otherwise nh ho ga 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap Css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS file link -->
    <link rel="stylesheet" href="../assets/CSS/style.CSS" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>


<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-3">Admin Login</h2>
        <div class="row d-flex">
            <div class="col-lg-6 col-xl-5">
                <img src="../assets/images/admin_registration.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <!-- form -->
                <form action="" method="POST" enctype="multipart/form-data" class="py-5 px-3 shadow " style="width: 500px;">
                    <!-- email     -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control " required autocomplete="off" placeholder="Enter email">
                    </div>
                    <!-- password     -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Admin password</label>
                        <input type="password" id="password" name="password" class="form-control " required autocomplete="off" placeholder="Enter password">
                    </div>
                    <!-- Insert details     -->
                    <div class="text-center">
                        <input type="submit" name="admin_login" class="btn btn-info w-100" value="Login">
                        <!-- Already have an account? -->
                        <p class="small fw-bold text-center mt-3">Don't have an account?<a href="admin_registration.php" class="text-danger"> Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
<?php
if (isset($_POST['admin_login'])) {
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $select_query = "select * from `admin_table` where admin_email='$admin_email'";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_num_rows($result_query);
    $row_data = mysqli_fetch_assoc($result_query);
    $admin_name = $row_data['admin_name'];
    if ($row > 0) {
        $_SESSION['admin_name'] = $admin_name;
        if (password_verify($admin_password,$row_data['admin_password'])) {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Failed to Login')</script>";
        }
    } else {
        echo "<script>alert('Failed to Login')</script>";
    }
}

?>