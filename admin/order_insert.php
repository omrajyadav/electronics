<?php
include 'db_connection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = intval($_POST['customer_id']);
    $order_address = mysqli_real_escape_string($conn, $_POST['order_m_address']);
    $order_status = mysqli_real_escape_string($conn, $_POST['order_m_status']);

    $query = "INSERT INTO tbl_order_master (customer_id, order_m_address, order_m_status,) VALUES ($customer_id, '$order_m_address', '$order_m_status',)";
    $result = mysqli_query($conn, $query);

    if ($result) {
    echo "<script>window.location.href='order.php'</script>";
    $_SESSION["success"] = "Registration successful..";
} else {
    echo "Connection error";
}
}
?>