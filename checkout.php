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
?>


<div class="container-fluid " style="margin-top: 130px; margin-bottom: 100px;">
    <form action="order_master.php?id=<?= $customer_row["customer_id"] ?>" method="post">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>

                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group col-lg-4">
                            <label>Full Name</label>
                            <input class="form-control" type="text" value="<?= $customer_row["customer_name"] ?>">
                        </div>

                        <div class="col-md-6 form-group col-lg-4">
                            <label>E-mail</label>
                            <input class="form-control" type="text" value="<?= $customer_row["customer_email"] ?>">
                        </div>
                        <div class="col-md-6 form-group col-lg-4">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" value="<?= $customer_row["customer_phone"] ?>">
                        </div>
                        <div class="col-md-6 form-group col-lg-12">
                            <label>Address</label>
                            <textarea name="" id="" class="form-control"
                                placeholder=""><?= $customer_row["customer_address"] ?></textarea>
                            <input type="hidden" name="address" value="<?= $customer_row["customer_address"] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php
                        $query = "SELECT * FROM `tbl_cart` INNER JOIN tbl_product ON tbl_cart.cart_product_id = tbl_product.id WHERE tbl_cart.cart_customer_id = $customer_id";
                        $result = mysqli_query($conn, $query);
                        $cart_items = [];
                        $subtotal = 0;
                        while ($cart_row = mysqli_fetch_array($result)) {
                            $items[] = $cart_row;
                            $subtotal += $cart_row["sale_price"] * $cart_row["cart_qty"];
                            ?>
                            <div class="d-flex justify-content-between">
                                <p><?= $cart_row["name"] ?></p>
                                <p> ₹ <?= $cart_row["sale_price"] ?></p>
                            </div>
                            <input type="hidden" name="productid[]" value="<?= $cart_row["id"] ?>">
                            <input type="hidden" name="cardq[]" value="<?= $cart_row["cart_qty"] ?>">
                            <?php
                        }
                        ?>
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
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                              <span class="fw-bold">Total</span>
                            <span class="fw-bold text-primary fs-5">
                                ₹<?= number_format($subtotal + 50 + ($subtotal * 0.18), 2) ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="paystatus" value="1">
                        <input type="hidden" name="d" id="dateVisible">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="term" id="paypal"
                                    value="Cash On Delivery">
                                <label class="custom-control-label" for="paypal">Cash On Delivery</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="term" id="directcheck"
                                    value="Credit Card">
                                <label class="custom-control-label" for="directcheck">Credit Card</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="term" id="banktransfer"
                                    value="Paypal">
                                <label class="custom-control-label" for="banktransfer">Paypal</label>
                            </div>
                        </div>
                        <div>
                            <p>sane me</p>
                            <img src="./admin/uploads/categoryimg/scanpay.jpg" alt="Payment QR Code" class="img-fluid mb-2"
                                style="max-width: 200px;">

                        </div>
                        <input type="submit" value="Place Order"
                            class="btn btn-block btn-primary font-weight-bold py-3">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->
<script>
    setTimeout(() => {
        document.getElementById("dateVisible").value = new Date().getFullYear() + "-" + ("0" + (new Date().getMonth() + 1)) + "-" + new Date().getDate();
    }, 100)
</script>
<?php
$shipping = 50;
$tax = $subtotal * 0.18;
$total = $subtotal + $shipping + $tax;
include 'footer.php';
?>