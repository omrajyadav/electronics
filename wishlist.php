<?php
include 'header.php';
include("db_connection.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.querySelector('.toast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
        }
    });
</script>

<?php if (isset($_SESSION['success'])): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;text-align: center;">
        <div class="toast text-center align-items-center text-white bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['delete'])): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;text-align: center;">
        <div class="toast text-center align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= htmlspecialchars($_SESSION['delete']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['delete']); ?>
<?php endif; ?>

<div class="container">
    <div class="text-center mb-5 mt-4">
        <h1 class="display-5 fw-bold text-uppercase">Your Wishlist</h1>
        <p class="text-muted">Browse and manage your saved items</p>
    </div>
    <div class="row g-4">
        <?php
        if (isset($_SESSION["customer_id"])) {
            $customer = intval($_SESSION["customer_id"]); // Ensure it's an integer to prevent injection
        
            $query = "SELECT * FROM tbl_wishlist 
                      INNER JOIN tbl_product 
                      ON tbl_product.id = tbl_wishlist.wishlist_product_id 
                      WHERE tbl_wishlist.wishlist_customer_id = $customer";

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card product-card h-100 border-0 shadow-sm hover-top">
                            <div class="badge bg-success position-absolute top-0 end-0 m-2">
                                <?= htmlspecialchars($row['discount_percentaged']) ?>% OFF
                            </div>
                            <div class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                                        class="img-fluid rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;"
                                        alt="<?= htmlspecialchars($row["name"]) ?>">
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column shadow-sm">
                                <div class="mb-2">
                                    <a href="single-product.php?id=<?= $row['id'] ?>" class="text-decoration-none">
                                        <h5 class="card-title mb-1 text-center"><?= htmlspecialchars($row['name']) ?></h5>
                                    </a>
                                    <div class="d-flex text-center mb-2 ms-3">
                                        <div class="text-warning small me-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="text-muted small">(400 reviews)</span>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center mb-3 justify-content-center">
                                        <span class="text-dark fw-bold fs-5 me-2"><?= htmlspecialchars($row['sale_price']) ?>
                                            Rs</span>
                                        <span class="text-muted text-decoration-line-through"><?= htmlspecialchars($row['MRP']) ?>
                                            Rs</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <form action="cart_insert.php" method="post" class="flex-grow-1">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="cart_qty" value="1">
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                            </button>
                                        </form>
                                        <a href="wishlist_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to remove this item?');">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted fs-5'>Your wishlist is empty.</p></div>";
            }
        } else {
            echo "<div class='col-12 text-center'><p class='text-danger fs-5'>User not identified. Please log in.</p></div>";
        }
        ?>
    </div>
</div>

<?php
include 'footer.php';
?>