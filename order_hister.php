<?php
include "db_connection.php";
include "header.php";

$order_m_id = isset($_SESSION['order_m_id']) ? $_SESSION['order_m_id'] : null;

$query = "SELECT * FROM `tbl_order_master` ORDER BY order_m_date DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-history me-2"></i>Order History</h2>
        </div>
        <div class="card-body">
            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Order #</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { 
                                // Add color coding based on status
                                $statusClass = '';
                                if ($row['order_m_status'] == 'Completed') {
                                    $statusClass = 'text-success';
                                } elseif ($row['order_m_status'] == 'Processing') {
                                    $statusClass = 'text-warning';
                                } elseif ($row['order_m_status'] == 'Cancelled') {
                                    $statusClass = 'text-danger';
                                }
                                ?>
                                <tr>
                                    <td class="fw-bold">#<?= htmlspecialchars($row['order_m_id']) ?></td>
                                    <td class="<?= $statusClass ?>">
                                        <i class="fas 
                                            <?= $row['order_m_status'] == 'Completed' ? 'fa-check-circle' : '' ?>
                                            <?= $row['order_m_status'] == 'Processing' ? 'fa-spinner' : '' ?>
                                            <?= $row['order_m_status'] == 'Cancelled' ? 'fa-times-circle' : '' ?>
                                        me-1"></i>
                                        <?= htmlspecialchars($row['order_m_status']) ?>
                                    </td>
                                    <td><?= isset($row['order_m_date']) ? date('d M Y', strtotime($row['order_m_date'])) : '-' ?></td>
                                    <td class="fw-bold">₹<?= isset($row['order_m_total_price']) && is_numeric($row['order_m_total_price']) ? number_format($row['order_m_total_price'], 2) : '0.00' ?></td>
                                    <td><?= htmlspecialchars($row['order_m_payment_term'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge 
                                            <?= isset($row['order_m_payment_status']) && $row['order_m_payment_status'] == 'Paid' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                            <?= htmlspecialchars($row['order_m_payment_status'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="order.detail.php?order_id=<?= $row['order_m_id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye me-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                    <h4>No orders found</h4>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="products.php" class="btn btn-primary mt-3">
                        <i class="fas fa-shopping-bag me-1"></i> Shop Now
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>