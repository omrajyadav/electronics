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
    }
    .product-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .wishlist-empty-state {
        padding: 5rem 0;
    }
    .discount-badge {
        font-size: 0.8rem;
        padding: 5px 10px;
        z-index: 2;
    }
    .product-img-container {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        padding: 20px;
    }
    .product-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
    .action-buttons {
        margin-top: auto;
    }
    .price-container {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
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
        
        // Add confirmation for delete action
        document.querySelectorAll('.delete-wishlist-item').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

<!-- Toast Notifications -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div class="toast wishlist-toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-4"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['delete'])): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div class="toast wishlist-toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-trash-alt me-2 fs-4"></i>
                    <?= htmlspecialchars($_SESSION['delete']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['delete']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary mb-3"><i class="fas fa-heart me-2"></i>Your Wishlist</h1>
        <p class="lead text-muted">Your saved items are waiting for you</p>
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
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <?php if ($row['discount_percentaged'] > 0): ?>
                                <span class="discount-badge bg-danger position-absolute top-0 start-0 m-2">
                                    <?= htmlspecialchars($row['discount_percentaged']) ?>% OFF
                                </span>
                            <?php endif; ?>
                            
                            <div class="product-img-container">
                                <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                                    class="product-img"
                                    alt="<?= htmlspecialchars($row["name"]) ?>">
                            </div>
                            
                            <div class="card-body pt-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <a href="single-product.php?id=<?= $row['id'] ?>" class="text-decoration-none">
                                        <h5 class="card-title mb-1"><?= htmlspecialchars($row['name']) ?></h5>
                                    </a>
                                    <a href="wishlist_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger delete-wishlist-item">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <div class="text-warning small me-2">
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
                                        <span class="text-dark fw-bold fs-5">₹<?= number_format(htmlspecialchars($row['sale_price']), 2) ?></span>
                                        <?php if ($row['MRP'] > $row['sale_price']): ?>
                                            <span class="text-muted text-decoration-line-through small">₹<?= number_format(htmlspecialchars($row['MRP']), 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <form action="cart_insert.php" method="post" class="action-buttons">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="cart_qty" value="1">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="wishlist-empty-state text-center py-5">
                <div class="mb-4">
                    <i class="far fa-heart fa-4x text-muted"></i>
                </div>
                <h4 class="mb-3">Your wishlist is empty</h4>
                <p class="text-muted mb-4">Looks like you haven't added any items to your wishlist yet.</p>
                <a href="products.php" class="btn btn-primary px-4">
                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle fa-4x text-danger"></i>
            </div>
            <h4 class="mb-3">Authentication Required</h4>
            <p class="text-muted mb-4">Please log in to view your wishlist.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="login.php" class="btn btn-primary px-4">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
                <a href="register.php" class="btn btn-outline-primary px-4">
                    <i class="fas fa-user-plus me-2"></i>Register
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>