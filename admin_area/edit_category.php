<?php
if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $get_category = "select * from `categories` where category_id=$category_id";
    $result_category = mysqli_query($con, $get_category);
    $row = mysqli_fetch_assoc($result_category);
    $category_title = $row['category_title'];
}
if (isset($_POST['edit_category'])) {
    $category_title_edit = $_POST['category_title'];
    $category_update = "update `categories` set category_title='$category_title_edit' where category_id=$category_id";
    $result_update = mysqli_query($con, $category_update);
    if ($result_update) {
        echo "<script>alert('Category updated successfully')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
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
        <h1 class="text-center">Edit Category</h1>
        <form action="" method="POST" class="text-center">
            <div class="form-outline mb-3 w-50 m-auto">
                <label for="category_title" class="form-label">Category Title</label>
                <input type="text" name="category_title" id="category_title" class="form-control" required value="<?php echo $category_title; ?>">
            </div>
            <input type="submit" name="edit_category" value="Update Category" class="btn btn-info px-3 w-50 mb-3">
        </form>
    </div>
</body>

</html>