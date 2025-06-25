<?php
include "header.php";
include "db_connection.php";
?>
<div class="form-inline mb-3">
    <div class="input-group" data-widget="search">
        <form method="GET" action="shop.php" class="d-flex">
            <input class="form-control" name="name" value="<?= isset($_GET["name"]) ? $_GET["name"] : "" ?>
           " type="search" placeholder="search">
        </form>
        
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div class="container-fluid py-5" style="margin-top: 80px;">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 fw-bold">Filters</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-uppercase small">Price Range</h6>
                        <div class="list-group list-group-flush">
                            <a href="shop.php"
                                class="list-group-item list-group-item-action border-0 rounded mb-2 <?= !isset($_GET['min_range']) ? 'active bg-light' : '' ?>">
                                <div class="d-flex justify-content-between">
                                    <span>All Prices</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=100&max_range=1000"
                                class="list-group-item list-group-item-action border-0 rounded mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>₹100 - ₹1,000</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=1010&max_range=6000"
                                class="list-group-item list-group-item-action border-0 rounded mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>₹1,010 - ₹6,000</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=6010&max_range=9999"
                                class="list-group-item list-group-item-action border-0 rounded mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>₹6,010 - ₹9,999</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=10000&max_range=30000"
                                class="list-group-item list-group-item-action border-0 rounded mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>₹10,000 - ₹30,000</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=31000&max_range=60000"
                                class="list-group-item list-group-item-action border-0 rounded">
                                <div class="d-flex justify-content-between">
                                    <span>₹31,000 - ₹60,000</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=61000&max_range=80000"
                                class="list-group-item list-group-item-action border-0 rounded">
                                <div class="d-flex justify-content-between">
                                    <span>₹61,000 - ₹80,000</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=81000&max_range=100000"
                                class="list-group-item list-group-item-action border-0 rounded">
                                <div class="d-flex justify-content-between">
                                    <span>₹81,000 - ₹1,000,00</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                            <a href="shop.php?min_range=100000&max_range=800000"
                                class="list-group-item list-group-item-action border-0 rounded">
                                <div class="d-flex justify-content-between">
                                    <span>₹1,00,000 - ₹8,00,000</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 col-md-8">
            <section class="product-section">
                <!-- Category Navigation -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="shop.php"
                                class="btn btn-sm px-3 rounded-pill <?= !isset($_GET['id']) ? 'btn-dark' : 'btn-outline-dark' ?>">
                                All Products
                            </a>
                            <?php
                            $cat_query = "SELECT * FROM tbl_category";
                            $cat_result = mysqli_query($conn, $cat_query);
                            while ($cat = mysqli_fetch_assoc($cat_result)) {
                                $active = (isset($_GET['id']) && $_GET['id'] == $cat['id']) ? 'btn-dark' : 'btn-outline-dark';
                                echo '<a href="shop.php?id=' . $cat['id'] . '" class="btn btn-sm px-3 rounded-pill ' . $active . '">' . $cat['name'] . '</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row g-4">
                    <?php
                    $where = [];
                    if (isset($_GET["id"])) {
                        $catId = intval($_GET["id"]);
                        $where[] = "category = $catId";
                    }
                    if (isset($_GET["min_range"]) && is_numeric($_GET["min_range"])) {
                        $min_range = intval($_GET["min_range"]);
                        $where[] = "sale_price >= $min_range";
                    }
                    if (isset($_GET["max_range"]) && is_numeric($_GET["max_range"])) {
                        $max_range = intval($_GET["max_range"]);
                        $where[] = "sale_price <= $max_range";
                    }
                    $query = "SELECT * FROM tbl_product";
                    if (!empty($where)) {
                        $query .= " WHERE " . implode(" AND ", $where);
                    }
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="product-card card h-100 border-0 shadow-sm">
                                    <div class="position-relative bg-light" style="height: 220px;">
                                        <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                                            class="img-fluid p-3 w-100 h-100 object-fit-contain"
                                            alt="<?= htmlspecialchars($row["name"]) ?>">

                                        <?php if ($row["discount_percentaged"] > 0): ?>
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                                <?= $row["discount_percentaged"] ?>% OFF
                                            </span>
                                        <?php endif; ?>

                                        <div class="product-actions position-absolute top-0 end-0 p-2">
                                            <a href="wishlist_insert.php?id=<?= $row['id'] ?>"
                                                class="btn btn-sm btn-light rounded-circle shadow-sm mb-2">
                                                <i class="fas fa-heart text-danger"></i>
                                            </a>
                                            <form action="single-product.php" method="post" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-light rounded-circle shadow-sm">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= htmlspecialchars($row["name"]) ?></h5>
                                        <!-- <p class="card-text text-muted small mb-2 text-truncate-2" style="height: 2.5rem;">
                                            <?= htmlspecialchars($row["description"]) ?>
                                        </p> -->

                                        <div class="d-flex align-items-center mb-3">
                                            <?php if ($row["discount_percentaged"] > 0): ?>
                                                <span
                                                    class="h5 mb-0 text-dark fw-bold">₹<?= number_format($row["sale_price"], 2) ?></span>
                                                <small
                                                    class="text-decoration-line-through text-muted ms-2">₹<?= number_format($row["MRP"], 2) ?></small>
                                            <?php else: ?>
                                                <span
                                                    class="h5 mb-0 text-dark fw-bold">₹<?= number_format($row["sale_price"], 2) ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <form action="cart_insert.php" method="post" class="d-grid gap-2">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="cart_qty" value="1">
                                            <button type="submit" class="btn btn-dark rounded-pill">
                                                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="col-12 text-center py-5">
                                <div class="alert alert-info">No products found matching your criteria.</div>
                                <a href="shop.php" class="btn btn-dark rounded-pill px-4">Browse All Products</a>
                              </div>';
                    }
                    ?>
                    
                </div>
            </section>
        </div>
    </div>
</div>

<style>
    .product-card {
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .product-actions {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

    .object-fit-contain {
        object-fit: contain;
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .sticky-top {
        z-index: 1;
    }

    .list-group-item.active {
        background-color: #f8f9fa;
        color: #212529;
        border-left: 3px solid #d4a373;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>

<?php
include "footer.php";
?>