<?php
include('../includes/connect.php');
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data="select * from `user_orders` where order_id=$order_id";
    $result=mysqli_query($con,$select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];
}
if(isset($_POST['confirm_payment']))
{
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into `user_payments`(order_id,invoice_number,amount,payment_mode) values($order_id,$invoice_number,$amount,'$payment_mode')";
    $result_query=mysqli_query($con,$insert_query);
    if($result_query)
    {
        echo "<script>alert('Successfully completed the payment')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);



}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="bg-secondary">
    <div class="container-fluid d-flex align-items-center justify-content-center mt-5">
        <div class="card shadow rounded p-4" style="width: 300px;">
            <h1 class="text-center mb-4">Confirm Payment</h1>
            <!-- form -->
            <form action="" method="POST">
                <div class="mb-3 form-outline">
                    <input type="text" class="form-control" name="invoice_number" value="<?php echo  $invoice_number ?>">
                </div>
                <div class="mb-3 form-outline">
                    <label for="" class="form-label">Amount</label>
                    <input type="text" class="form-control" name="amount" value="<?php echo  $amount_due ?>">
                </div>
                <div class="mb-3 form-outline">
                    <select name="payment_mode" class="form-select" >
                        <option>Select Payment Mode</option>
                        <option>UPI</option>
                        <option>Netbanking</option>
                        <option>Cash on Delivery</option>
                        <option>Payoffline</option>
                    </select>
                </div>
                <div class="text-center">
                    <input type="submit" value="Confirm" name="confirm_payment" class="btn btn-info w-100" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>