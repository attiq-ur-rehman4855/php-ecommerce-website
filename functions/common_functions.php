<?php
// including connect file
// include('./includes/connect.php');
// getting products  function
function getproducts()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "Select * from `products` order by rand() LIMIT 0,9";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brands_id = $row['brands_id'];
                echo "
                            <div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        
                                        <p class='card-text'>Price $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                    </div>
                                </div>
                            </div>";
            }
        }
    }
}
// getting all products
function getting_all_products()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "Select * from `products` order by rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brands_id = $row['brands_id'];
                echo "
                            <div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        
                                        <p class='card-text'>Price $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                    </div>
                                </div>
                            </div>";
            }
        }
    }
}
// displaying unique catgory
function get_unique_catgories()
{
    global $con;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "Select * from `products` where category_id=$category_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h1 class='text-center text-danger'>No stocks for this category</h1>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brands_id = $row['brands_id'];
            echo "
                            <div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>Price $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                    </div>
                                </div>
                            </div>";
        }
    }
}
// displaying unique brand
function get_unique_brands()
{
    global $con;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "Select * from `products` where brands_id=$brand_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h1 class='text-center text-danger'>This brand is not available for service</h1>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brands_id = $row['brands_id'];
            echo "
                            <div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>Price $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                    </div>
                                </div>
                            </div>";
        }
    }
}

// displaying brands in sidenavbar
function getbrands()
{
    global $con;
    $select_brands = "Select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);
    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brands_title'];
        $brand_id = $row_data['brands_id'];
        echo "<li class='nav-item'>
                    <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                </li>";
    }
}
// displaying categories in sidenavbar
function getcategories()
{
    global $con;
    $select_categories = "Select * from `categories`";
    $result_categories = mysqli_query($con, $select_categories);
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item'>
                    <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                </li>";
    }
}
// getting searching products function  
function search_product()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "Select * from `products` where product_keywords like'%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h1 class='text-center text-danger'>No results match. No products found on this category</h1>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brands_id = $row['brands_id'];
            echo "
            <div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                                                        
                                <p class='card-text'>Price $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                            </div>
                    </div>
            </div>";
        }
    }
}
// view details function
function view_details()
{
    global $con;
    if (isset($_GET['product_id']) && !isset($_GET['category']) && !isset($_GET['brand'])) {
        $product_id = $_GET['product_id'];
        $select_query = "SELECT * FROM `products` WHERE product_id = $product_id";
        $result_query = mysqli_query($con, $select_query);

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_image2 = $row['product_image2'];
            $product_image3 = $row['product_image3'];
            $product_price = $row['product_price'];

            echo "
            <div class='container my-5'>
                <div class='row g-4'>
                    <!-- Left side images -->
                    <div class='col-md-6'>
                        <div class='card shadow border-0 p-3'>
                            <img id='mainImage' src='./admin_area/product_images/$product_image1' 
                                 class='img-fluid rounded mb-3' 
                                 alt='$product_title' style='max-height:450px; object-fit:contain;'>
                            <div class='d-flex justify-content-center gap-3'>
                                <img src='./admin_area/product_images/$product_image1' 
                                     class='thumb-img rounded border' 
                                     style='width:90px; height:90px; cursor:pointer; object-fit:contain;'
                                     onclick=\"document.getElementById('mainImage').src=this.src\">
                                <img src='./admin_area/product_images/$product_image2' 
                                     class='thumb-img rounded border' 
                                     style='width:90px; height:90px; cursor:pointer; object-fit:contain;'
                                     onclick=\"document.getElementById('mainImage').src=this.src\">
                                <img src='./admin_area/product_images/$product_image3' 
                                     class='thumb-img rounded border' 
                                     style='width:90px; height:90px; cursor:pointer; object-fit:contain;'
                                     onclick=\"document.getElementById('mainImage').src=this.src\">
                            </div>
                        </div>
                    </div>

                    <!-- Right side details -->
                    <div class='col-md-6'>
                        <div class='card shadow border-0 p-4 h-100'>
                            <h2 class='fw-bold text-dark mb-3'>$product_title</h2>
                            <h4 class='text-info mb-3'>Rs $product_price/-</h4>
                            <p class='text-muted mb-4'>$product_description</p>

                            <div class='d-flex gap-3'>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info px-4'>
                                    <i class='fa fa-cart-plus me-2'></i>Add to Cart
                                </a>
                                <a href='index.php' class='btn btn-outline-secondary px-4'>
                                    <i class='fa fa-home me-2'></i>Go Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }
}


// getting IP address funciotn
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip; 

// cart function 
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_address = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "select * from `cart_details` where ip_address='$get_ip_address' and
        product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present inside cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query = "insert into `cart_details` (product_id ,ip_address,quantity) 
            values($get_product_id,'$get_ip_address',0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('Item successfully added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
// function to get cart item numbers
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_address = getIPAddress();
        $select_query = "select * from `cart_details` where ip_address='$get_ip_address'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $con;
        $get_ip_address = getIPAddress();
        $select_query = "select * from `cart_details` where ip_address='$get_ip_address'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}
// total price function 
function total_cart_price()
{
    global $con;
    $get_ip_address = getIPAddress();
    $total_price = 0;
    $cart_query = "select * from `cart_details` where ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $select_products = "select * from `products` where product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}

// get user order details
function get_user_order_detail()
{
    global $con;
    $username = $_SESSION['username'];
    $get_details = "select * from `user_table` where user_name='$username'";
    $result_query = mysqli_query($con, $get_details);
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "select * from `user_orders` where user_id='$user_id' and order_status='pending'";
                    $result_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
                    if ($row_count > 0) {
                        echo "<h3 class=' text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                        <p class=''><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                    } else {
                        echo "<h3 class=' text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class=''><a href='../index.php' class='text-dark'>Explore Products</a></p>";
                    }
                }
            }
        }
    }
}
