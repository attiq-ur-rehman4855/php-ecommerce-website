<?php
$user_image = "";

if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "select * from `user_table` where user_name='$user_session_name'";
    $select_result = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($select_result);
    $user_id = $row_fetch['user_id'];
    $user_name = $row_fetch['user_name'];
    $user_email = $row_fetch['user_email'];
    $user_image = $row_fetch['user_image'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
}
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $user_name = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    // Check if new image is uploaded
    if (empty($user_image)) {
        $user_image = $row_fetch['user_image']; // Keep old image if new is not uploaded
    } else {
        move_uploaded_file($user_image_tmp, "./admin_images/$user_image");
    }

    // update query
    $update_data = "update `user_table` set user_name='$user_name',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' where user_id= $update_id";
    $result_update = mysqli_query($con, $update_data);
    if ($result_update) {
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('users_logout.php','_self')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="../assets/CSS/style.CSS">
</head>
<style>
    .edit_image {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }
</style>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center mt-4">
        <div class="card shadow rounded p-4" style="width: 500px;">
            <h1 class="text-center mb-4">Edit Account</h1>
            <!-- form -->
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- username     -->
                <div class="mb-3">
                    <input type="text" name="user_username" class="form-control" value="<?php echo $user_session_name ?>" placeholder="username">
                </div>
                <!-- email     -->
                <div class="mb-3">
                    <input type="email" name="user_email" class="form-control " value="<?php echo $user_email ?>" placeholder="email">
                </div>
                <!-- user image     -->
                <div class="mb-3 d-flex">
                    <input type="file" name="user_image" class="form-control ">
                    <img src="./users_images/<?php echo $user_image ?>" alt="" class="edit_image">
                    <!-- we have already fetched above image in the profile.php -->
                </div>
                <!-- user address     -->
                <div class="mb-3">
                    <input type="text" name="user_address" class="form-control " value="<?php echo $user_address ?>" placeholder="user address">
                </div>
                <!-- user contact     -->
                <div class="mb-3">
                    <input type="text" name="user_contact" class="form-control " value="<?php echo $user_mobile ?>" placeholder="user contact">
                </div>
                <!-- Update details     -->
                <div class="text-center">
                    <input type="submit" value="Update" name="user_update" class="btn btn-info w-100" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>