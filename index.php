<?php
include 'header.php';
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Premium Fashion & Lifestyle</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --bs-primary: #212529;
            --bs-secondary: #6c757d;
            --bs-accent: #d4a373;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-body-font-family: 'Manrope', sans-serif;
            --bs-heading-font-family: 'Marcellus', serif;
        }
        
        body {
            font-family: var(--bs-body-font-family);
            color: var(--bs-dark);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--bs-heading-font-family);
            letter-spacing: -0.5px;
        }
        
        .btn-accent {
            background-color: var(--bs-accent);
            border-color: var(--bs-accent);
            color: white;
        }
        
        .btn-accent:hover {
            background-color: transparent;
            color: var(--bs-accent);
            border-color: var(--bs-accent);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), 
                        url('uploads/categoryimg/img2.jpg') no-repeat center center;
            background-size: cover;
            min-height: 90vh;
        }
        
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--bs-accent);
            margin: 0 auto 1.5rem;
            background-color: rgba(212, 163, 115, 0.1);
            border-radius: 50%;
        }
        
        .category-card, .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .category-card:hover, .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Reduced category image size */
        .category-img {
            transition: transform 0.5s ease;
            height: 200px; /* Reduced from 250px */
            object-fit: cover;
            border-radius: 10px;
        }
        
        .category-card:hover .category-img {
            transform: scale(1.05);
        }
        
        .product-img-container {
            height: 220px;
            background-color: var(--bs-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            padding: 20px;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
        }
        
        .product-actions {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .product-card:hover .product-actions {
            opacity: 1;
        }
        
        .newsletter-section {
            background-color: var(--bs-dark);
            color: white;
        }
        
        .newsletter-form .form-control {
            border-radius: 50px 0 0 50px;
            border-right: none;
        }
        
        .newsletter-form .btn {
            border-radius: 0 50px 50px 0;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--bs-accent);
        }
        
        /* Responsive adjustments for smaller category images */
        @media (max-width: 768px) {
            .category-img {
                height: 150px;
            }
        }
        
        @media (max-width: 576px) {
            .category-img {
                height: 120px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-white p-4 bg-dark bg-opacity-50 rounded">
                        <h1 class="display-4 fw-bold mb-4">Timeless Style, Modern Sophistication</h1>
                        <p class="lead mb-4">Discover thoughtfully designed pieces that blend quality craftsmanship with contemporary aesthetics</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="shop.php" class="btn btn-accent btn-lg px-4">Shop Now</a>
                            <a href="#featured" class="btn btn-outline-light btn-lg px-4">Explore Collections</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card p-4 text-center h-100 rounded">
                        <div class="feature-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <h5 class="fw-bold">Easy Returns</h5>
                        <p class="text-muted">30-day return policy for your peace of mind</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card p-4 text-center h-100 rounded">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5 class="fw-bold">Free Shipping</h5>
                        <p class="text-muted">On all orders over ₹1000</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card p-4 text-center h-100 rounded">
                        <div class="feature-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h5 class="fw-bold">Secure Payment</h5>
                        <p class="text-muted">Shop with confidence</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card p-4 text-center h-100 rounded">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5 class="fw-bold">Dedicated Support</h5>
                        <p class="text-muted">We're here to help</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-4">Our Collections</h2>
            <p class="text-center text-muted mb-5">Carefully curated for the modern individual</p>
            
            <div class="row g-4">
                <?php
                $query = "SELECT * FROM tbl_category LIMIT 6";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="category-card card h-100 border-0">
                                <div class="position-relative overflow-hidden">
                                    <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>" 
                                         class="category-img w-100" 
                                         alt="<?= htmlspecialchars($row["name"]) ?>">
                                    <div class="card-img-overlay d-flex align-items-center justify-content-center bg-dark bg-opacity-30 opacity-0 hover-opacity-100 transition">
                                        <a href="shop.php?id=<?= $id ?>" class="btn btn-accent">View Collection</a>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="card-title"><?= htmlspecialchars($row["name"]) ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12 text-center py-5">
                            <div class="alert alert-info">No categories found.</div>
                          </div>';
                }
                ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="shop.php" class="btn btn-outline-dark px-4">View All Collections</a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured" class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-4">Featured Selection</h2>
            <p class="text-center text-muted mb-5">Our current favorites</p>
            
            <div class="row g-4">
                <?php
                $query = "SELECT * FROM tbl_featured INNER JOIN tbl_product ON tbl_product.id = tbl_featured.product_id LIMIT 8";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $discount = ($row['MRP'] > 0 && $row['sale_price'] < $row['MRP'])
                            ? round(($row['MRP'] - $row['sale_price']) / $row['MRP'] * 100)
                            : 0;
                        ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="product-card card h-100 border-0">
                                <div class="product-img-container position-relative">
                                    <img src="./admin/uploads/categoryimg/<?= htmlspecialchars($row["image"]) ?>" 
                                         class="product-img" 
                                         alt="<?= htmlspecialchars($row["name"]) ?>">
                                    <?php if ($discount > 0): ?>
                                        <span class="product-badge badge bg-danger">-<?= $discount ?>%</span>
                                    <?php endif; ?>
                                    <div class="product-actions">
                                        <a href="wishlist_insert.php?id=<?= $id ?>" class="btn btn-light rounded-circle mx-1" title="Add to Wishlist">
                                            <i class="bi bi-heart text-danger"></i>
                                        </a>
                                        <a href="single-product.php?id=<?= $id ?>" class="btn btn-light rounded-circle mx-1" title="Quick View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= htmlspecialchars($row["name"]) ?></h5>
                                    <p class="card-text text-muted small mb-3"><?= htmlspecialchars($row["description"]) ?></p>
                                    <div class="mb-3">
                                        <span class="h5 text-dark">₹<?= number_format($row['sale_price'], 2) ?></span>
                                        <?php if ($discount > 0): ?>
                                            <span class="text-decoration-line-through text-muted ms-2">₹<?= number_format($row['MRP'], 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <form action="cart_insert.php" method="post" class="d-grid">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <input type="hidden" name="cart_qty" value="1">
                                        <button type="submit" class="btn btn-dark">
                                            <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12 text-center py-5">
                            <div class="alert alert-info">No featured products available at the moment.</div>
                          </div>';
                }
                ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="shop.php" class="btn btn-outline-dark px-4">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Join Our Community</h2>
                    <p class="text-muted mb-4">Subscribe for exclusive offers and style inspiration</p>
                    <form class="newsletter-form d-flex">
                        <input type="email" class="form-control" placeholder="Your email address" required>
                        <button type="submit" class="btn btn-accent">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Simple animation for elements when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.feature-card, .category-card, .product-card');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.2;
                    
                    if(elementPosition < screenPosition) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };
            
            // Set initial state
            const cards = document.querySelectorAll('.feature-card, .category-card, .product-card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            
            // Run on load and scroll
            animateOnScroll();
            window.addEventListener('scroll', animateOnScroll);
        });
    </script>
</body>

</html>
<?php
include 'footer.php';
?>