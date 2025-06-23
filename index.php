<?php
include 'header.php';
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub - Fashion Destination</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-hover: #0b5ed7;
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #198754;
            --danger-color: #dc3545;
            --border-radius: 0.75rem;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.15) 0%, rgba(255, 255, 255, 1) 100%),
                url('uploads/categoryimg/img2.jpg') no-repeat center center;
            background-size: cover;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .hero-content {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 3rem;
            border-radius: var(--border-radius);
            backdrop-filter: blur(5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-title span {
            color: var(--primary-color);
            position: relative;
        }

        .hero-title span:after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background-color: rgba(13, 110, 253, 0.3);
            z-index: -1;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .hero-cta .btn {
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-right: 1rem;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }

        .btn-outline-primary {
            border-width: 2px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }

        /* Feature Cards */
        .features-section {
            padding: 5rem 0;
            background-color: var(--light-color);
        }

        .feature-card {
            transition: all 0.3s ease;
            border-radius: var(--border-radius);
            height: 100%;
            border: none;
            background: white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            padding: 2rem;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-0.5rem);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }

        .feature-icon {
            width: 5rem;
            height: 5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: rgba(13, 110, 253, 0.1);
            color: var(--primary-color);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            background-color: var(--primary-color);
            color: white;
        }

        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Category & Product Cards */
        .category-section,
        .products-section {
            padding: 5rem 0;
        }

        .category-section {
            background-color: white;
        }

        .products-section {
            background-color: var(--light-color);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--secondary-color);
            text-align: center;
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .category-card,
        .product-card {
            transition: all 0.3s ease;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: none;
            background: white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .category-card:hover,
        .product-card:hover {
            transform: translateY(-0.5rem);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }

        .card-img-container {
            height: 14rem;
            overflow: hidden;
            position: relative;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover .card-img,
        .product-card:hover .card-img {
            transform: scale(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-card:hover .card-overlay,
        .product-card:hover .card-overlay {
            opacity: 1;
        }

        .card-overlay .btn {
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            border-radius: 50px;
        }

        .card-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 1;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .card-text {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
        }

        .price-tag {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .original-price {
            text-decoration: line-through;
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }

        .discount-badge {
            background-color: var(--danger-color);
        }

        /* Newsletter Section */
        .newsletter-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .newsletter-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .newsletter-form .form-control {
            height: 3.5rem;
            border-radius: 50px;
            padding-left: 1.5rem;
            border: 2px solid #dee2e6;
        }

        .newsletter-form .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: var(--primary-color);
        }

        .newsletter-form .btn {
            height: 3.5rem;
            border-radius: 50px;
            padding: 0 2rem;
            font-weight: 500;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .card-img-container {
                height: 12rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 4rem 0;
                text-align: center;
            }

            .hero-content {
                padding: 2rem;
                background-color: rgba(255, 255, 255, 0.9);
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
                margin: 0 auto 1.5rem;
            }

            .hero-cta .btn {
                display: block;
                width: 100%;
                margin-right: 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .card-img-container {
                height: 10rem;
            }

            .feature-icon {
                width: 4rem;
                height: 4rem;
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Show Your <span>home usaing</span></h1>
                <p class="hero-subtitle">Discover our premium collection crafted with quality materials and timeless
                    designs that reflect your unique personality.</p>
                <div class="hero-cta">
                    <a href="shop.php" class="btn btn-primary">Shop Now</a>
                    <a href="#featured" class="btn btn-outline-primary">View Collection</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <h5>30-Day Returns</h5>
                        <p class="text-muted">Hassle-free money back guarantee on all purchases</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Free Shipping</h5>
                        <p class="text-muted">Free delivery on all orders over $50</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Secure Payment</h5>
                        <p class="text-muted">100% secure checkout with SSL encryption</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">Dedicated customer service team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->

    <!-- Featured Products Section -->
    <!-- Featured Products Section -->
<section id="featured" class="products-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title display-5 fw-bold">Featured Products</h2>
            <p class="section-subtitle text-muted">Discover our premium collection</p>
            <div class="divider mx-auto"></div>
        </div>

        <div class="row g-4">
            <?php
            $query = "SELECT * FROM tbl_featured INNER JOIN tbl_product ON tbl_product.id = tbl_featured.product_id";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    // $discount = ($row['sale_price'] > 0 && $row['sale_price'] < $row['price'])
                    //     ? round(($row['price'] - $row['sale_price']) / $row['price'] * 100)
                    //     : 0;
                    ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card product-card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="position-relative">
                                <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>" 
                                     class="card-img-top product-image" 
                                     alt="<?= htmlspecialchars($row["name"]) ?>">
                                <div class="card-img-overlay d-flex align-items-center justify-content-center overlay-bg">
                                    <div class="overlay-content text-center">
                                        <a href="single-product.php?id=<?= $id ?>" class="btn btn-dark btn-sm stretched-link">Quick View</a>
                                    </div>
                                </div>
                                
                                <div class="position-absolute top-0 end-0 p-2">
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle wishlist-btn">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-1">
                                    <a href="product.php?id=<?= $id ?>" class="text-dark text-decoration-none"><?= htmlspecialchars($row["name"]) ?></a>
                                </h5>
                                <p class="card-text text-muted small mb-2"><?= substr(htmlspecialchars($row["description"]), 0, 60) ?>...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    
                                    <a href="cart_add.php?add=<?= $id ?>" class="btn btn-sm btn-primary rounded-pill px-3">
                                        <i class="bi bi-cart-plus me-1"></i> Add
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <div class="d-grid">
                                    <a href="checkout.php?product_id=<?= $id ?>" class="btn btn-outline-dark btn-sm">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center py-5">
                        <div class="alert alert-info">No featured products available at the moment. Check back soon!</div>
                      </div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="shop.php" class="btn btn-outline-primary px-4">View All Products</a>
        </div>
    </div>
</section>

<style>
    .product-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .product-image {
        height: 200px;
        object-fit: contain;
        background: #f9f9f9;
        padding: 15px;
    }
    
    .overlay-bg {
        background: rgba(0,0,0,0);
        transition: all 0.3s ease;
        opacity: 0;
    }
    
    .product-card:hover .overlay-bg {
        background: rgba(0,0,0,0.3);
        opacity: 1;
    }
    
    .wishlist-btn {
        transition: all 0.3s ease;
        opacity: 0;
    }
    
    .product-card:hover .wishlist-btn {
        opacity: 1;
    }
    
    .wishlist-btn:hover {
        background-color: #fff !important;
        color: #dc3545 !important;
    }
    
    .section-header .divider {
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #0d6efd, transparent);
        margin-top: 15px;
    }
</style>
    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Subscribe to Our Newsletter</h2>
                    <p class="section-subtitle mb-4">Get updates on special offers and new products</p>
                    <form class="newsletter-form row g-2">
                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Your email address" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
<?php
include 'footer.php';
?>