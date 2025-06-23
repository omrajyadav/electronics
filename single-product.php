<?php
include "db_connection.php";
include "header.php";

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  $query = "SELECT * FROM tbl_product WHERE id = $id";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_array($result)) {
    // Calculate sale price if not stored in database
    if (!isset($row["sale_price"]) || empty($row["sale_price"])) {
      $discount_value = $row["MRP"] * ($row["discount_percentaged"] / 100);
      $sale_price = $row["MRP"] - $discount_value;
    } else {
      $sale_price = $row["sale_price"];
    }
  } else {
    $_SESSION["warning"] = "No product found with this ID.";
    echo "<script>window.location.href='product_list.php'</script>";
  }
} else {
  $_SESSION["warning"] = "Invalid product ID.";
}
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2><?= htmlspecialchars($row["name"]) ?></h2>
          <p>Product Details</p>
        </div>
        <div class="page_link">
          <a href="index.php">Home</a>
          <a href="product_list.php">Products</a>
          <a href="product_details.php?id=<?= $id ?>">Details</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
        <div class="s_product_img">
          <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <!-- <li data-target="#productCarousel" data-slide-to="0" class="active">
                                <img src="uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>" alt="Product thumbnail">
                            </li> -->
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                  alt="Product image">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3><?= htmlspecialchars($row["name"]) ?></h3>

          <div class="price-box">
            <?php if ($row["discount_percentaged"] > 0): ?>
              <h2 class="sale-price">RS<?= number_format($sale_price, 2) ?></h2>
              <h4 class="original-price"><del>RS<?= number_format($row["MRP"], 2) ?></del></h4>
              <span class="discount-badge"><?= $row["discount_percentaged"] ?>% OFF</span>
            <?php else: ?>
              <h2>RS<?= number_format($row["MRP"], 2) ?></h2>
            <?php endif; ?>
          </div>

          <div class="mb-3 text-warning fs-5">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
            <span class="text-muted small ms-2">(400+ Review)</span>
          </div>

          <ul class="list">
            <li>
              <a class="active" href="#">
                <span>Category</span> : <?= htmlspecialchars($row["name"]) ?>
              </a>
            </li>
            <li>
              <a href="#"><span>Availability</span> : In Stock</a>
            </li>
          </ul>

          <p><?= htmlspecialchars($row["description"]) ?></p>

          <div class="product_count">
            <label for="qty">Quantity:</label>
            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
            <button
              onclick="var result = document.getElementById('sst'); var sst = result.value; if(!isNaN(sst)) result.value++;return false;"
              class="increase items-count" type="button">
              <i class="lnr lnr-chevron-up"></i>
            </button>
            <button
              onclick="var result = document.getElementById('sst'); var sst = result.value; if(!isNaN(sst) &amp;&amp; sst > 0) result.value--;return false;"
              class="reduced items-count" type="button">
              <i class="lnr lnr-chevron-down"></i>
            </button>
          </div>

          <div class="card_area d-flex gap-3">
            <form action="cart_insert.php" method="post" class="flex-grow-1">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <input type="hidden" name="cart_qty" value="1" id="cart_qty">
              <button type="submit" class="main_btn w-100">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
            </form>
            <form action="wishlist_insert.php" method="post">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" class="icon_btn">
                <i class="bi bi-heart"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--================End Single Product Area =================-->

<?php
include "footer.php";
?>