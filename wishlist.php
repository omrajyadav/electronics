<?php
include 'header.php';
include("db_connection.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Toast Notification Styles -->
<style>
    .wishlist-toast {
        min-width: 350px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .product-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .wishlist-empty-state {
        padding: 6rem 0;
        background: linear-gradient(135deg, #f9f9ff 0%, #f0f4ff 100%);
        border-radius: 20px;
    }

    .discount-badge {
        font-size: 0.8rem;
        padding: 5px 12px;
        z-index: 2;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .product-img-container {
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        padding: 25px;
        position: relative;
    }

    .product-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .action-buttons {
        margin-top: auto;
    }

    .price-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 12px;
    }

    .wishlist-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.2);
    }

    .delete-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        z-index: 3;
        color: #dc3545;
        transition: all 0.2s ease;
    }

    .delete-btn:hover {
        background: #dc3545;
        color: white;
        transform: scale(1.1);
    }

    .rating-stars {
        color: #ffc107;
    }

    .card-body {
        padding: 1.5rem;
    }

    .auth-required-section {
        background: linear-gradient(135deg, #fff5f5 0%, #fff0f0 100%);
        border-radius: 20px;
        padding: 3rem;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toast notifications
        const toastEl = document.querySelector('.toast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
        }

        // Add confirmation for delete action with sweet animation
        document.querySelectorAll('.delete-wishlist-item').forEach(button => {
            button.addEventListener('click', function (e) {
                if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
                    e.preventDefault();
                } else {
                    // Add animation on confirmation
                    const card = this.closest('.product-card');
                    card.style.transform = 'scale(0.9)';
                    card.style.opacity = '0.5';
                    card.style.transition = 'all 0.3s ease';
                }
            });
        });
    });
</script>

<!-- Toast Notifications -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div class="toast wishlist-toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-4"></i>
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
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div class="toast wishlist-toast align-items-center text-white bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-trash-alt me-2 fs-4"></i>
                    <?= htmlspecialchars($_SESSION['delete']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['delete']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="container py-5">
    <!-- Enhanced Header -->
    <div class="wishlist-header text-center mb-5">
        <h1 class="display-5 fw-bold mb-3"><i class="fas fa-heart me-2"></i>Your Wishlist</h1>
        <p class="lead mb-0">Your carefully selected favorites all in one place</p>
    </div>

    <?php if (isset($_SESSION["customer_id"])): ?>
        <?php
        $customer = intval($_SESSION["customer_id"]);
        $query = "SELECT * FROM tbl_wishlist 
                  INNER JOIN tbl_product 
                  ON tbl_product.id = tbl_wishlist.wishlist_product_id 
                  WHERE tbl_wishlist.wishlist_customer_id = $customer";
        $result = mysqli_query($conn, $query);
        ?>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <div class="row g-4">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-card h-100">
                            <div class="position-relative">
                                <?php if ($row['discount_percentaged'] > 0): ?>
                                    <span class="badge bg-warning position-absolute top-0 start-0 m-3 text-dark discount-badge">
                                        <?= htmlspecialchars($row['discount_percentaged']) ?>% OFF
                                    </span>
                                <?php endif; ?>

                                <a href="wishlist_delete.php?id=<?= $row['id'] ?>" class="delete-btn delete-wishlist-item">
                                    <i class="fas fa-times"></i>

                                </a>

                                <div class="product-img-container">
                                    <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                                        class="product-img" alt="<?= htmlspecialchars($row["name"]) ?>">
                                </div>
                            </div>

                            <div class="card-body pt-3 d-flex flex-column">
                                <form action="single-product.php" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-light rounded-circle shadow-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </form>


                                <div class="d-flex align-items-center mb-3">
                                    <div class="rating-stars small me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-muted small">(<?= rand(50, 500) ?> reviews)</span>
                                </div>

                                <div class="price-container mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span
                                            class="text-dark fw-bold fs-5">₹<?= number_format(htmlspecialchars($row['sale_price']), 2) ?></span>
                                        <?php if ($row['MRP'] > $row['sale_price']): ?>
                                            <span
                                                class="text-muted text-decoration-line-through small">₹<?= number_format(htmlspecialchars($row['MRP']), 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <form action="cart_insert.php" method="post" class="action-buttons mt-auto">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="cart_qty" value="1">
                                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="wishlist-empty-state text-center py-5 rounded-4">
                <div class="mb-4">
                    <i class="far fa-heart fa-4x text-primary" style="opacity: 0.7;"></i>
                </div>
                <h3 class="mb-3 fw-bold">Your wishlist feels lonely</h3>
                <p class="text-muted mb-4">You haven't added any items to your wishlist yet. Start exploring!</p>
                <a href="shop.php" class="btn btn-primary px-4 py-2 fw-semibold">
                    <i class="fas fa-store me-2"></i>Browse Products
                </a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="auth-required-section text-center py-5 rounded-4">
            <div class="mb-4">
                <i class="fas fa-lock fa-4x text-primary"></i>
            </div>
            <h3 class="mb-3 fw-bold">Sign in to view your wishlist</h3>
            <p class="text-muted mb-4">Your saved items are waiting for you. Please log in to continue.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="login.php" class="btn btn-primary px-4 py-2 fw-semibold">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
                <a href="register.php" class="btn btn-outline-primary px-4 py-2 fw-semibold">
                    <i class="fas fa-user-plus me-2"></i>Register
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>