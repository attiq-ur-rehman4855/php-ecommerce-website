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
    <title>Admin Update Account</title>
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

        .admin_image {
            width: 50px;
            height: 70px;
            object-fit: contain;
        }
    </style>
</head>


<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-3">Edit My Account</h2>
        <div class="row d-flex">
            <div class="col-lg-6 col-xl-5">
                <img src="../assets/images/admin_registration.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <?php
                $admin_name = $admin_email = $admin_image = "";

                if (isset($_GET['admin_id'])) {
                    $admin_id = $_GET['admin_id'];
                    $get_admin_data = "SELECT * FROM `admin_table` WHERE admin_id='$admin_id'";
                    $result = mysqli_query($con, $get_admin_data);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $admin_name = $row['admin_name'];
                        $admin_email = $row['admin_email'];
                        $admin_image = $row['admin_image'];
                        $admin_password = $row['admin_password'];
                    } else {
                        echo "<script>alert('Admin not found!');</script>";
                        echo "<script>window.open('index.php','_self');</script>";
                        exit();
                    }
                } else {
                    echo "<script>alert('Invalid Admin ID!');</script>";
                    echo "<script>window.open('index.php','_self');</script>";
                    exit();
                }

                if (isset($_POST['update_admin'])) {
                    $admin_name = $_POST['admin_name'];
                    $admin_email = $_POST['admin_email'];
                    $admin_image = $_FILES['admin_image']['name'];
                    $admin_image_tmp = $_FILES['admin_image']['tmp_name'];
                    $admin_old_password = $_POST['admin_old_password'];
                    $admin_new_password = $_POST['admin_new_password'];

                    // Check if new image is uploaded
                    if (empty($admin_image)) {
                        $admin_image = $row['admin_image']; // Keep old image if new is not uploaded
                    } else {
                        move_uploaded_file($admin_image_tmp, "./admin_images/$admin_image");
                    }

                    // Verify old password
                    if (password_verify($admin_old_password, $admin_password)) {
                        $hash_password = password_hash($admin_new_password, PASSWORD_DEFAULT);
                        $update_data = "UPDATE `admin_table` SET 
            admin_name='$admin_name', 
            admin_email='$admin_email', 
            admin_image='$admin_image', 
            admin_password='$hash_password' 
            WHERE admin_id=$admin_id";

                        $result_update = mysqli_query($con, $update_data);

                        if ($result_update) {
                            echo "<script>alert('Data updated successfully');</script>";
                            echo "<script>window.open('admin_logout.php','_self');</script>";
                        } else {
                            echo "<script>alert('Error updating data');</script>";
                        }
                    } else {
                        echo "<script>alert('Old password is incorrect');</script>";
                    }
                }
                ?>
                <!-- form -->
                <form action="" method="POST" enctype="multipart/form-data" class="p-4 shadow " style="width: 500px;">
                    <!-- username     -->
                    <div class="mb-3">
                        <label for="admin_name" class="form-label">Name</label>
                        <input type="text" id="admin_name" name="admin_name" class="form-control " required autocomplete="off" value="<?php echo $admin_name ?>">
                    </div>
                    <!-- email     -->
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Email</label>
                        <input type="email" id="admin_email" name="admin_email" class="form-control " required autocomplete="off" value="<?php echo $admin_email ?>">
                    </div>
                    <!-- image     -->
                    <div class="mb-3">
                        <label for="admin_image" class="form-label">Admin image</label>
                        <div class="d-flex">
                            <input type="File" id="admin_image" name="admin_image" class="form-control ">
                            <img src="./admin_images/<?php echo $admin_image ?>" alt="admin_image" class="admin_image">
                        </div>
                    </div>
                    <!--old  password     -->
                    <div class="mb-3">
                        <label for="admin_old_password" class="form-label">Old password</label>
                        <input type="password" id="admin_old_password" name="admin_old_password" class="form-control " required autocomplete="off" placeholder="Enter your old password">
                    </div>
                    <!-- new password     -->
                    <div class="mb-3">
                        <label for="admin_new_password" class="form-label">New password</label>
                        <input type="password" id="admin_new_password" name="admin_new_password" class="form-control " required autocomplete="off" placeholder="Enter new password">
                    </div>
                    <!-- Insert details     -->
                    <div class="text-center">
                        <input type="submit" name="update_admin" class="btn btn-info w-100" value="Update">
                        <!-- Already have an account? -->
                        <p class="small fw-bold text-center mt-3">Don't need to update?<a href="index.php" class="text-danger">Go to Home</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>