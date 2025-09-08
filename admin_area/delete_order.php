<?php
if(isset($_GET['delete_order']))
{
$order_id=$_GET['delete_order'];
$delete_query="delete from `user_orders` where order_id=$order_id";
$result_delete=mysqli_query($con,$delete_query);
if($result_delete)
{
    echo "<script>alert('Order deleted successfully')</script>";
    echo "<script>window.open('./index.php?list_orders','_self')</script>";
}
}
?>