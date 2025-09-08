<?php
if(isset($_GET['delete_payment']))
{
$payment_id=$_GET['delete_payment'];
$delete_query="delete from `user_payments` where payment_id=$payment_id";
$result_delete=mysqli_query($con,$delete_query);
if($result_delete)
{
    echo "<script>alert('Payment deleted successfully')</script>";
    // echo "<script>window.open('./index.php?delete_payment','_self')</script>";// error ki wja se comment kia hy
    echo "<script>window.open('./index.php','_self')</script>";
}
}
?>