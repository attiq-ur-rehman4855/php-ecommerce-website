<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
    // accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    // accessing images tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];
    // checking conditions
    if ($product_title == '' || $product_description == '' || $product_keywords == '' || $product_categories == '' || $product_brands == '' || $product_price == '' || $product_image1 == '' || $product_image2 == '' || $product_image3 == '') {
        echo "<script>alert('Please fill all the fields')</script>";
        // exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");
        // insert query
        $insert_products = "insert into `products`
        (product_title,product_description,product_keywords,category_id,brands_id,product_image1,
        product_image2,product_image3,product_price,date,status)
        values ('$product_title','$product_description','$product_keywords',
        '$product_categories','$product_brands','$product_image1','$product_image2','$product_image3',
        '$product_price',NOW(),'$product_status')";
        $result_query = mysqli_query($con, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS file link -->
    <link rel="stylesheet" href="../assets/CSS/style.CSS" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-center my-4">
        <div class="card shadow p-4 " style="width: 500px;">
            <h1 class="text-center">Insert Products</h1>
            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data">
                <!-- title -->
                <div class="form-outline mb-3">
                    <label for="product_title" class="form-label">Product title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required>
                </div>
                <!-- description     -->
                <div class="form-outline mb-3">
                    <label for="product_description" class="form-label">Product description</label>
                    <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required>
                </div>
                <!-- keywords     -->
                <div class="form-outline mb-3">
                    <label for="product_keywords" class="form-label">Product keywords</label>
                    <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required>
                </div>
                <!-- categories     -->
                <div class="form-outline mb-3">
                    <select name="product_category" id="" class="form-select ">
                        <option value=""> Select a category</option>
                        <?php
                        $select_query = "Select * from `categories`";
                        $result_query = mysqli_query($con, $select_query);
                        while ($row_data = mysqli_fetch_assoc($result_query)) {
                            $category_title = $row_data['category_title'];
                            $category_id = $row_data['category_id'];
                            echo "<option value='$category_id' required>$category_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Brands     -->
                <div class="form-outline mb-3">
                    <select name="product_brands" id="" class="form-select ">
                        <option value=""> Select a Brands</option>
                        <?php
                        $select_query = "Select * from `brands`";
                        $result_query = mysqli_query($con, $select_query);
                        while ($row_data = mysqli_fetch_assoc($result_query)) {
                            $brand_title = $row_data['brands_title'];
                            $brand_id = $row_data['brands_id'];
                            echo "<option value='$brand_id' required>$brand_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- image 1     -->
                <div class="form-outline mb-3">
                    <label for="product_image1" class="form-label">Product image 1 </label>
                    <input type="file" name="product_image1" id="product_image1" class="form-control" required>
                </div>
                <!-- image 2     -->
                <div class="form-outline mb-3">
                    <label for="product_image2" class="form-label">Product image 2</label>
                    <input type="file" name="product_image2" id="product_image2" class="form-control" required>
                </div>
                <!-- image 3     -->
                <div class="form-outline mb-3">
                    <label for="product_image3" class="form-label">Product image 3</label>
                    <input type="file" name="product_image3" id="product_image3" class="form-control" required>
                </div>
                <!-- Price     -->
                <div class="form-outline mb-3">
                    <label for="product_price" class="form-label">Product price</label>
                    <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required>
                </div>
                <!-- Insert product     -->
                <div class="form-outline mb-3">
                    <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3 form-control" value="Insert Products">
                </div>
            </form>
        </div>
    </div>

    <!-- bootsrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>