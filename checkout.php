<?php
include 'header.php';
include 'db_connection.php';

// Check if customer_id is set in session
if (!isset($_SESSION["customer_id"])) {
    die("Error: Customer not logged in.");
}
$customer_id = $_SESSION["customer_id"];

// Fetch customer details
$query = "SELECT * FROM tbl_customer WHERE customer_id = $customer_id";
$result = mysqli_query($conn, $query);
$customer_row = mysqli_fetch_array($result);

// Fetch cart items
$query = "SELECT * FROM `tbl_cart` INNER JOIN tbl_product ON tbl_cart.cart_product_id = tbl_product.id WHERE tbl_cart.cart_customer_id = $customer_id";
$result = mysqli_query($conn, $query);
$items = [];
$subtotal = 0;
while ($cart_row = mysqli_fetch_array($result)) {
    $items[] = $cart_row;
    $subtotal += $cart_row["sale_price"] * $cart_row["cart_qty"];
}
$shipping = 50;
$tax = $subtotal * 0.18;
$total = $subtotal + $shipping + $tax;
?>

<div class="container-fluid py-5" style="margin-top: 100px;">
    <form action="order_master.php?id=<?= $customer_row["customer_id"] ?>" method="post">
        <div class="row px-xl-5">
            <!-- Billing Address Section -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0 text-uppercase"><i class="fas fa-address-card me-2 text-primary"></i> Billing Address</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fullName" value="<?= htmlspecialchars($customer_row["customer_name"]) ?>" readonly>
                                    <label for="fullName">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($customer_row["customer_email"]) ?>" readonly>
                                    <label for="email">E-mail</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="mobile" value="<?= htmlspecialchars($customer_row["customer_phone"]) ?>" readonly>
                                    <label for="mobile">Mobile No</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="address" style="height: 100px" readonly><?= htmlspecialchars($customer_row["customer_address"]) ?></textarea>
                                    <label for="address">Delivery Address</label>
                                    <input type="hidden" name="address" value="<?= htmlspecialchars($customer_row["customer_address"]) ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="differentShipping">
                                    <label class="form-check-label" for="differentShipping">
                                        Ship to a different address?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0 text-uppercase"><i class="fas fa-credit-card me-2 text-primary"></i> Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="paystatus" value="1">
                        <input type="hidden" name="d" id="dateVisible">
                        
                        <div class="mb-3">
                            <div class="form-check border rounded p-3 mb-2">
                                <input class="form-check-input" type="radio" name="term" id="cod" value="Cash On Delivery" checked>
                                <label class="form-check-label d-flex align-items-center" for="cod">
                                    <i class="fas fa-money-bill-wave fs-4 text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Cash On Delivery</h6>
                                        <small class="text-muted">Pay with cash upon delivery</small>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="form-check border rounded p-3 mb-2">
                                <input class="form-check-input" type="radio" name="term" id="creditCard" value="Credit Card">
                                <label class="form-check-label d-flex align-items-center" for="creditCard">
                                    <i class="far fa-credit-card fs-4 text-info me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Credit/Debit Card</h6>
                                        <small class="text-muted">Pay with your credit or debit card</small>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="form-check border rounded p-3">
                                <input class="form-check-input" type="radio" name="term" id="paypal" value="Paypal">
                                <label class="form-check-label d-flex align-items-center" for="paypal">
                                    <i class="fab fa-paypal fs-4 text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-1">PayPal</h6>
                                        <small class="text-muted">Pay securely with your PayPal account</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <img src="./admin/uploads/categoryimg/scanpay.jpg" alt="Payment QR Code" class="img-fluid border p-2" style="max-width: 200px;">
                            <p class="text-muted small mt-2">Scan the QR code to pay via UPI</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0 text-uppercase"><i class="fas fa-receipt me-2 text-primary"></i> Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Products</h6>
                            <span class="badge bg-primary rounded-pill"><?= count($items) ?></span>
                        </div>
                        
                        <div class="border-bottom pb-3 mb-3">
                            <?php foreach ($items as $cart_row): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <p class="mb-0"><?= htmlspecialchars($cart_row["name"]) ?></p>
                                    <small class="text-muted">Qty: <?= $cart_row["cart_qty"] ?></small>
                                </div>
                                <p class="mb-0">₹<?= number_format($cart_row["sale_price"] * $cart_row["cart_qty"], 2) ?></p>
                                <input type="hidden" name="productid[]" value="<?= $cart_row["id"] ?>">
                                <input type="hidden" name="cardq[]" value="<?= $cart_row["cart_qty"] ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>₹<?= number_format($subtotal, 0.01) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span>₹<?= number_format($shipping, 0.01) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tax</span>
                                <span>₹<?= number_format($tax, 0.01) ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-primary fs-5">₹<?= number_format($total, 0.01) ?></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 mb-3">
                            <i class="fas fa-lock me-2"></i> Place Order
                        </button>
                        
                        <a href="index.php" class="btn btn-outline-secondary w-100 py-3">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    setTimeout(() => {
        document.getElementById("dateVisible").value = new Date().getFullYear() + "-" + ("0" + (new Date().getMonth() + 1)).slice(-2) + "-" + ("0" + new Date().getDate()).slice(-2);
    }, 100);
</script>

<?php
include 'footer.php';
?>