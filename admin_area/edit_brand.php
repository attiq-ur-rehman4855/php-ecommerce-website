<?php
if (isset($_GET['edit_brand'])) {
    $brand_id = $_GET['edit_brand'];
    $get_brand = "select * from `brands` where brands_id=$brand_id";
    $result_brand = mysqli_query($con, $get_brand);
    $row = mysqli_fetch_assoc($result_brand);
    $brand_title = $row['brands_title'];
}
if (isset($_POST['edit_brand'])) {
    $brand_title_edit = $_POST['brand_title'];
    $brand_update = "update `brands` set brands_title='$brand_title_edit' where brands_id=$brand_id";
    $result_update = mysqli_query($con, $brand_update);
    if ($result_update) {
        echo "<script>alert('Brand updated successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-3">
        <h1 class="text-center">Edit Brand</h1>
        <form action="" method="POST" class="text-center">
            <div class="form-outline mb-3 w-50 m-auto">
                <label for="brand_title" class="form-label">Brand Title</label>
                <input type="text" name="brand_title" id="brand_title" class="form-control" required value="<?php echo $brand_title; ?>">
            </div>
            <input type="submit" name="edit_brand" value="Update Brand" class="btn btn-info px-3 w-50 mb-3">
        </form>
    </div>
</body>

</html>