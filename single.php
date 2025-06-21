<?php
include "header.php";
include "db_connection.php";
?>
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="container-fluid">
            <h2 class="mb-4">Single Product</h2>
            <?php
            // Get product ID from query string
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                echo '<div class="alert alert-danger">Invalid product ID.</div>';
                exit;
            }
            $product_id = intval($_GET['id']);

            // Fetch product details
            $query = "SELECT * FROM tbl_product WHERE product_id = $product_id";
            $result = mysqli_query($conn, $query);
            if (!$result || mysqli_num_rows($result) == 0) {
                echo '<div class="alert alert-danger">Product not found.</div>';
                exit;
            }
            $product = mysqli_fetch_assoc($result);
            ?>
            
            <div class="card mb-4">
                <img src="<?= $product['product_image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($product['product_name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                    <p class="card-text">Price: ₹<?= number_format($product['product_price'], 2) ?></p>
                    <p class="card-text"><?= htmlspecialchars($product['product_description']) ?></p>
                    <a href="add_to_cart.php?id=<?= $product['product_id'] ?>" class="btn btn-primary">Add to Cart</a>
                    <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
                </div>
            </div>


            <div class="mb-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span>Related Products</span></h5>
                <div class="row">
                    <?php
                    // Fetch related products (for simplicity, fetching all products)
                    $related_query = "SELECT * FROM tbl_product WHERE product_id != $product_id LIMIT 4";
                    $related_result = mysqli_query($conn, $related_query);
                    while ($related_product = mysqli_fetch_assoc($related_result)) {
                        ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <img src="<?= $related_product['product_image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($related_product['product_name']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($related_product['product_name']) ?></h5>
                                    <p class="card-text">Price: ₹<?= number_format($related_product['product_price'], 2) ?></p>
                                    <a href="single.php?id=<?= $related_product['product_id'] ?>" class="btn btn-primary">View Details</a>
                                    <a href="add_to_cart.php?id=<?= $related_product['product_id'] ?>" class="btn btn-secondary">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>