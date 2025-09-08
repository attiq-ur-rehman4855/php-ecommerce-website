<?php
if(isset($_GET['delete_brand']))
{
$brand_id=$_GET['delete_brand'];
$delete_query="delete from `brands` where brands_id=$brand_id";
$result_delete=mysqli_query($con,$delete_query);
if($result_delete)
{
    $delete_product = "delete  from `products` where brands_id=$brand_id";
    $result_delete_product = mysqli_query($con, $delete_product);
    if ($result_delete_product) {
        echo "<script>alert('Brand and its related products deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }}
}
?>