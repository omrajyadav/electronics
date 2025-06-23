<head>
  <?php
  session_start()
    ?>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="vendors/linericon/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<header class="header_area">
  <div class="top_menu">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="float-left">
            <p>Phone: +01 256 25 235</p>
            <p>email: info@eiser.com</p>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="float-right">
            <ul class="right_side">
              <li>
                <a href="cart.html">
                  gift card
                </a>
              </li>
              <li>
                <a href="tracking.html">
                  track order
                </a>
              </li>
              <li>
                <a href="contact.html">
                  Contact Us
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main_menu">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light w-100">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="index.html">
          <img src="img/logo.png" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
          <div class="row w-100 mr-0">
            <div class="col-lg-7 pr-0">
              <ul class="nav navbar-nav center_nav pull-right">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item active">
                    <a class="nav-link" href="shop.php">shop</a>
                  </li>
                  <!-- <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Blog</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="blog.html">Blog</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="single-blog.html">Blog Details</a>
                      </li>
                    </ul>
                  </li> -->
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="trake.php">Tracking</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="category.php">Shop Category</a>
                      </li>
                      <!-- <li class="nav-item">
                      <a class="nav-link" href="single-product.php">Product Details</a>
                    </li> -->
                      <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Product Checkout</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="cart_add.php">Shopping Cart</a>
                      </li>
                      <!-- <li class="nav-item">
                        <a class="nav-link" href="elements.html">Elements</a>
                      </li> -->
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                  </li>
                </ul>
            </div>

            <div class="col-lg-5 pr-0">
              <ul class="nav navbar-nav navbar-right right_nav pull-right">


                <a href="cart_add.php" class="position-relative me-4 my-auto">
                  <i class="fa fa-shopping-cart fa-2x"></i>
                  <?php
                  include_once "db_connection.php";
                  $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '0';
                  $select = "SELECT COALESCE(SUM(cart_qty), 0) as total_count FROM tbl_cart WHERE cart_customer_id='$customer_id'";
                  $findingtotal = mysqli_query($conn, $select);
                  $test = mysqli_fetch_array($findingtotal);
                  ?>
                  <span class="badge text-dark border-dark rounded-circle" style="">
                    <?= $test["total_count"] ?>
                  </span>
                </a>


                <li class="nav-item">
                  <a href="wishlist.php" class="icons">
                    <i class="ti-heart" aria-hidden="true"></i>
                    <?php
                    include "db_connection.php";
                    $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 0;
                    $select = "SELECT count(*) as total_count FROM tbl_wishlist WHERE  wishlist_customer_id='$customer_id'";
                    $findingtotal = mysqli_query($conn, $select);
                    $test = mysqli_fetch_array($findingtotal);
                    ?>
                    <span class="badge text-dark border-dark rounded-circle" style="">
                      <?= $test["total_count"] ?>
                    </span>
                  </a>
                </li>

                <li class="nav-item" class="mx-2;">
                  <a href="login.php" class="icons">
                    <i class="ti-user mx-3" aria-hidden="true" style="margin-top:20px;"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="order_hister.php" class="icons">
                    <i class="ti-heart" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>