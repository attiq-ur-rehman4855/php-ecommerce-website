<?php
if (isset($_GET['delete_category'])) {
    $category_id = $_GET['delete_category'];
    $delete_query = "delete from `categories` where category_id=$category_id";
    $result_delete = mysqli_query($con, $delete_query);
    if ($result_delete) {
        $delete_product = "delete  from `products` where category_id=$category_id";
        $result_delete_product = mysqli_query($con, $delete_product);
        if ($result_delete_product) {
            echo "<script>alert('Category and its related products deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_categories','_self')</script>";
        }
    }
}
