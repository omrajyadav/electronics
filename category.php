<?php
include 'db_connection.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub - Fashion Destination</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-hover: #0b5ed7;
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #198754;
            --danger-color: #dc3545;
            --border-radius: 0.75rem;
        }

        /* Banner Area */
        .banner_area {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.15) 0%, rgba(255, 255, 255, 1) 100%),
                url('uploads/categoryimg/img2.jpg') no-repeat center center;
            background-size: cover;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .banner_content {
            background: rgba(255, 255, 255, 0.9);
            padding: 3rem;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .banner_content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .banner_content p {
            font-size: 1.2rem;
            color: var(--secondary-color);
        }

        .page_link a {
            color: var(--primary-color);
            transition: all 0.3s;
        }

        .page_link a:hover {
            color: var(--primary-hover);
            text-decoration: none;
        }

        /* Category Cards */
        .category-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: all 0.3s;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-img-container {
            position: relative;
            overflow: hidden;
        }

        .card-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .category-card:hover .card-img {
            transform: scale(1.05);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .category-card:hover .card-overlay {
            opacity: 1;
        }

        .card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .card-text {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        /* Sidebar */
        .left_sidebar_area {
            padding: 30px;
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(235, 2, 2, 0.05);
        }

        .l_w_title h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }

        .l_w_title h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }

        .widgets_inner {
            margin-bottom: 2rem;
        }

        .widgets_inner ul.list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .widgets_inner ul.list li {
            margin-bottom: 10px;
        }

        .widgets_inner ul.list li a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: all 0.3s;
            display: block;
            padding: 8px 0;
        }

        .widgets_inner ul.list li a:hover,
        .widgets_inner ul.list li.active a {
            color: var(--primary-color);
            padding-left: 10px;
        }

        /* Product Top Bar */
        .product_top_bar {
            background: #fff;
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .sorting, .show {
            border: 1px solid #ddd;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            margin-right: 15px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .banner_content {
                padding: 2rem;
                text-align: center;
            }
            
            .banner_content h2 {
                font-size: 2rem;
            }
            
            .page_link {
                justify-content: center;
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!--================ Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>Shop Categories</h2>
              <p>Browse through our diverse product categories</p>
            </div>
            <div class="page_link">
              <a href="index.php">Home</a>
              <a href="category.php">Shop</a>
              <a href="category.php">Categories</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <div class="row flex-row-reverse">
          <div class="col-lg-9">
            <div class="product_top_bar">
              <div class="left_dorp">
                <select class="sorting">
                  <option value="1">Default sorting</option>
                  <option value="2">Sort by popularity</option>
                  <option value="3">Sort by average rating</option>
                  <option value="4">Sort by latest</option>
                  <option value="5">Sort by price: low to high</option>
                  <option value="6">Sort by price: high to low</option>
                </select>
                <select class="show">
                  <option value="1">Show 12</option>
                  <option value="2">Show 24</option>
                  <option value="3">Show 36</option>
                </select>
              </div>
            </div>
            
            <div class="latest_product_inner">
              <div class="row">
                <?php
                $query = "SELECT * FROM tbl_category";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        // $is_new = strtotime($row['created_at']) > strtotime('-30 days');
                        ?>
                        <div class="col-lg-4 col-md-6">
                          <div class="single-product category-card">
                            <div class="product-img card-img-container">
                              <img
                                class="card-img"
                                src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                                alt="<?= htmlspecialchars($row["name"]) ?>"
                              />
                              <div class="p_icon card-overlay">
                                <a href="view.php?id=<?= $id ?>">
                                  <i class="bi bi-eye"></i>
                                </a>
                                <a href="wishlist.php?id=<?= $id ?>">
                                  <i class="bi bi-heart"></i>
                                </a>
                                <a href="shop.php?id=<?= $id ?>">
                                  <i class="bi bi-cart"></i>
                                </a>
                              </div>
                              <?php  ?>
                                <span class="card-badge">New</span>
                              <?php  ?>
                            </div>
                            <div class="product-btm card-body">
                              <a href="shop.php?id=<?= $id ?>" class="d-block">
                                <h4><?= htmlspecialchars($row["name"]) ?></h4>
                              </a>
                              <div class="mt-3">
                                <p class="card-text"><?= htmlspecialchars($row["description"]) ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12 text-center py-5">
                              <div class="alert alert-info">No categories found.</div>
                            </div>';
                }
                ?>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Browse Categories</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <?php
                    $query = "SELECT * FROM tbl_category";
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li><a href="shop.php?id='.$row['id'].'">'.htmlspecialchars($row["name"]).'</a></li>';
                        }
                    } else {
                        echo '<li><a href="#">No categories found</a></li>';
                    }
                    ?>
                  </ul>
                </div>
              </aside>
<!-- 
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Product Filters</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <li class="active">
                      <a href="#">All Products</a>
                    </li>
                    <li>
                      <a href="#">New Arrivals</a>
                    </li>
                    <li>
                      <a href="#">Best Sellers</a>
                    </li>
                    <li>
                      <a href="#">On Sale</a>
                    </li>
                  </ul>
                </div>
              </aside> -->

              <!-- <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Price Filter</h3>
                </div>
                <div class="widgets_inner">
                  <div class="range_item">
                    <div id="slider-range"></div>
                    <div class="">
                      <label for="amount">Price : </label>
                      <input type="text" id="amount" readonly />
                    </div>
                  </div>
                </div> -->
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php
include 'footer.php';
?>