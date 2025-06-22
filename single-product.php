<?php
include "header.php";
include "db_connection.php";
$product_id = $_GET["id"];
$query = "SELECT * FROM  `tbl_product` WHERE `id`= $product_id ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>
<!-- <bootstrap icons > -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<section class="py-5 bg-light">
  <div class="card border-0 shadow-lg">
    <div class="row g-0">
      <div class="col-md-6 d-flex align-items-center bg-white p-4">
        <img src="./admin/uploads/categoryimg/<?= $row["image"] ?>" class="img-fluid rounded-3 me-3"
          style="width: 80px; height: 80px; object-fit: cover;">
      </div>
      <div class="col-md-6 d-flex align-items-center bg-white p-4">
        <h1 class="fw-bold mb-3"><?= $row["name"] ?></h1>
        <div class="d-flex align-items-center mb-3">
          <h3 class="text-success fw-semibold mb-0"><?= $row["sale_price"] ?>RS</h3>
          <span class="text-muted text-decoration-line-through ms-3 fs-5"><?= $row['MRP'] ?>RS</span>
          <span class="badge bg-danger ms-3 px-3 py-2 fs-6"><?= $row['discount_percentaged'] ?>%OFF</span>
        </div>
        <div class="mb-3 text-warning fs-5">
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i> 
          <i class="bi bi-star-half"></i>
          <span class="text-muted  small ms-2">(400+Review)</span>
        </div>
        <p class="text-secondary mb-4 fs-6 lh-base">
          <?= $row["description"] ?>
        </p>
      </div>
    </div>







</section>