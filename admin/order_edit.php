<?php
include 'header.php';
include 'db_connection.php';
include 'sidebar.php';
// Get order ID from query string
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<div class="alert alert-danger">Invalid order ID.</div>';
    exit;
}
$order_id = intval($_GET['id']);

// Fetch order details
$query = "SELECT * FROM tbl_order_master WHERE order_m_id   = $order_id ";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo '<div class="alert alert-danger">Order not found.</div>';
    exit;
}
$order = mysqli_fetch_assoc($result);


?>
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="container-fluid">
            <h2 class="mb-4">Edit Order #<?= $order_id ?></h2>
            <form method="post">
                <div class="mb-3">
                    <label for="status" class="form-label">Order Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Pending" <?= $order['order_m_status'] == 'Pending' ? 'selected' : '' ?>>Pending
                        </option>
                        <option value="Processing" <?= $order['order_m_status'] == 'Processing' ? 'selected' : '' ?>>
                            Processing
                        </option>
                        <option value="Shipped" <?= $order['order_m_status'] == 'Shipped' ? 'selected' : '' ?>>Shipped
                        </option>
                        <option value="Delivered" <?= $order['order_m_status'] == 'Delivered' ? 'selected' : '' ?>>
                            Delivered
                        </option>
                        <option value="Cancelled" <?= $order['order_m_status'] == 'Cancelled' ? 'selected' : '' ?>>
                            Cancelled
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Shipping Address</label>
                    <textarea name="address" id="address" class="form-control"
                        rows="3"><?= htmlspecialchars($order['order_m_address']) ?></textarea>
                </div>
                <a href="order.php" class="btn btn-primary">Update Order</button>
                <a href="order.php" class="btn btn-secondary">Back to Orders</a>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>