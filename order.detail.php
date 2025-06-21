<?php
session_start();
include "header.php";
include "db_connection.php";
$count = 0;
$query = "SELECT * FROM `tbl_order_child` INNER JOIN tbl_product ON tbl_product.id=tbl_order_child.oc_product_id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="container mt-5 mb-5" >
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2 class="mb-4">Order Details</h2>
        <!--  -->

        <h3 class="mt-4" >Products in this Order</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['oc_product_qty'] ?></td>
                    <td><?= $row['oc_total_price'] ?></td>
                    <td>₹<?= number_format($row["sale_price"], decimals: 2) ?></td>
                    <td>₹<?= number_format($row["oc_total_price"], decimals: 2) ?></td>

                </tr>
            </tbody>
        </table>

        <?php if ($count == 0) { ?>
        <?php } ?>
        <a href="trake.php" class="btn btn-info px-4 py-2">
            <i class="fa-solid fa-truck"></i>
        </a>
    </div>
    <a href=" Order_hister.php">
        <button class="btn btn-warning">Back to History Page</button>
    </a>

    <?php

}
include "footer.php";
?>