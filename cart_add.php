<?php
include "header.php";
include "db_connection.php";
?>

<!-- Main Content with Improved Styling -->
<div class="container-fluid py-5" style="margin-top: 100px; background-color: #f8f9fa;">
    <!-- Notification Alerts -->
    <div class="container">
        <?php if (isset($_SESSION["danger"])): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <span><?= $_SESSION["danger"] ?></span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION["danger"]); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <span><?= $_SESSION["success"] ?></span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION["success"]); ?>
        <?php endif; ?>
    </div>

    <!-- Cart Header -->
    <div class="container mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark">Your Shopping Cart</h2>
            <span class="badge bg-primary rounded-pill">
                <?php
                $count_query = "SELECT COUNT(*) as count FROM tbl_cart";
                $count_result = mysqli_query($conn, $count_query);
                $count = mysqli_fetch_assoc($count_result)['count'];
                echo $count . " item" . ($count != 1 ? 's' : '');
                ?>
            </span>
        </div>
        <hr class="my-3">
    </div>

    <!-- Cart Content -->
    <div class="container">
        <div class="row">
            <!-- Cart Items Table -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="ps-4">Product img</th>
                                        <th scope="col">Product name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    $query = "SELECT * FROM `tbl_cart` INNER JOIN tbl_product ON tbl_cart.cart_product_id = tbl_product.id";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $price = is_numeric($row["sale_price"]) ? (float) $row["sale_price"] : 0;
                                        $qty = is_numeric($row["cart_qty"]) ? (int) $row["cart_qty"] : 0;
                                        $item_total = $price * $qty;
                                        $subtotal += $item_total;
                                        ?>
                                        <tr class="border-bottom">
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="./admin/uploads/categoryimg/<?= $row["image"] ?>"
                                                        class="img-fluid rounded-3 me-3"
                                                        style="width: 80px; height: 80px; object-fit: cover;"
                                                        alt="<?= $row["name"] ?>">
                                                    <div>
                                                        <!-- <small class="text-muted"><?= $row["id"] ?></small> -->
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-1 fw-semibold"><?= $row["name"] ?></h6>
                                            </td>
                                            <td>
                                                <span class="fw-semibold">₹<?= number_format($price, 2) ?></span>
                                            </td>
                                            <td>
                                                <form action="qtadd.php" method="post"
                                                    class="d-flex justify-content-center">
                                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>">
                                                    <div class="input-group quantity" style="width: 120px;">
                                                        <button name="minus" type="submit"
                                                            class="btn btn-outline-secondary btn-sm">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type="text"
                                                            class="form-control form-control-sm text-center border-secondary"
                                                            name="cart_qty" value="<?= $row["cart_qty"] ?>">
                                                        <button name="plus" type="submit"
                                                            class="btn btn-outline-secondary btn-sm">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <span
                                                    class="fw-bold text-primary">₹<?= number_format($item_total, 2) ?></span>
                                            </td>
                                            <td class="pe-4">
                                                <a href="cart_delete.php?id=<?= $row["id"] ?>"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to remove this item?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card shadow-sm border-0 rounded-3 sticky-top" style="top: 120px;">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span class="fw-semibold">₹<?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="fw-semibold">₹<?= number_format(50, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <span class="fw-semibold">₹<?= number_format($subtotal * 0.18, 2) ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-primary fs-5">
                                ₹<?= number_format($subtotal + 50 + ($subtotal * 0.18), 2) ?>
                            </span>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg rounded-pill py-3 fw-bold">
                                Proceed to Checkout
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary rounded-pill py-3">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>