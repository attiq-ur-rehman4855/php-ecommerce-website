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
    <title>Admin Registration</title>
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
        <h2 class="text-center mb-3">Admin Registration</h2>
        <div class="row d-flex">
            <div class="col-lg-6 col-xl-5">
                <img src="../assets/images/admin_registration.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <!-- form -->
                <form action="" method="POST" enctype="multipart/form-data" class="p-4 shadow " style="width: 500px;">
                    <!-- username     -->
                    <div class="mb-3">
                        <label for="admin_name" class="form-label">Name</label>
                        <input type="text" id="admin_name" name="admin_name" class="form-control " required autocomplete="off" placeholder="Enter username">
                    </div>
                    <!-- email     -->
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Email</label>
                        <input type="email" id="admin_email" name="admin_email" class="form-control " required autocomplete="off" placeholder="Enter email">
                    </div>
                    <!-- image     -->
                    <div class="mb-3">
                        <label for="admin_image" class="form-label">Admin image</label>
                        <input type="File" id="admin_image" name="admin_image" class="form-control " required>
                    </div>
                    <!-- password     -->
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Admin password</label>
                        <input type="password" id="admin_password" name="admin_password" class="form-control " required autocomplete="off" placeholder="Enter password">
                    </div>
                    <!-- confirm password     -->
                    <div class="mb-3">
                        <label for="conf_admin_password" class="form-label">Confirm password</label>
                        <input type="password" id="conf_admin_password" name="conf_admin_password" class="form-control " required autocomplete="off" placeholder="Confirm password">
                    </div>
                    <!-- Insert details     -->
                    <div class="text-center">
                        <input type="submit" name="admin_register" class="btn btn-info w-100" value="Register">
                        <!-- Already have an account? -->
                        <p class="small fw-bold text-center mt-3">Already have an account?<a href="admin_login.php" class="text-danger"> Login</a></p>
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

if (isset($_POST['admin_register'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
    $conf_admin_password = $_POST['conf_admin_password'];
    $admin_image = $_FILES['admin_image']['name'];
    $admin_image_tmp = $_FILES['admin_image']['tmp_name'];
    // select_query
    $select_query = "select * from `admin_table` where admin_name='$admin_name' or admin_email='$admin_email'";
    $select_result = mysqli_query($con, $select_query);
    $row = mysqli_num_rows($select_result);
    if ($row > 0) {
        $_SESSION['admin_name'] = $admin_name;
        echo "<script>alert('This username or email already exist in the record')</script>";
    } elseif ($admin_password != $conf_admin_password) {
        echo "<script>alert('Password and confirm Password are not matched')</script>";
    } else {
        // move image
        move_uploaded_file($admin_image_tmp,"./admin_images/$admin_image");
        // insert query
        $insert_query = "insert into `admin_table` (admin_name,admin_email,admin_image,admin_password)
        values('$admin_name','$admin_email','$admin_image','$hash_password')";
        $result_query = mysqli_query($con, $insert_query);
        if ($result_query) {
            echo "<script>alert('Data inserted successfully')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        }
    }
}

?>