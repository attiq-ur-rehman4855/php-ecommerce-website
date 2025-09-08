<?php
if(isset($_GET['delete_products']))
{
$product_id=$_GET['delete_products'];
$delete_query="delete from `products` where product_id=$product_id";
$result_delete=mysqli_query($con,$delete_query);
if($result_delete)
{
    echo "<script>alert('Product deleted successfully')</script>";
    echo "<script>window.open('./index.php?view_products','_self')</script>";
}
}
?>