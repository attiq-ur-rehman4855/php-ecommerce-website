<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_payment = "select * from `user_payments`";
        $result_payment = mysqli_query($con, $get_payment);
        $row_count = mysqli_num_rows($result_payment);
        echo "<tr class='text-center'>
                <th>SI no</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment mode</th>
                <th>Order Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No payments received yet!</h2>";
        } else {
            $number = 0;
            while ($row = mysqli_fetch_assoc($result_payment)) {
                $payment_id = $row['payment_id'];
                $order_id = $row['order_id'];
                $invoice_number = $row['invoice_number'];
                $amount = $row['amount'];
                $payment_mode = $row['payment_mode'];
                $date = $row['date'];
                $number++;
                echo "<tr class='text-center'>
                        <td> $number </td>
                        <td> $invoice_number </td>
                        <td> $amount </td>
                        <td> $payment_mode </td>
                        <td> $date </td>
                        <td><a href='index.php?delete_payment=$payment_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>";
            }
        }
        ?>





        </tbody>
</table>