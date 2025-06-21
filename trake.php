<?php
include "db_connection.php";
$status = "";
$order = null;
$error = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    // Validate order ID
    if (empty($_POST['order_id'])) {
        $error = "Please enter an order ID";
    } else {
        $order_id = intval($_POST['order_id']);
        
        // Prepared statement to prevent SQL injection
        $query = "SELECT * FROM tbl_order_master WHERE order_m_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                $order = $row;
                $status = $row['order_m_status'];
            } else {
                $status = "Order not found.";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $error = "Database query error. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Organic Order | GreenHarvest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #28a745;
            --light-green: #d4edda;
            --dark-green: #218838;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .track-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .track-header {
            color: var(--primary-green);
            border-bottom: 2px solid var(--primary-green);
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .order-card {
            border-left: 4px solid var(--primary-green);
            transition: all 0.3s ease;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }
        .status-shipped {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        .btn-green {
            background-color: var(--primary-green);
            color: white;
        }
        .btn-green:hover {
            background-color: var(--dark-green);
            color: white;
        }
        .search-box {
            position: relative;
        }
        .search-box i {
            position: absolute;
            top: 12px;
            left: 15px;
            color: var(--primary-green);
        }
        .search-input {
            padding-left: 40px;
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    
    <div class="container">
        <div class="track-container">
            <div class="text-center mb-4">
                <h1 class="track-header">
                    <i class="fas fa-search-location"></i> Track Your Organic Order
                </h1>
                <p class="text-muted">Enter your order ID to check the current status</p>
            </div>
            
            <form method="post" class="mb-5">
                <div class="search-box mb-3">
                    <i class="fas fa-receipt"></i>
                    <input type="number" name="order_id" id="order_id" 
                           class="form-control form-control-lg search-input" 
                           placeholder="Enter your order ID" required
                           value="<?= isset($_POST['order_id']) ? htmlspecialchars($_POST['order_id']) : '' ?>">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-green btn-lg">
                        <i class="fas fa-truck"></i> Track Order
                    </button>
                </div>
            </form>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <?php if ($order): ?>
                <div class="card order-card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-clipboard-list text-success"></i> Order #<?= htmlspecialchars($order['order_m_id']) ?>
                            </h3>
                            <span class="status-badge status-<?= strtolower($order['order_m_status']) ?>">
                                <?= htmlspecialchars($order['order_m_status']) ?>
                            </span>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong><i class="far fa-calendar-alt text-success"></i> Order Date:</strong> 
                                    <?= date('F j, Y', strtotime($order['order_m_date'])) ?>
                                </p>
                                <p><strong><i class="fas fa-money-bill-wave text-success"></i> Total Amount:</strong> 
                                    ₹<?= is_numeric($order['order_m_total_price']) ? number_format((float)$order['order_m_total_price'], 2) : '0.00' ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-truck text-success"></i> Delivery Address:</strong> 
                                    <?= isset($order['order_m_address']) ? htmlspecialchars($order['order_m_address']) : 'N/A' ?>
                                </p>
                                <p><strong><i class="fas fa-phone text-success"></i> Contact:</strong> 
                                    <?= isset($order['order_m_phone']) ? htmlspecialchars($order['order_m_phone']) : 'N/A' ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Progress tracker -->
                        <div class="mt-4">
                            <h5 class="mb-3"><i class="fas fa-map-marked-alt text-success"></i> Order Journey</h5>
                            <div class="progress-tracker">
                                <?php 
                                $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered'];
                                $current_status = $order['order_m_status'];
                                ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($statuses as $status): ?>
                                        <li class="mb-3 d-flex align-items-center">
                                            <div class="tracker-icon me-3">
                                                <div class="icon-circle <?= array_search($status, $statuses) <= array_search($current_status, $statuses) ? 'active' : '' ?>">
                                                    <i class="fas fa-<?= 
                                                        $status == 'Pending' ? 'clock' : 
                                                        ($status == 'Processing' ? 'cogs' : 
                                                        ($status == 'Shipped' ? 'shipping-fast' : 'check-circle')) 
                                                    ?>"></i>
                                                </div>
                                            </div>
                                            <div class="tracker-details flex-grow-1">
                                                <h6 class="mb-0 <?= array_search($status, $statuses) <= array_search($current_status, $statuses) ? 'text-success' : 'text-muted' ?>">
                                                    <?= $status ?>
                                                </h6>
                                                <?php if ($status == $current_status): ?>
                                                    <small class="text-success">Current status</small>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                   
                    <a href="print.php" class="btn btn-green">
                        <i class="fas fa-shopping-pinter"></i> print
                    </a>
                </div>
            <?php elseif ($status): ?>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($status) ?>
                </div>
                <div class="text-center">
                    <a href="contact.php" class="btn btn-outline-success">
                        <i class="fas fa-headset"></i> Contact Support
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include "footer.php"; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-focus on the order ID input field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('order_id').focus();
        });
    </script>
</body>
</html>