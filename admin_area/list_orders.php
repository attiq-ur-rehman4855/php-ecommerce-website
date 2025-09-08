<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_orders = "select * from `user_orders`";
        $result_orders = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result_orders);
        echo "<tr class='text-center'>
                <th>SI no</th>
                <th>Due Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No orders yet!</h2>";
        } else {
            $number = 0;
            while ($row = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row['order_id'];
                $user_id = $row['user_id'];
                $amount_due = $row['amount_due'];
                $invoice_number = $row['invoice_number'];
                $total_products = $row['total_products'];
                $order_date = $row['order_date'];
                $order_status = $row['order_status'];
                $number++;
                echo "<tr class='text-center'>
                        <td> $number </td>
                        <td> $amount_due </td>
                        <td> $invoice_number </td>
                        <td> $total_products </td>
                        <td> $order_date </td>
                        <td> $order_status </td>
                        <td><a href='index.php?delete_order=$order_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>";
            }
        }
        ?>





        </tbody>
</table>