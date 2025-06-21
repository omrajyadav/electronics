<?php
include "db_connection.php";
include "header.php";

$order_m_id = isset($_SESSION['order_m_id']) ? $_SESSION['order_m_id'] : null;

$query = "SELECT * FROM `tbl_order_master`";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Order History</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Status</th>
                <th>Date</th>
                <th>Total</th>
                <th>payment method</th>
                <th>payment status</th>
                <th>view</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?=($row['order_m_id']) ?></td>
                        <td><?=($row['order_m_status']) ?></td>
                        <td><?=($row['order_m_date']) ?></td>
                        <td>₹<?=($row['order_m_total_price']) ?></td>
                        <td><?=($row['order_m_payment_term']) ?></td>
                        <td><?=($row['order_m_payment_status']) ?></td>
                        <td>
                            <a href="order_detail.php?order_id=<?=($row['order_m_id']) ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i> 
                       </a>
                       </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>
