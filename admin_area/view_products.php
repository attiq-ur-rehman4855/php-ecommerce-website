<?php
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .image {
        width: 50px;
        height: 70px;
        object-fit: contain;
    }
</style>

<body>
    <h1 class="text-center text-success">All products</h1>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_products = "select * from `products`";
            $get_result = mysqli_query($con,$get_products);
            $number = 0;
            while ($row = mysqli_fetch_assoc($get_result)) {

                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $status = $row['status'];
                $number++;
            ?>
                <tr class='text-center'>
                    <td><?php echo $number ?></td>
                    <td><?php echo $product_title ?></td>
                    <td><img src='./product_images/<?php echo $product_image1 ?>' class='image' /></td>
                    <td><?php echo $product_price ?></td>
                    <td>
                        <?php
                        $get_count = "Select * from `orders_pending` where product_id=$product_id";
                        $result_count = mysqli_query($con,$get_count);
                        $rows_count = mysqli_num_rows($result_count);
                        echo $rows_count;
                        ?>

                    </td>
                    <td><?php echo $status ?></td>
                    <td><a href='index.php?edit_products=<?php echo  $product_id  ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='index.php?delete_products=<?php echo  $product_id  ?>' type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $product_id; ?>" class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <!-- Modal -->
      <div class="modal fade" id="deleteModal<?php echo $product_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <h4>Are you sure you want to delete this?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <a href="index.php?view_products" class="text-light text-decoration-none">No</a></button>
              <button type="button" class="btn btn-primary"> <a href='index.php?delete_products=<?php echo $product_id ?>' class="text-light text-decoration-none">Yes</a></button>
            </div>
          </div>
        </div>
      </div>
            <?php
            }
            ?>

        </tbody>
    </table>
   
</body>

</html>