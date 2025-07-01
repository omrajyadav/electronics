<head>
  <?php session_start(); ?>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser Ecommerce</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #2a2a2a;
      --accent-color: #d4a373;
      --light-color: #f8f9fa;
      --dark-color: #212529;
    }

    .top-bar {
      background-color: var(--primary-color);
      color: white;
      padding: 8px 0;
      font-size: 0.9rem;
    }

    .top-bar a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: color 0.3s;
    }

    .top-bar a:hover {
      color: white;
    }

    .navbar {
      padding: 15px 0;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      height: 40px;
    }

    .nav-link {
      color: var(--primary-color);
      font-weight: 500;
      padding: 8px 15px !important;
      transition: all 0.3s;
    }

    .nav-link:hover,
    .nav-link.active {
      color: var(--accent-color);
    }

    .dropdown-menu {
      border: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
      padding: 8px 20px;
    }

    .dropdown-item:hover {
      background-color: rgba(212, 163, 115, 0.1);
      color: var(--accent-color);
    }

    .icon-badge {
      position: absolute;
      top: -8px;
      right: -8px;
      width: 20px;
      height: 20px;
      background-color: var(--accent-color);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      font-weight: bold;
    }

    .nav-icon {
      font-size: 1.3rem;
      color: var(--primary-color);
      position: relative;
      margin: 0 10px;
      transition: color 0.3s;
    }

    .nav-icon:hover {
      color: var(--accent-color);
    }

    @media (max-width: 991.98px) {
      .navbar-collapse {
        background-color: white;
        padding: 20px;
        margin-top: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .nav-item {
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<header>
  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="d-flex gap-4">
            <span><i class="fas fa-phone-alt me-2"></i> +01 256 25 235</span>
            <span><i class="fas fa-envelope me-2"></i> info@eiser.com</span>
          </div>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex gap-4 justify-content-md-end">
            <a href="cart.html"><i class="fas fa-gift me-2"></i> Gift Card</a>
            <a href="trake.php"><i class="fas fa-truck me-2"></i> Track Order</a>
            <a href="contact.php"><i class="fas fa-phone me-2"></i> Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="">
        <img src="img/logo.png" alt="Eiser Logo" class="img-fluid">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Pages
            </a>
            <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
              <!-- <li><a class="dropdown-item" href="trake.php">Tracking</a></li> -->
              <!-- <li><a class="dropdown-item" href="category.php">Shop Category</a></li> -->
              <li><a class="dropdown-item" href="checkout.php">Product Checkout</a></li>
              <li><a class="dropdown-item" href="cart_add.php">Shopping Cart</a></li>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>

        <div class="d-flex align-items-center">
          <a href="cart_add.php" class="nav-icon position-relative">
            <i class="fas fa-shopping-cart"></i>
            <?php
            include_once "db_connection.php";
            $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '0';
            $select = "SELECT COALESCE(SUM(cart_qty), 0) as total_count FROM tbl_cart WHERE cart_customer_id='$customer_id'";
            $findingtotal = mysqli_query($conn, $select);
            $test = mysqli_fetch_array($findingtotal);
            if ($test["total_count"] > 0): ?>
              <span class="icon-badge"><?= $test["total_count"] ?></span>
            <?php endif; ?>
          </a>

          <a href="wishlist.php" class="nav-icon position-relative">
            <i class="fas fa-heart"></i>
            <?php
            include "db_connection.php";
            $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 0;
            $select = "SELECT count(*) as total_count FROM tbl_wishlist WHERE wishlist_customer_id='$customer_id'";
            $findingtotal = mysqli_query($conn, $select);
            $test = mysqli_fetch_array($findingtotal);
            if ($test["total_count"] > 0): ?>
              <span class="icon-badge"><?= $test["total_count"] ?></span>
            <?php endif; ?>
          </a>

          <a href="login.php" class="nav-icon">
            <i class="fas fa-user"></i>
          </a>

          <a href="order_hister.php" class="nav-icon">
            <i class="fas fa-history"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>