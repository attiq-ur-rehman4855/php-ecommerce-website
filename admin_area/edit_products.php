<?php
include('../includes/connect.php');
?>

<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $select_data = "select * from `products` where product_id=$edit_id";
    $result_data = mysqli_query($con, $select_data);
    $row = mysqli_fetch_assoc($result_data);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brands_id = $row['brands_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];

    // fetching category
    $select_category = "select * from `categories` where category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_array($result_category);
    $category_title = $row_category['category_title'];

    // fetching brand
    $select_brand = "select * from `brands` where brands_id=$brands_id";
    $result_brand = mysqli_query($con, $select_brand);
    $row_brand = mysqli_fetch_array($result_brand);
    $brands_title = $row_brand['brands_title'];
}

?>

<div class="container-fluid d-flex align-items-center justify-content-center py-3">
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="card shadow-lg rounded p-4" style="width: 700px;">
                <h1 class="text-center mb-4">Edit Product</h1>
                <!-- form -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- title     -->
                    <div class="mb-3">
                        <label for="product_title" class="form-label">Product Title</label>
                        <input type="text" id="product_title" name="product_title" class="form-control " required value="<?php echo $product_title ?>">
                    </div>
                    <!-- description     -->
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <input type="text" id="product_description" name="product_description" class="form-control " required value="<?php echo $product_description ?>">
                    </div>
                    <!-- keyword     -->
                    <div class="mb-3">
                        <label for="product_keyword" class="form-label">Product keyword</label>
                        <input type="text" id="product_keyword" name="product_keyword" class="form-control " required value="<?php echo $product_keywords ?>">
                    </div>
                    <!-- category     -->
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Product category</label>
                        <select name="product_category" class="form-select" required>
                            <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                            <?php
                            $select_category_all = "select * from `categories`";
                            $result_category_all = mysqli_query($con, $select_category_all);
                            while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                                $category_title = $row_category_all['category_title'];
                                $category_id = $row_category_all['category_id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Brands     -->
                    <div class="mb-3">
                        <label for="product_brands" class="form-label">Product Brands</label>
                        <select name="product_brands" class="form-select" required>
                            <option value="<?php echo $brands_title ?>"><?php echo $brands_title ?></option>

                            <?php
                            $select_brands_all = "select * from `brands`";
                            $result_brands_all = mysqli_query($con, $select_brands_all);
                            while ($row_brands_all = mysqli_fetch_assoc($result_brands_all)) {
                                $brands_title = $row_brands_all['brands_title'];
                                $brands_id = $row_brands_all['brands_id'];
                                echo "<option value='$brands_id'>$brands_title</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- image1     -->
                    <div class="mb-3">
                        <label for="product_image1" class="form-label">Product Image1</label>
                        <div class="d-flex">
                            <input type="file" id="product_image1" name="product_image1" class="form-control ">
                            <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="image">
                        </div>
                    </div>
                    <!-- image2     -->
                    <div class="mb-3">
                        <label for="product_image2" class="form-label">Product Image2</label>
                        <div class="d-flex">
                            <input type="file" id="product_image2" name="product_image2" class="form-control ">
                            <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="image">
                        </div>
                    </div>

                    <!-- image3     -->
                    <div class="mb-3">
                        <label for="product_image3" class="form-label">Product Image3</label>
                        <div class="d-flex">
                            <input type="file" id="product_image3" name="product_image3" class="form-control">
                            <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="image">

                        </div>
                    </div>
                    <!-- price     -->
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price</label>
                        <input type="text" id="product_price" name="product_price" class="form-control " required value="<?php echo $product_price ?>">
                    </div>
                    <!-- Insert details     -->
                    <div class="text-center">
                        <input type="submit" name="edit_product" class="btn btn-info w-100" value="Update Product">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- editing product -->
<?php
$product_image1 = $product_image2 = $product_image3 = "";
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    $tmp_image1 = $_FILES['product_image1']['tmp_name'];
    $tmp_image2 = $_FILES['product_image2']['tmp_name'];
    $tmp_image3 = $_FILES['product_image3']['tmp_name'];

    // Check if new image1 is uploaded
    if (empty($product_image1)) {
        $product_image1 = $row['product_image1']; // Keep old image if new is not uploaded
    } else {
        move_uploaded_file($tmp_image1, "./product_images/$product_image1");
    }
    // Check if new image2 is uploaded
    if (empty($product_image2)) {
        $product_image2 = $row['product_image2']; // Keep old image if new is not uploaded
    } else {
        move_uploaded_file($tmp_image2, "./product_images/$product_image2");
    }
    // Check if new image3 is uploaded
    if (empty($product_image3)) {
        $product_image3 = $row['product_image3']; // Keep old image if new is not uploaded
    } else {
        move_uploaded_file($tmp_image3, "./product_images/$product_image3");
    }



    $update_product = "Update `products` set product_title='$product_title',product_description='$product_description',
    product_keywords='$product_keyword',category_id='$product_category',brands_id='$product_brands',
    product_image1='$product_image1',product_image2='$product_image2',product_image3='$product_image3'
    ,product_price='$product_price',date=NOW() where product_id=$edit_id";
    $result_update = mysqli_query($con, $update_product);
    if ($result_update) {
        echo "<script>alert('Product updated successfully')</>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}

?>