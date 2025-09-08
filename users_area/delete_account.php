<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center mt-5">
        <div class="rounded p-4" style="width: 500px;">
            <h1 class="text-center mb-4">Delete Account</h1>
            <!-- form -->
            <form action="" method="POST">
                <div class="mb-3 form-outline">
                    <input type="submit" class="form-control" name="delete" value="Delete Account">
                </div>
                <div class="mb-3 form-outline">
                    <input type="submit" class="form-control" name="dont_delete" value="Don't Delete Account">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
$username_session = $_SESSION['username'];
if(isset($_POST['delete']))
{
    $delete_query="Delete from `user_table` where user_name='$username_session'";
    $result_query=mysqli_query($con,$delete_query); 
    if($delete_query){
        session_destroy();
        echo"<script>alert('Account Deleted Successfully')</script>";
        echo"<script>window.open('../index.php','_self')</script>";
    }  
}
if(isset($_POST['dont_delete']))
{
    echo"<script>window.open('profile.php','_self')</script>";

}

?>