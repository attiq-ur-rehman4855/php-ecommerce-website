<?php
if(isset($_GET['delete_users']))
{
$user_id=$_GET['delete_users'];
$delete_query="delete from `user_table` where user_id=$user_id";
$result_delete=mysqli_query($con,$delete_query);
if($result_delete)
{
    echo "<script>alert('User deleted successfully')</script>";
    echo "<script>window.open('./index.php?list_users','_self')</script>";
}
}
?>