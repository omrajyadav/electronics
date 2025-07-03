<?php
include "header.php";
include "db_connection.php";

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($row["name"]) ?> - Product Details</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: rgb(5, 11, 22);
            --secondary-color: #d4a373;;
            --accent-color: #d4a373;;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --border-radius: 0.5rem;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .product-hero {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        .product-gallery {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            background: white;
        }

        .product-gallery img {
            width: 100%;
            height: auto;
            object-fit: contain;
            max-height: 500px;
        }

        .product-info {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow-md);
        }

        .product-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .price-container {
            margin: 1.5rem 0;
        }

        .current-price {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .original-price {
            font-size: 1.25rem;
            text-decoration: line-through;
            color: #64748b;
            margin-left: 0.5rem;
        }

        .discount-badge {
            background-color: var(--danger-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            margin-left: 0.75rem;
            display: inline-block;
        }

        .rating {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }

        .stars {
            color: var(--warning-color);
            margin-right: 0.5rem;
        }

        .review-count {
            color: #64748b;
            font-size: 0.875rem;
        }

        .product-meta {
            margin: 1.5rem 0;
        }

        .meta-item {
            display: flex;
            margin-bottom: 0.75rem;
        }

        .meta-label {
            font-weight: 600;
            color: var(--dark-color);
            min-width: 100px;
        }

        .meta-value {
            color: #64748b;
        }

        .product-description {
            line-height: 1.6;
            color: #334155;
            margin: 1.5rem 0;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #e2e8f0;
            background: white;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .quantity-btn:hover {
            background: #f1f5f9;
        }

        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            border-left: none;
            border-right: none;
            font-size: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background-color: white;
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            border-radius: var(--border-radius);
            color: var(--dark-color);
            font-weight: 600;
            transition: all 0.3s;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .product-title {
                font-size: 1.5rem;
            }

            .current-price {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Product Hero Section -->
    <section class="product-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php">shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($row["name"]) ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail Section -->
    <div class="container">
        <div class="row">
            <!-- Product Gallery -->
            <div class="col-lg-6 mb-4">
                <div class="product-gallery">
                    <img src="uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>"
                        alt="<?= htmlspecialchars($row["name"]) ?>" class="img-fluid">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6 mb-4">
                <div class="product-info">
                    <h1 class="product-title"><?= htmlspecialchars($row["name"]) ?></h1>

                    <div class="price-container">
                        <?php if ($row["discount_percentaged"] > 0): ?>
                            <span class="current-price" id="unitPrice">₹<?= number_format($sale_price, 2) ?></span>
                            <span class="original-price">₹<?= number_format($row["MRP"], 2) ?></span>
                            <span class="discount-badge"><?= $row["discount_percentaged"] ?>% OFF</span>
                        <?php else: ?>
                            <span class="current-price" id="unitPrice">₹<?= number_format($row["MRP"], 2) ?></span>
                        <?php endif; ?>
                        <div class="mt-2">
                            <span class="fw-bold">Subtotal:</span>
                            <span id="subtotal" class="text-primary">₹<?= number_format(($row["discount_percentaged"] > 0 ? $sale_price : $row["MRP"]), 2) ?></span>
                        </div>
                    </div>

                    <div class="rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="review-count">(400+ reviews)</span>
                    </div>

                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label">Category:</span>
                            <span class="meta-value"><?= htmlspecialchars($row["name"]) ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Availability:</span>
                            <span class="meta-value text-success">In Stock</span>
                        </div>
                    </div>

                    <div class="product-description">
                        <p><?= htmlspecialchars($row["description"]) ?></p>
                    </div>

                    <div class="quantity-selector">
                        <button class="quantity-btn minus">-</button>
                        <input type="number" class="quantity-input" value="1" min="1" id="productQuantity">
                        <button class="quantity-btn plus">+</button>
                    </div>

                    <div class="action-buttons">
                        <form action="cart_insert.php" method="post" class="w-100">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="cart_qty" value="1" id="cartQtyField">
                            <button type="submit" class="btn-primary">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                        <form>
                            <a href="wishlist_insert.php?id=<?= $row['id'] ?>"
                                class="btn btn-sm btn-light rounded-circle shadow-sm mb-2">
                                <i class="fas fa-heart text-danger"></i>
                            </a>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Quantity selector functionality + live subtotal
        document.addEventListener('DOMContentLoaded', function () {
            const minusBtn = document.querySelector('.quantity-btn.minus');
            const plusBtn = document.querySelector('.quantity-btn.plus');
            const quantityInput = document.getElementById('productQuantity');
            const cartQtyField = document.getElementById('cartQtyField');
            const subtotalSpan = document.getElementById('subtotal');
            // Get unit price from PHP
            const unitPrice = <?= ($row["discount_percentaged"] > 0 ? $sale_price : $row["MRP"]) ?>;

            function updateSubtotal() {
                let qty = parseInt(quantityInput.value);
                if (isNaN(qty) || qty < 1) qty = 1;
                const subtotal = unitPrice * qty;
                subtotalSpan.textContent = '₹' + subtotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }

            minusBtn.addEventListener('click', function () {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                    cartQtyField.value = quantityInput.value;
                    updateSubtotal();
                }
            });

            plusBtn.addEventListener('click', function () {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
                cartQtyField.value = quantityInput.value;
                updateSubtotal();
            });

            quantityInput.addEventListener('change', function () {
                let value = parseInt(this.value);
                if (isNaN(value) || value < 1) {
                    this.value = 1;
                }
                cartQtyField.value = this.value;
                updateSubtotal();
            });

            // Initial subtotal
            updateSubtotal();
        });
    </script>

    <?php include "footer.php"; ?>
</body>

</html>