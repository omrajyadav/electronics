<?php
include "header.php";
include "db_connection.php";
include "sidebar.php";
// Fetch counts
$product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_product"))['count'];
$category_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_category"))['count'];
$order_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_order_master"))['count'];
$customer_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_customer"))['count'];
?>
<div class="content-wrapper" style="background: #f4f6f9; min-height: 100vh ;">
  <div class="container-fluid mt-4">
    <h2 class="fw-bold mb-4 text-dark">Dashboard</h2>
    <div class="row g-4 mb-5">
      <div class="col-md-3">
        <div class="card dashboard-card shadow-sm border-0 bg-primary text-white  mx-3 h-90">
          <div class="card-body d-flex align-items-center">
            <i class="fas fa-box fa-2x me-3"></i>
            <div>
              <h6 class="mb-0">Products</h6>
              <h3 class="fw-bold mb-0"><?= $product_count ?></h3>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div class="col-md-3">
        <div class="card dashboard-card shadow-sm border-0 bg-success text-white mx-3 h-90">
          <div class="card-body d-flex align-items-center">
            <i class="fas fa-layer-group fa-2x me-3"></i>
            <div>
              <h6 class="mb-0">Categories</h6>
              <h3 class="fw-bold mb-0"><?= $category_count ?></h3>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div class="col-md-3">
        <div class="card dashboard-card shadow-sm border-0 bg-warning text-white mx-3 h-90">
          <div class="card-body d-flex align-items-center">
            <i class="fas fa-shopping-cart fa-2x me-3"></i>
            <div>
              <h6 class="mb-0">Orders</h6>
              <h3 class="fw-bold mb-0"><?= $order_count ?></h3>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div class="col-md-3">
        <div class="card dashboard-card shadow-sm border-0 bg-info text-white mx-3 h-90">
          <div class="card-body d-flex align-items-center">
            <i class="fas fa-users fa-2x me-3"></i>
            <div>
              <h6 class="mb-0">Customers</h6>
              <h3 class="fw-bold mb-0"><?= $customer_count ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
  </div>
</div>
<style>
  .dashboard-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border-radius: 1rem;
  }

  .dashboard-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 2;
  }

  .dashboard-card i {
    font-size: 2.5rem;
    opacity: 0.85;
  }

  @media (max-width: 767px) {
    .dashboard-card i {
      font-size: 2rem;
    }

    .dashboard-card h3 {
      font-size: 1.5rem;
    }
  }
</style>
<?php
include "footer.php";
?>