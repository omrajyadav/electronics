<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php
include "header.php";
include "db_connection.php";
?>
<div class="container" style="margin-top: 110px;">
    <div class="row">
        <div class="col-lg-3 col-md-4 mb-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by Price</span>
            </h5>

            <div class=" p-4 rounded">
                <div class="d-flex flex-column">
                    <a href="shop.php"
                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 text-decoration-none text-dark border rounded px-3 py-2">
                        <span>All Products</span>
                    </a>
                    <a href="shop.php?min_range=0&max_range=200"
                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 text-decoration-none text-dark border rounded px-3 py-2">
                        <span>₹ 0-₹200</span>
                    </a>
                    <a href="shop.php?min_range=210&max_range=400"
                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 text-decoration-none text-dark border rounded px-3 py-2">
                        <span>₹ 210-₹400</span>
                    </a>
                    <a href="shop.php?min_range=410&max_range=700"
                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 text-decoration-none text-dark border rounded px-3 py-2">
                        <span>₹ 410-₹700</span>
                    </a>
                    <a href="shop.php?min_range=710&max_range=800"
                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 text-decoration-none text-dark border rounded px-3 py-2">
                        <span>₹ 710-₹800</span>
                    </a>
                    <a href="shop.php?min_range=10000&max_range=20000"
                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 text-decoration-none text-dark border rounded px-3 py-2">
                        <span>₹ 10000-₹20000</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-8">
            <section class="product-section py-5">
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="shop.php"
                                class="btn btn-outline-primary rounded-pill px-4 <?= !isset($_GET['id']) ? 'active' : '' ?>">All
                                Products</a>
                            <?php
                            $cat_query = "SELECT * FROM tbl_category";
                            $cat_result = mysqli_query($conn, $cat_query);
                            while ($cat = mysqli_fetch_assoc($cat_result)) {
                                $active = (isset($_GET['id']) && $_GET['id'] == $cat['id']) ? 'active' : '';
                                echo '<a href="shop.php?id=' . $cat['id'] . '" class="btn btn-outline-primary rounded-pill px-4 ' . $active . '">' . $cat['name'] . '</a>';

                            }
                            ?>
                        </div>
                    </div>
                </div>
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
                                <div class="product-card card h-100 border-0 shadow-sm overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                                            class="card-img-top img-fluid product-image"
                                            alt="<?= htmlspecialchars($row["name"]) ?>">

                                        <?php if ($row["discount_percentaged"] > 0): ?>
                                            <span class="badge bg-warning position-absolute top-0 text-dark discount-badge ">
                                                -<?= $row["discount_percentaged"] ?>%
                                            </span>
                                        <?php endif; ?>

                                        <div class="product-actions position-absolute top-0 end-0 p-2">
                                            <form action="single-product.php" method="post" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-light rounded-circle shadow-sm">
                                                <i class="fas fa-eye"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-1"><?= htmlspecialchars($row["name"]) ?></h5>
                                        <p class="card-text text-muted small mb-2"><?= htmlspecialchars($row["description"]) ?>
                                        </p>

                                        <div class="d-flex align-items-center mb-3">
                                            <?php if ($row["discount_percentaged"] > 0): ?>
                                                <span
                                                    class="h5 mb-0 text-primary">₹<?= number_format($row["sale_price"], 2) ?></span>
                                                <small
                                                    class="text-decoration-line-through text-muted ms-2">₹<?= number_format($row["MRP"], 2) ?></small>
                                            <?php else: ?>
                                                <span
                                                    class="h5 mb-0 text-primary">₹<?= number_format($row["sale_price"], 2) ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <form action="cart_insert.php" method="post" class="d-flex gap-2">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="cart_qty" value="1">
                                            <button type="submit" class="btn btn-primary flex-grow-1">
                                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                            </button>
                                            <a href="wishlist_insert.php?id=<?= $row['id'] ?>"
                                                class="btn btn-outline-secondary">
                                                <i class="fas fa-heart text-danger"></i>

                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="col-12 text-center py-5">
                                <div class="alert alert-info"></div>
                                <a href="product.php" class="btn btn-primary">Browse All Products</a>
                              </div>';
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>
<style>
    .product-section {
        /* background-color: #f8f9fa; */
    }

    .product-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-actions {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

    .badge.bg-danger {
        font-size: 0.8rem;
        padding: 0.35rem 0.6rem;
    }
</style>
<?php
include "footer.php";
?>