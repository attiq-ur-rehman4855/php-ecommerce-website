<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- bootstrap Css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <style>
    body {
      overflow-x: hidden;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .sidebar {
      background: #343a40;
      min-height: 100vh;
      color: white;
      padding: 20px 10px;
    }

    .sidebar a {
      color: #ddd;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      margin: 5px 0;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .sidebar a:hover {
      background: #17a2b8;
      color: #fff;
    }

    .sidebar .admin_image {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      border: 3px solid #17a2b8;
      margin-bottom: 10px;
    }

    .navbar {
      background-color: #17a2b8 !important;
    }

    .content-area {
      padding: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid p-0 m-0">
    <div class="row g-0">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 sidebar">
        <div class="text-center">
          <?php
          if (!isset($_SESSION['admin_name'])) {
            echo "<img src='./admin_images/men.PNG' class='admin_image'>";
            echo "<p class='mt-2'>Welcome Guest</p>";
          } else {
            $admin_name = $_SESSION['admin_name'];
            $select_admin = "select * from `admin_table` where admin_name='$admin_name'";
            $result_admin = mysqli_query($con, $select_admin);
            $row = mysqli_fetch_assoc($result_admin);
            $admin_image = $row['admin_image'];
            echo "<img src='./admin_images/$admin_image' class='admin_image'>";
            echo "<p class='mt-2'>Welcome <b>$admin_name</b></p>";
          }
          ?>
        </div>

        <hr class="text-white">

        <a href="index.php?insert_product"><i class="fa-solid fa-plus"></i> Insert Products</a>
        <a href="index.php?view_products"><i class="fa-solid fa-eye"></i> View Products</a>
        <a href="index.php?Insert_Categories"><i class="fa-solid fa-plus-circle"></i> Insert Categories</a>
        <a href="index.php?view_categories"><i class="fa-solid fa-list"></i> View Categories</a>
        <a href="index.php?Insert_Brands"><i class="fa-solid fa-plus-square"></i> Insert Brands</a>
        <a href="index.php?view_brands"><i class="fa-solid fa-tags"></i> View Brands</a>
        <a href="index.php?list_orders"><i class="fa-solid fa-box"></i> All Orders</a>
        <a href="index.php?list_payment"><i class="fa-solid fa-credit-card"></i> All Payments</a>
        <a href="index.php?list_users"><i class="fa-solid fa-users"></i> List Users</a>
        <a href="admin_logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      </div>

      <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-0 m-0">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark w-100">
          <div class="container-fluid p-0">
            <a class="navbar-brand ms-3" href="#">Admin Dashboard</a>
            <div>
              <ul class="navbar-nav">
                <?php
                if (!isset($_SESSION['admin_name'])) {
                  echo "<li class='nav-item'><a class='nav-link' href='admin_login.php'>Login</a></li>";
                } else {
                  $admin_name = $_SESSION['admin_name'];
                  $get_admin_data = "select * from `admin_table` where admin_name='$admin_name'";
                  $result = mysqli_query($con, $get_admin_data);
                  $row = mysqli_fetch_assoc($result);
                  $admin_id = $row['admin_id'];
                  echo "<li class='nav-item'><a class='nav-link' href='edit_admin_account.php?admin_id=$admin_id'>Edit My Account</a></li>";
                }
                ?>
              </ul>
            </div>
          </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
          <?php
         
          if (isset($_GET['Insert_Categories'])) {
            include('Insert_Categories.php');
          }
          if (isset($_GET['insert_product'])) {
            include('insert_product.php');
          }
          if (isset($_GET['Insert_Brands'])) {
            include('Insert_Brands.php');
          }
          if (isset($_GET['view_products'])) {
            include('view_products.php');
          }
          if (isset($_GET['edit_products'])) {
            include('edit_products.php');
          }
          if (isset($_GET['delete_products'])) {
            include('delete_product.php');
          }
          if (isset($_GET['view_categories'])) {
            include('view_categories.php');
          }
          if (isset($_GET['view_brands'])) {
            include('view_brands.php');
          }
          if (isset($_GET['edit_category'])) {
            include('edit_category.php');
          }
          if (isset($_GET['edit_brand'])) {
            include('edit_brand.php');
          }
          if (isset($_GET['delete_category'])) {
            include('delete_category.php');
          }
          if (isset($_GET['delete_brand'])) {
            include('delete_brand.php');
          }
          if (isset($_GET['list_orders'])) {
            include('list_orders.php');
          }
          if (isset($_GET['delete_order'])) {
            include('delete_order.php');
          }
          if (isset($_GET['list_payment'])) {
            include('list_payment.php');
          }
          if (isset($_GET['delete_payment'])) {
            include('delete_payment.php');
          }
          if (isset($_GET['list_users'])) {
            include('list_users.php');
          }
          if (isset($_GET['delete_users'])) {
            include('delete_users.php');
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
