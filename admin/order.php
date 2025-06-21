<?php
include "header.php";
include "db_connection.php";
?>
<?php
include "sidebar.php";
?>
<div class="content-wrapper">
    <div class="container">
        <h3>order list</h3>
     
        
    </div>
    <hr>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>*</th>
                        <th>customer name</th>
                        <th>MRP</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>payment Tearm</th>
                        <th>Payment status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $query = "SELECT * FROM tbl_order_master INNER JOIN tbl_customer ON tbl_customer.customer_id=tbl_order_master.order_m_customer_id";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= ++$count ?></td>
                            <td><?= $row["customer_name"] ?></td>
                            <td><?= $row["order_m_total_price"] ?></td>
                            <td><?= $row["order_m_address"] ?></td>
                            <td><?= $row["order_m_date"] ?></td>
                            <td><?= $row["order_m_status"] ?></td>
                            <td><?= $row["order_m_payment_term"] ?></td>
                            <td><?= $row["order_m_payment_status"] ?></td>
                            <td>
                                <a href="order_edit.php?id=<?= $row['order_m_id']; ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>