<?php
session_start();
include "db_connection.php";

// Check if required POST variables are set, else set default values or handle error
$customer = isset($_SESSION["customer_id"]) ? $_SESSION["customer_id"] : '';
$total = isset($_POST["total"]) ? $_POST["total"] : '';
$address = isset($_POST["address"]) ? $_POST["address"] : '';
$d = isset($_POST["d"]) ? $_POST["d"] : '';
$status = isset($_POST["status"]) ? $_POST["status"] : '';
$term = isset($_POST["term"]) ? $_POST["term"] : '';
$paystatus = isset($_POST["paystatus"]) ? $_POST["paystatus"] : '';


$query = "INSERT INTO tbl_order_master(order_m_customer_id,order_m_total_price,order_m_address,order_m_date,order_m_status,order_m_payment_term,order_m_payment_status) VALUES('$customer','$total','$address','$d','$status','$term','$paystatus')";
$result = mysqli_query($conn, $query);

$master_id = mysqli_insert_id($conn); // Get last inserted order ID

// Fix: Add quotes around $customer if it's a string, or cast to int for safety
$customer_id = intval($customer);
$sel = "SELECT * FROM tbl_cart WHERE tbl_cart.cart_customer_id = $customer_id";
$res = mysqli_query($conn, $sel);
while ($row = mysqli_fetch_array($res)) {
    $product_id = $row["cart_product_id"];
    $cardq = $row["cart_qty"];
    $product_query = "SELECT sale_price FROM tbl_product WHERE id='$product_id'";
    $product_res = mysqli_query($conn, $product_query);
    $product = mysqli_fetch_assoc($product_res);
    // Fix: Check if $product is not null before using its value
    $sale_price = isset($product['sale_price']) ? $product['sale_price'] : 0;
    $totaloc = $sale_price * $cardq;
    $ins = "INSERT INTO tbl_order_child(oc_master_id,oc_product_id,oc_product_qty,oc_total_price) VALUES('$master_id','$product_id','$cardq','$totaloc')";
    mysqli_query($conn, $ins);
}

$order_query = "SELECT om.*, c.customer_name
    FROM tbl_order_master om
    INNER JOIN tbl_customer c ON c.customer_id = om.order_m_customer_id
    WHERE om.order_m_id = $master_id";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

$items_query = "SELECT p.name, oc.oc_product_qty, p.sale_price 
    FROM tbl_order_child oc
    JOIN tbl_product p ON oc.oc_product_id = p.id
    WHERE oc.oc_master_id = $master_id";
$items_result = mysqli_query($conn, $items_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt | electronic item </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Screen styles */
        @media screen {
            body {
                background-color: #f8f9fa;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .print-container {
                max-width: 800px;
                margin: 50px auto;
                background: white;
                padding: 30px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
                border-radius: 10px;
            }
            .print-header {
                color: #28a745;
                border-bottom: 2px solid #28a745;
                padding-bottom: 15px;
                margin-bottom: 30px;
            }
            .no-print {
                display: block;
            }
            .print-only {
                display: none;
            }
            .btn-print {
                background-color: #28a745;
                color: white;
                margin-bottom: 20px;
            }
            .btn-print:hover {
                background-color: #218838;
                color: white;
            }
        }
        
        /* Print styles */
        @media print {
            body {
                background: white;
                font-size: 12pt;
                color: #000;
            }
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            .print-container {
                max-width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            .print-header {
                color: #000 !important;
                border-bottom: 2px solid #000 !important;
            }
            .card {
                border: 1px solid #ddd !important;
                page-break-inside: avoid;
            }
            a[href]:after {
                content: none !important;
            }
            .status-badge {
                border: 1px solid #000 !important;
                color: #000 !important;
                background: white !important;
            }
        }
        
        /* Common styles */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }
        .status-pending { background-color: #fff3cd; }
        .status-processing { background-color: #cce5ff; }
        .status-shipped { background-color: #d1ecf1; }
        .status-delivered { background-color: #d4edda; }
        .status-cancelled { background-color: #f8d7da; }
        .company-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-logo {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container print-container">
        <button onclick="window.print()" class="btn btn-print no-print">
            <i class="fas fa-print"></i> Print Receipt
        </button>
        
        <div class="no-print company-header">
            <h1 class="print-header">Order Receipt</h1>
        </div>
        <div class="print-only company-header">
            <img src="images/logo.png" alt="GreenHarvest" class="company-logo">
            <h2>electronic item</h2>
            <p>Phone: (123) 456-7890 | Email: info@electronicitem.com</p>
            <h3 class="mt-3">ORDER RECEIPT</h3>
        </div>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h4 class="card-title">
                        </h4>
                        <p><strong>Date:</strong> <?= isset($order['order_m_date']) ? date('F j, Y', strtotime($order['order_m_date'])) : 'N/A' ?></p>
                        <p><strong>Status:</strong> 
                            <span class="status-badge status-<?= isset($order['order_m_status']) ? strtolower($order['order_m_status']) : 'unknown' ?>">
                                <?= htmlspecialchars($order['order_m_status'] ?? '') ?>
                            </span>
                        </p> 
                    </div>
                    <div class="col-md-6">
                        <h5>Customer Information</h5>
                        <p><strong>Name:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
                    </div>
                </div>
                
                <hr>
                
                <h5 class="mb-3"><i class="fas fa-list"></i> Order Summary</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if ($items_result) {
                                while ($item = mysqli_fetch_assoc($items_result)) {
                                    $subtotal = $item['sale_price'] * $item['oc_product_qty'];
                                    $total += $subtotal;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars ($item['name']) ?></td>
                                <td>₹<?= number_format($item['sale_price'], 2) ?></td>
                                <td><?= $item['oc_product_qty'] ?></td>
                                <td>₹<?= number_format($subtotal, 2) ?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td>₹<?= number_format($total, 2) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-truck"></i> Delivery Address</h5>
                        <p><?= nl2br(htmlspecialchars($order['order_m_address'] ?? 'N/A')) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-comment"></i> Notes</h5>
                        <p><?= !empty($order['order_m_notes']) ? nl2br(htmlspecialchars($order['order_m_notes'])) : 'No special instructions' ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="no-print text-center mt-4">
            <p>Thank you for shopping with GreenHarvest Organic Farms!</p>
            <a href="shop.php" class="btn btn-success">
                <i class="fas fa-product-add"></i> back add to cart
            </a>
        </div>
        
        <div class="print-only text-center mt-4">
            <p><strong>Thank you for your order!</strong></p>
            <p>For any questions, please contact us at (123) 456-7890 or info@greenharvest.com</p>
            <p>Visit us online at www.greenharvest.com</p>
        </div>
    </div>
    
    <script>
        // Print automatically if print parameter exists
        if (window.location.search.includes('print=true')) {
            window.print();
        }
    </script>
</body>
</html>