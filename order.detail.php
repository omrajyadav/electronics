<?php
include "header.php";
include "db_connection.php";
$count = 0;
$query = "SELECT * FROM `tbl_order_child` INNER JOIN tbl_product ON tbl_product.id=tbl_order_child.oc_product_id";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Order Details</h2>
        <a href="Order_hister.php" class="btn btn-warning">
            <i class="fas fa-arrow-left me-2"></i>Back to History
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Products in this Order</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Product Name</th>
                            <th width="10%">Quantity</th>
                            <th width="15%">Unit Price</th>
                            <th width="15%">Total Price</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= ++$count ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= $row['oc_product_qty'] ?></td>
                            <td>₹<?= number_format($row["sale_price"], 2) ?></td>
                            <td>₹<?= number_format($row["oc_total_price"], 2) ?></td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="fas fa-truck me-1"></i> Shipped
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <?php if ($count == 0) { ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">No products found in this order</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php if ($count > 0) { ?>
                    <tfoot>
                        <tr class="table-active">
                            <th colspan="4" class="text-end">Grand Total:</th>
                            <th colspan="2">
                                ₹<?php 
                                    $grandTotal = array_sum(array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), 'oc_total_price'));
                                    echo number_format($grandTotal, 2);
                                ?>
                            </th>
                        </tr>
                    </tfoot>
                    <?php } ?>
                </table>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="trake.php" class="btn btn-primary px-4">
                    <i class="fas fa-truck me-2"></i>Track Order
                </a>
                
                <button class="btn btn-outline-secondary px-4">
                    <a href="print.php" class="btn btn-primary px-4" ></a>
                    <i class="fas fa-print me-2"></i>Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>